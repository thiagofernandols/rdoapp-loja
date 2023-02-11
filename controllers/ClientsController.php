<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\Users;
use app\models\Clients;
use app\models\Cities;
use app\models\States;
use app\models\Branches;
use app\models\Sectors;
use app\models\Companies;
use app\helpers\CustomHelper;
use app\models\extension\UsersExt;
use app\models\extension\ClientsExt;
use app\models\extension\MailingExt;
use app\helpers\HelpersValidate;


class ClientsController extends Controller
{
	##### BEHAVIORS #####
    public function behaviors()
    {
        return [
            'access' => 
			[
                'class' => AccessControl::className(),
                'only' => 	[
									'cadastro'
								,	'recover'
								,	'redefinir-senha'
								,	'minha-conta'
							],
                'rules' => [
                    [
                        'actions' => [		
											'cadastro'
										,	'recover'
										,	'redefinir-senha'
									 ],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
											'minha-conta'
									 ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['GET'],
                    'login' => ['GET','POST'],
                    'recover' => ['GET','POST'],
                ],
            ],
        ];
    }
	
	##### ACTIONS #####
    public function actions()
    {
        return [
            // 'error' => [
                // 'class' => 'yii\web\ErrorAction',
            // ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
	
    public function actionCadastro()
    {
		# PAGE TITLE #
		$this->view->title = Yii::$app->name . ' - Cadastro';
		
		# CLASSES #
        $clients_model = new Clients;

		# POST #
		if (Yii::$app->request->post()) 
		{
			if ($clients_model->load(Yii::$app->request->post()) && $clients_model->validate()) 
			{
				# DUPLICIDADE #
				if (ClientsExt::checkEmail(Yii::$app->user->identity->id, Yii::$app->request->post("Clients")["email"]) > 0) 
				{
					Yii::$app->session->setFlash('error_user_cadastro', 'Este email já está cadastrado para outro usuário.');
					return $this->render('/site/login',['cadastro_return' => 1, 'dados' => Yii::$app->request->post("Clients")]);
				}
				
				# VALIDATE SENHAS DE CONFIRMACAO #
				if((Yii::$app->request->post("Clients")["senha"] != Yii::$app->request->post("Clients")["senha_confirm"]) || Yii::$app->request->post("Clients")["senha"] == '')
				{
					Yii::$app->session->setFlash('error_user_cadastro', 'ERRO: Senhas de confirmação diferente da nova senha.');
					return $this->render('/site/login',['cadastro_return' => 1, 'dados' => Yii::$app->request->post("Clients")]);
				}
				
				# ATRIBUTES #
				$clients_model->attributes = Yii::$app->request->post();
				$clients_model->senha = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post("Clients")["senha"]);
				
				# SAVE #
				if ($clients_model->save()) 
				{
					# SEND EMAIL #
					$subject = Yii::$app->params['mail_subject'] . ' - Cadastro realizado';
					$recover_html = $this->renderPartial('/mail/cadastro',['client' => $clients_model, 'subject' => $subject]);
					
					CustomHelper::sendEmail
					(
							Yii::$app->params['mail_ceo'] # FROM
						, 	Yii::$app->request->post("Clients")["email"] # TO
						, 	$subject # SUBJECT
						, 	'' # TEXT BODY
						, 	$recover_html # HTML
					);
							
					# NEWSLETTER #
					if(Yii::$app->request->post('newsletter'))
					{
						MailingExt::CadastrarNews($clients_model->nome, $clients_model->email);
					}
					
					# LOGIN #
					$login = new LoginForm();
					
					if(!$login->login($clients_model->email, Yii::$app->request->post("Clients")["senha"]))
					{
						return $this->redirect(['/login']);
						
					} else {
						// Yii::$app->session->setFlash('sucesso', 'Usuário criado com sucesso');
						return $this->redirect(['/']);
					}
					
				} else {
					return $this->render('/site/login',['cadastro_return' => 1, 'dados' => Yii::$app->request->post("Clients"), 'class_errors' => $clients_model->errors]);
				}

			} else {
				return $this->render('/site/login',['cadastro_return' => 1, 'dados' => Yii::$app->request->post("Clients"), 'class_errors' => $clients_model->errors]);
			}			
		}			
		
		# RENDER #
        return $this->render('/site/login',['cadastro_return' => 1]);
    }
	
	##### RECOVER #####
	public function actionRecover()
	{
		# PAGE TITLE #
		$this->view->title = Yii::$app->name . ' - Recuperar Senha';
		
		# CLASSES #
		$clients_model = new Clients;
		
        if(Yii::$app->request->post("Clients")["email"])
		{
			# VALIDATE #
			$client = ClientsExt::findCompleteByEmail(Yii::$app->request->post("Clients")["email"]);

			if(count($client) > 0)
			{
				# GENERATE HASH #
				$client->senha_recover = sha1(microtime() . $client->code);
				$client->save();
				
				# SEND EMAIL #
				$subject = Yii::$app->params['mail_subject'] . ' - Redefinição de senha';
				$recover_html = $this->renderPartial('/mail/recover',['client' => $client, 'subject' => $subject]);
				
				if	(
						CustomHelper::sendEmail
				
							(
									Yii::$app->params['mail_ceo'] # FROM
								, 	Yii::$app->request->post("Clients")["email"] # TO
								, 	$subject # SUBJECT
								, 	'' # TEXT BODY
								, 	$recover_html # HTML
							)
						&&
						$client->senha_recover
					)
				{
					Yii::$app->session->setFlash('recover_feedback', 'E-mail de redefinição de senha enviado.');
				
				} else {
					Yii::$app->session->setFlash('recover_feedback', 'ERRO: Ocorreu um erro, por favor tente novamente mais tarde.');
				}
			
			} else {
				Yii::$app->session->setFlash('recover_feedback', 'ERRO: E-mail não cadastrado ou inativo.');
				return $this->render('/site/login',['recover_return' => 1]);
			}
		}
		
		# RENDER #
		return $this->render('/site/login',['recover_return' => 1]);
	}
	
	##### REDEFINIR SENHA #####
	public function actionRedefinirSenha()
	{
		# PAGE TITLE #
		$this->view->title = Yii::$app->name . ' - Redefinir Senha';
		
		# DATA #
		$client = ClientsExt::findBySenhaHash($_GET['senha_recover']);
		
		if(count($client) == 1)
		{
			if(Yii::$app->request->post("Clients"))
			{
				# VALIDATE SENHAS DE CONFIRMACAO #
				if((Yii::$app->request->post("Clients")["senha"] != Yii::$app->request->post("Clients")["senha_confirm"]) || Yii::$app->request->post("Clients")["senha"] == '')
				{
					Yii::$app->session->setFlash('recover_password', 'ERRO: Senhas de confirmação diferente da nova senha.');
					return $this->render('redefinir-senha',['senha_recover' => $client->senha_recover, 'recover_return' => 1]);
				}
				
				# SAVE #
				$client->senha = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post("Clients")["senha"]);
				$client->senha_recover = null;
				
				if($client->save())
				{
					Yii::$app->session->setFlash('recover_sucess', 'Nova senha salva com sucesso.');
					return $this->redirect(['/login']);
					
				} else {
					Yii::$app->session->setFlash('recover_password', 'ERRO: Não foi possível alterar a senha.');
					return $this->render('redefinir-senha',['senha_recover' => $client->senha_recover, 'recover_return' => 1]);
				}
			}
			
		} else {
			throw new \yii\web\BadRequestHttpException('Requisição inválida.', 400);
		}

		# RENDER #
		return $this->render('redefinir-senha',['senha_recover' => $client->senha_recover, 'recover_return' => 1]);
	}
	
	##### MINHA CONTA #####
    public function actionMinhaConta()
    {
		# PAGE TITLE
		$this->view->title = Yii::$app->name . ' - Minha Conta';
		
		# CLASSES
		$users_model = new Users;
		$clients_model = new Clients;
		$cidades_model = new Cities;
		$estados_model = new States;
		$companies_model = new Companies;
		$branches_model = new Branches;
		$sectors_model = new Sectors;

		# DATA
		$user = UsersExt::findById(Yii::$app->user->identity->id);
		$client = ClientsExt::findById(Yii::$app->user->identity->id);
		$company = $companies_model::find()->where('client = "' . $client->code . '"')->one();		
		$email = $user->email;
		$cidades = ArrayHelper::map($cidades_model->find()->orderBy('name')->all(),'code','name');
		$estados = ArrayHelper::map($estados_model->find()->orderBy('abbr')->all(),'code','abbr');
		$branches = ArrayHelper::map($branches_model->find()->orderBy('name')->all(),'code','name');
		$sectors = ArrayHelper::map($sectors_model->find()->orderBy('name')->all(),'code','name');

		# POST
		if (Yii::$app->request->post("Clients") && Yii::$app->request->post("Users")) 
		{
			if ($users_model->load(Yii::$app->request->post()) && $clients_model->load(Yii::$app->request->post()))
			# && $users_model->validate() && $clients_model->validate()) 
			{
				# VALIDATE
				$validate = new HelpersValidate();				
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["name"], $attribute = 'Nome', true, '', 255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["lastname"], $attribute = 'Sobrenome', true, '', 255);
				#$validate->validarEmail($_POST['email_inscricao'], 'E-mail');
				$validate->validarCpf(Yii::$app->request->post("Clients")["client_id"], 'CPF', true, $msg = '');
				$validate->validarTelefone(Yii::$app->request->post("Users")["phone"], $attribute = 'Telefone', true);
				$validate->validarInputTextDefault(Yii::$app->request->post("Clients")['client_sex'], $attribute = 'Sexo', true, '', 1);
				$validate->validarInputTextDefault(Yii::$app->request->post("Clients")["client_birthdate"], $attribute = 'Data de Nascimento', true, '', 255);
				$validate->validarCep(Yii::$app->request->post("Users")["postal_code"], 'CEP', true);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["street"], $attribute = 'Endereço', true, '', 255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["number"], $attribute = 'Número', true, '', 255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["complement"], $attribute = 'Número', false, '', 255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["neighborhood"], $attribute = 'Bairro', true, '',255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["city"], $attribute = 'Cidade', true, '',255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["state"], $attribute = 'Estado', true, '', 255);
				
				if ($validate->getErrors()) 
				{
					$validate_errors = $validate->geraErrosFront('<font color="red">ATENÇÃO! Foram encontrados os seguintes erros:</font>');

					return $this->render('minha-conta', [
							'user' => $user
						, 	'client' => $client
						, 	'cidades' => $cidades
						, 	'estados' => $estados
						, 	'dados_user' => Yii::$app->request->post("Users")
						,	'dados_client' => Yii::$app->request->post("Clients")
						, 	'validate_errors' => $validate_errors
					]);
					
				} else {
					# ATTRIBUTES
					$user->attributes = Yii::$app->request->post('Users');
					$user->email = $email;

					$client->attributes = Yii::$app->request->post('Clients');
					$client->client_birthdate = date("d/m/Y", strtotime(Yii::$app->request->post('Clients')['client_birthdate']));
					
					# SAVE
					if ($client->save() && $user->save()) 
					{

						Yii::$app->session->setFlash('sucesso', 'CADASTRO ATUALIZADO COM SUCESSO!');
						return $this->redirect(['minha-conta']);
						
					} else {
						return $this->render('minha-conta', [
								'user' => $user
							, 	'client' => $client
							, 	'cidades' => $cidades
							, 	'estados' => $estados
							, 	'dados_user' => Yii::$app->request->post("Users")
							,	'dados_client' => Yii::$app->request->post("Clients")
							,	'class_errors' => $user->errors
							, 	'class_errors_clients' => $client->errors
						]);
					}					
				}	

				# VALIDATE SENHAS DE CONFIRMACAO #
				// if((Yii::$app->request->post("Clients")["senha"] != Yii::$app->request->post("Clients")["senha_confirm"]) || Yii::$app->request->post("Clients")["senha"] == '')
				// {
					// Yii::$app->session->setFlash('error_user_cadastro', 'ERRO: Senhas de confirmação diferente da nova senha.');
					// return $this->render('/site/login',['cadastro_return' => 1, 'dados' => Yii::$app->request->post("Clients")]);
				// }
					// $clients_model->senha = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post("Clients")["senha"]);

			} else {				
				return $this->render('minha-conta', [
						'user' => $user
					, 	'client' => $client
					, 	'cidades' => $cidades
					, 	'estados' => $estados
					, 	'dados_user' => Yii::$app->request->post("Users")
					,	'dados_client' => Yii::$app->request->post("Clients")
					,	'class_errors' => $users_model->errors
					, 	'class_errors_clients' => $clients_model->errors
				]);
			}			
		}
		
