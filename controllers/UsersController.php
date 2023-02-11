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
use app\models\Cidades;
use app\models\Estados;
use app\helpers\CustomHelper;
use app\models\extension\UsersExt;
use app\models\extension\ClientsExt;
use app\models\extension\MailingExt;
use app\helpers\HelpersValidate;


class UsersController extends Controller
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
        $users_model = new Users;
        $clients_model = new Clients;
        
		# POST #
		if (Yii::$app->request->post()) 
		{
			if ($users_model->load(Yii::$app->request->post()) && $users_model->validate()) 
			{
				# DUPLICIDADE #
				if (UsersExt::checkEmail('', Yii::$app->request->post("Users")["email"]) > 0) 
				{
					Yii::$app->session->setFlash('error_user_cadastro', 'Este email já está cadastrado para outro usuário.');
					return $this->render('/site/login',['cadastro_return' => 1, 'dados' => Yii::$app->request->post("Users")]);
				}
				# VALIDATE SENHAS DE CONFIRMACAO #
				if((Yii::$app->request->post("Users")["password"] != Yii::$app->request->post("Users")["senha_confirm"]) || Yii::$app->request->post("Users")["password"] == '')
				{
					Yii::$app->session->setFlash('error_user_cadastro', 'ERRO: Senhas de confirmação diferente da nova senha.');
					return $this->render('/site/login',['cadastro_return' => 1, 'dados' => Yii::$app->request->post("Users")]);
				}
				
                # ATRIBUTES #
				$users_model['code'] = CustomHelper::guidv4();
				$users_model->role = 'client';
				$users_model->username = Yii::$app->request->post("Users")["email"];
				$users_model['registration_date'] = time();
				$users_model->attributes = Yii::$app->request->post();
				$users_model->password = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post("Users")["password"]);
				
                $clients_model['code'] = CustomHelper::guidv4();
                $clients_model['user'] = $users_model['code'];
                $clients_model['phone'] = Yii::$app->request->post("Users")["phone"];
                
				# SAVE #
				if ($users_model->save() && $clients_model->save()) 
				{
					# SEND EMAIL #
					$subject = Yii::$app->params['mail_subject'] . ' - Cadastro realizado';
					$recover_html = $this->renderPartial('/mail/cadastro',['user' => $users_model, 'cliente' => $clients_model, 'subject' => $subject]);
					
					CustomHelper::sendEmail
					(
							Yii::$app->params['mail_ceo'] # FROM
						, 	Yii::$app->request->post("Users")["email"] # TO
						, 	$subject # SUBJECT
						, 	'' # TEXT BODY
						, 	$recover_html # HTML
					);
							
					# NEWSLETTER #
					if(Yii::$app->request->post('newsletter'))
					{
						MailingExt::CadastrarNews($users_model->name, $users_model->email);
					}
					
					# LOGIN #
					$login = new LoginForm();
					
					if(!$login->login($users_model->email, Yii::$app->request->post("Users")["password"]))
					{
						return $this->redirect(['/login']);
						
					} else {
						// Yii::$app->session->setFlash('sucesso', 'Usuário criado com sucesso');
						return $this->redirect(['/']);
					}
					
				} else {
					return $this->render('/site/login',['cadastro_return' => 1, 'dados' => Yii::$app->request->post("Users"), 'class_errors' => $users_model->errors, 'class_errors_clients' => $clients_model->errors]);
				}

			} else {
				return $this->render('/site/login',['cadastro_return' => 1, 'dados' => Yii::$app->request->post("Users"), 'class_errors' => $users_model->errors, 'class_errors_clients' => $clients_model->errors]);
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
		$users_model = new Users;
		
        if(Yii::$app->request->post("Users")["email"])
		{
			# VALIDATE #
			$user = UsersExt::findByEmail(Yii::$app->request->post("Users")["email"]);

			if(count($user) > 0)
			{
				# GENERATE HASH #
				$user->senha_recover = sha1(microtime() . $user->code);
				$user->save();
				
				# SEND EMAIL #
				$subject = Yii::$app->params['mail_subject'] . ' - Redefinição de senha';
				$recover_html = $this->renderPartial('/mail/recover',['user' => $user, 'subject' => $subject]);
				
				if	(
						CustomHelper::sendEmail
				
							(
									Yii::$app->params['mail_sac'] # FROM
								, 	Yii::$app->request->post("Users")["email"] # TO
								, 	$subject # SUBJECT
								, 	'' # TEXT BODY
								, 	$recover_html # HTML
							)
						&&
						$user->senha_recover
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
		$user = UsersExt::findBySenhaHash($_GET['senha_recover']);
		
		if(count($user) == 1)
		{
			if(Yii::$app->request->post("Users"))
			{
				# VALIDATE SENHAS DE CONFIRMACAO #
				if((Yii::$app->request->post("Users")["senha"] != Yii::$app->request->post("Users")["senha_confirm"]) || Yii::$app->request->post("Users")["senha"] == '')
				{
					Yii::$app->session->setFlash('recover_password', 'ERRO: Senhas de confirmação diferente da nova senha.');
					return $this->render('redefinir-senha',['senha_recover' => $user->senha_recover, 'recover_return' => 1]);
				}
				
				# SAVE #
				$user->password = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post("Users")["senha"]);
				$user->senha_recover = null;

				if($user->update())
				{
					Yii::$app->session->setFlash('recover_sucess', 'Nova senha salva com sucesso.');
					return $this->redirect(['/login']);
					
				} else {
					Yii::$app->session->setFlash('recover_password', 'ERRO: Não foi possível alterar a senha.');
					return $this->render('redefinir-senha',['senha_recover' => $user->senha_recover, 'recover_return' => 1]);
				}
			}
			
		} else {
			throw new \yii\web\BadRequestHttpException('Requisição inválida.', 400);
		}

		# RENDER #
		return $this->render('/clients/redefinir-senha',['senha_recover' => $user->senha_recover, 'recover_return' => 1]);
	}
	
	##### MINHA CONTA #####
    public function actionMinhaConta()
    {
		# PAGE TITLE
		$this->view->title = Yii::$app->name . ' - Minha Conta';
		
		# CLASSES
		$users_model = new Users;
		$cidades_model = new Cidades;
		$estados_model = new Estados;

		# DATA
		$user = UsersExt::findById(Yii::$app->user->identity->id);
		$email = $user->email;
		$cidades = ArrayHelper::map($cidades_model->find()->orderBy('cidade')->all(),'id','cidade');
		$estados = ArrayHelper::map($estados_model->find()->orderBy('estado')->all(),'id','estado');

		# POST
		if (Yii::$app->request->post("Users")) 
		{
			if ($users_model->load(Yii::$app->request->post()) && $users_model->validate()) 
			{
				# VALIDATE
				$validate = new HelpersValidate();				
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["nome"], $attribute = 'Nome', true, '', 255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["sobrenome"], $attribute = 'Sobrenome', true, '', 255);
				#$validate->validarEmail($_POST['email_inscricao'], 'E-mail');
				$validate->validarCpf(Yii::$app->request->post("Users")["cpf"], 'CPF', true, $msg = '');
				$validate->validarTelefone(Yii::$app->request->post("Users")["telefone"], $attribute = 'Telefone', true);
				$validate->validarTelefone(Yii::$app->request->post("Users")["celular"], $attribute = 'Celular', true);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["sexo"], $attribute = 'Sexo', true, '', 1);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["datanascimento"], $attribute = 'Data de Nascimento', true, '', 255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["nome_fantasia"], $attribute = 'Nome Fantasia', false, '', 255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["razao_social"], $attribute = 'Razão Social', false, '', 255);
				$validate->validarCNPJ(Yii::$app->request->post("Users")["cnpj"], 'CNPJ', false);
				$validate->validarCep(Yii::$app->request->post("Users")["cep"], 'CEP', true);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["endereco"], $attribute = 'Endereço', true, '', 255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["numero"], $attribute = 'Número', true, '', 255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["complemento"], $attribute = 'Número', false, '', 255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["bairro"], $attribute = 'Bairro', true, '',255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["cidade_id"], $attribute = 'Cidade', true, '',255);
				$validate->validarInputTextDefault(Yii::$app->request->post("Users")["estado_id"], $attribute = 'Estado', true, '', 255);
				
				if ($validate->getErrors()) 
				{
					$validate_errors = $validate->geraErrosFront('<font color="red">ATENÇÃO! Foram encontrados os seguintes erros:</font>');
					return $this->render('minha-conta', ['user' => $user, 'dados' => Yii::$app->request->post("Users"), 'cidades' => $cidades, 'estados' => $estados, 'validate_errors' => $validate_errors]);
					
				} else {
					# ATRIBUTES
					$user->attributes = Yii::$app->request->post('Users');
					$user->email = $email;
					
					# SAVE
					if ($user->save()) 
					{
						Yii::$app->session->setFlash('sucesso', 'CADASTRO ATUALIZADO COM SUCESSO!');
						return $this->redirect(['minha-conta']);
						
					} else {
						return $this->render('minha-conta', ['user' => $user, 'dados' => Yii::$app->request->post('Users'), 'cidades' => $cidades, 'estados' => $estados, 'class_errors' => $user->errors]);
					}					
				}	

				# VALIDATE SENHAS DE CONFIRMACAO #
				// if((Yii::$app->request->post("Users")["senha"] != Yii::$app->request->post("Users")["senha_confirm"]) || Yii::$app->request->post("Users")["senha"] == '')
				// {
					// Yii::$app->session->setFlash('error_user_cadastro', 'ERRO: Senhas de confirmação diferente da nova senha.');
					// return $this->render('/site/login',['cadastro_return' => 1, 'dados' => Yii::$app->request->post("Users")]);
				// }
					// $users_model->senha = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post("Users")["senha"]);

			} else {				
				return $this->render('minha-conta', ['user' => $user, 'dados' => Yii::$app->request->post('Users'), 'cidades' => $cidades, 'estados' => $estados, 'class_errors' => $users_model->errors]);
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

        return $this->render('minha-conta', ['user' => $user, 'cidades' => $cidades, 'estados' => $estados, 'return_senha' => $return_senha, 'validate_errors' => $validate_errors]);
	}
	
    public function actionTrocasenha()
    {
		# PAGE TITLE
		$this->view->title = Yii::$app->name . ' - Minha Conta';
		
		# CLASSES
		$users_model = new Users;

		# DATA
		$user = UsersExt::findById(Yii::$app->user->identity->id);

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

        return $this->render('minha-conta', ['user' => $user, 'cidades' => $cidades, 'cidades' => $cidades, 'estados' => $estados]);
    }	
}