		if (Yii::$app->request->post("TrocarSenha")) 
		{
			$post = Yii::$app->request->post("TrocarSenha");

			$return_senha = [];
			
			# VALIDATE
			$validate = new HelpersValidate();				
			$validate->validarInputTextDefault($post["senha_atual"], $attribute = 'Senha atual', true, 4, 10);
			$validate->validarInputTextDefault($post["senha_nova"], $attribute = 'Senha nova', true, 4, 10);
			$validate->validarInputTextDefault($post["senha_confirm"], $attribute = 'Senha de confirmação', true, 4, 10);			
			
			if ($validate->getErrors()) 
			{
				$validate_errors = $validate->geraErrosFront('<font color="red">ATENÇÃO! Foram encontrados os seguintes erros:</font>');
				
			} else {

				# VERIFICA SENHA
				if(($post["senha_nova"] !=$post["senha_confirm"]))
				{
					$return_senha[] = 'Senha de confirmação diferente da nova senha.';
				}
				
				# SENHA ATUAL INVALIDA
				if (!UsersExt::trocaSenha(Yii::$app->user->identity->id, $post["senha_atual"], Yii::$app->getSecurity()->generatePasswordHash($post["senha_nova"]))) 
				{
					$return_senha[] = 'Senha atual inválida.';
				
				# SALVA SENHA
				} else {
					Yii::$app->session->setFlash('sucesso', 'SENHA TROCADA COM SUCESSO!');
					return $this->redirect(['minha-conta']);
				}
			}
		}	
		
        return $this->render('minha-conta', [
				'user' => $user
			, 	'client' => $client
			, 	'cidades' => $cidades
			, 	'estados' => $estados
			,	'return_senha' => isset($return_senha) ? $return_senha : ''
			, 	'validate_errors' => isset($validate_errors) ? $validate_errors : ''
			]);
	}
	
    public function actionTrocasenha()
    {
		# PAGE TITLE
		$this->view->title = Yii::$app->name . ' - Minha Conta';
		
		# CLASSES
		$clients_model = new Clients;

		# DATA
		$client = ClientsExt::findById(Yii::$app->user->identity->id);

		if ($_POST) 
		{
			if ($model->trocaSenha(Yii::$app->user->identity->id, $_POST['senhaatual'], Yii::$app->getSecurity()->generatePasswordHash($_POST['Usuario']['senha']))) 
			{
                Yii::$app->session->setFlash('sucesso', '');
			
			} else {
                Yii::$app->session->setFlash('erro', '');
            }

            return $this->redirect(['trocasenha']);
        }

        return $this->render('senha', [
            'model' => $this->findModel(Yii::$app->user->identity->id),
		]);

        return $this->render('minha-conta', ['client' => $client, 'cidades' => $cidades, 'cidades' => $cidades, 'estados' => $estados]);
    }	
}
