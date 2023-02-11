<?php

namespace app\controllers;

use Yii;
use app\models\Requests;
use app\models\Users;
use app\models\Clients;
use app\models\Companies;
use app\models\Cities;
use app\models\States;
use app\models\Branches;
use app\models\Sectors;
use app\models\Moip;
use app\models\extension\RequestsExt;
use app\models\extension\UsersExt;
use app\models\extension\ClientsExt;
use app\models\extension\CompaniesExt;
use app\models\extension\CitiesExt;
use app\helpers\CustomHelper;
use app\helpers\HelpersValidate;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class RequestsController extends Controller
{
	# BEHAVIORS #
    public function behaviors()
    {
        return [
            'access' => 
			[
                'class' => AccessControl::className(),
                'only' => 	[
									'assinar'
								,	'assinatura'
								,	'assinaturas'
							],
                'rules' => [
                    [
                        'actions' => [
                                        'assinar'
                                    ,	'assinatura'
                                    ,	'assinaturas'
                         ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'assinar' => ['GET','POST'],
                ],
            ],
        ];
    }
	
	# ACTIONS #
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
	
	# ASSINAR #
    public function actionAssinar()
    {
        # CLASSES
        $model = new Requests;
		$cidades_model = new Cities;
        $estados_model = new States;
        $branches_model = new Branches;
        $sectors_model = new Sectors;
        $users_model = new Users;
        $clients_model = new Clients;
        $companies_model = new Companies;

		# DATA
        $cliente = ClientsExt::findCompleteById(Yii::$app->user->identity->id);
		$cidades = ArrayHelper::map($cidades_model->find()->orderBy('name')->all(),'code','name');
        $estados = ArrayHelper::map($estados_model->find()->orderBy('abbr')->all(),'code','abbr');
        $branches = ArrayHelper::map($branches_model->find()->orderBy('name')->all(),'code','name');
		$sectors = ArrayHelper::map($sectors_model->find()->orderBy('name')->all(),'code','name');
        $post = Yii::$app->request->post("Requests");

       # EXCLUIR
       # $post['cnpj'] = 'ci' . time();

        if(Yii::$app->request->get('plano') != 'plano-gratuito'  && Yii::$app->request->get('plano')  != 'plano-basico')
        {
            throw new \yii\web\BadRequestHttpException('Página não encontrada.', 404);
        }
        
        # POST
        if ($model->load(Yii::$app->request->post())) 
		{
            $validate = new HelpersValidate();				
            $validate->validarInputTextDefault($post["termos"], $attribute = 'Termos', true, '', 255);
            $validate->validarInputTextDefault($post["nome_fantasia"], $attribute = 'Nome Fantasia', true, '', 255);
            $validate->validarInputTextDefault($post["razao_social"], $attribute = 'Razão Social', true, '', 255);
            $validate->validarInputTextDefault($post["branch"], $attribute = 'Ramo', true, '', 255);
            $validate->validarInputTextDefault($post["sector"], $attribute = 'Setor', true, '', 255);
            $validate->validarCNPJ($post["cnpj"], 'CNPJ', true);
            $validate->validarInputTextDefault($post["nome"], $attribute = 'Nome', true, '', 255);
            $validate->validarInputTextDefault($post["sobrenome"], $attribute = 'Sobrenome', true, '', 255);
            $validate->validarEmail($post['email'], 'E-mail');
            $validate->validarCpf($post["cpf"], 'CPF', true, $msg = '');
            $validate->validarTelefone($post["telefone"], $attribute = 'Telefone', true);
            $validate->validarInputTextDefault($post["sexo"], $attribute = 'Sexo', true, '', 1);
            $validate->validarInputTextDefault($post["datanascimento"], $attribute = 'Data de Nascimento', true, '', 255);
            $validate->validarCep($post["cep"], 'CEP', true);
            $validate->validarInputTextDefault($post["endereco"], $attribute = 'Endereço', true, '', 255);
            $validate->validarInputTextDefault($post["numero"], $attribute = 'Número', true, '', 255);
            $validate->validarInputTextDefault($post["complemento"], $attribute = 'Complemento', false, '', 255);
            $validate->validarInputTextDefault($post["bairro"], $attribute = 'Bairro', true, '',255);
            $validate->validarInputTextDefault($post["city"], $attribute = 'Cidade', true, '',255);
            $validate->validarInputTextDefault($post["state"], $attribute = 'Estado', true, '',255);
            
            # VALIDATE
            if ($validate->getErrors()) 
            {
                $validate_errors = $validate->geraErrosFront('<font color="red">ATENÇÃO! Foram encontrados os seguintes erros:</font>');
                
                $this->view->title = Yii::$app->name . ' - Assinar - Erros';
                return $this->render('assinar', [
                        'model' => $model
                    ,   'dados' => Yii::$app->request->post('Requests')
                    ,   'cliente' => $cliente
                    ,   'cidades' => $cidades
                    ,   'estados' => $estados
                    ,   'branches' => $branches
                    ,   'sectors' => $sectors
                    ,   'erros' => $validate_errors
                ]);

            } else {
                # EMPRESA
                $company_duplicidade = RequestsExt::duplicidadeEmpresa($post["cnpj"]);

                # VALIDATE EMPRESAS
                if(count($company_duplicidade) > 0)
                {
                    $erro = 'Empresa já cadastrada para outro plano';

                    $this->view->title = Yii::$app->name . ' - Assinar - Erros';
                    return $this->render('assinar', [
                            'model' => $model
                        ,   'dados' => Yii::$app->request->post('Requests')
                        ,   'cliente' => $cliente
                        ,   'cidades' => $cidades
                        ,   'estados' => $estados
                        ,   'branches' => $branches
                        ,   'sectors' => $sectors
                        ,   'erros' => $erro
                    ]);

                } else {
                    $companies_model->code = CustomHelper::guidv4();
                    $companies_model->client = $cliente->code;
                    $companies_model->fantasy_name = $post['nome_fantasia'];
                    $companies_model->company_name = $post['razao_social'];
                    $companies_model->company_id = $post['cnpj'];
                    $companies_model->branch = $post['branch'];
                    $companies_model->sector = $post['sector'];
                    
                    # SAVE
                    if($companies_model->save())
                    {
                        # CODE ALIAS
                        $last_code_alias = $model::find()->select(['code_alias'])->orderBy(new \yii\db\Expression('SUBSTRING_INDEX(code_alias, "/", -1) DESC, SUBSTRING_INDEX(code_alias, "/", 1) DESC'))->one();

                        $last_code_alias = explode("/", $last_code_alias->code_alias);

                        if(date("Y") == $last_code_alias[1])
                        {
                            $code_alias = sprintf('%05d', $last_code_alias[0] + 1) . '/' . $last_code_alias[1];
                        
                        } else {
                            $code_alias = sprintf('%05d', 1) . '/' . date("Y");
                        }

                        # ASSINATURA #
                        $model->code = CustomHelper::guidv4();
                        $model->code_alias = $code_alias;
                        $model->client = $cliente->code;
                        $model->user = $cliente->user;
                        $model->plan = $post['plano'] == 'plano-gratuito' ? '5a6735a4-effc-4f52-8915-180c84330d17' : '5b1acd40-948c-4d45-a538-47296bb436fe';
                        $model->company = $companies_model->code;
                        $model->moip_subscription_code = md5(time() . (isset($post['client_id']) ? $post['client_id'] : '') . (isset($post['company_id']) ? $post['company_id'] : ''));
                        $model->setup_fee_subscription =  0.00;
                        $model->payment_method = isset($post['payment_method']) ? $post['payment_method'] : '';
                        $model->dia_vencimento = isset($post['dia_vencimento']) ? $post['dia_vencimento'] : '';
                        $model->checkout_date = date("Y-m-d");
                        $model->checkout_value = $post['plano'] == 'plano-gratuito' ? 0.00 : 99.90;

                        # SAVE PLANO
                        if ($model->save()) 
                        {
                            # CLIENTE #
                            $client = ClientsExt::findById(Yii::$app->user->identity->id);
                            if($client->moip_customer_code)
                            {
                                $moip_customer_code = $client->moip_customer_code;
                                $new_client = false;

                            } else {
                                $moip_customer_code = substr(sha1(time() . $post['cpf']), 0, 36);
                                $new_client = true;
                            }
                            $client->client_sex = $post['sexo'];
                            $client->client_birthdate = date("d/m/Y", strtotime($post['datanascimento']));
                            $client->client_id = $post['cpf'];
                            $client->save();

                            # USER
                            $user = UsersExt::findById(Yii::$app->user->identity->id);
                            $user->email = $post['email'];
                            $user->name = $post['nome'];
                            $user->lastname = $post['sobrenome'];
                            $user->phone = $post['telefone'];
                            $user->postal_code = $post['cep'];
                            $user->street = $post['endereco'];
                            $user->number = $post['numero'];
                            $user->complement = $post['complemento'];
                            $user->neighborhood = $post['bairro'];
                            $user->city = $post['city'];
                            $user->state = $post['state'];
                            $user->save();

                            if(count($client->errors) > 0 || count($user->errors) > 0)
                            {
                                # DELETE COMPANY
                                \Yii::$app->db->createCommand()->delete('companies', ['code' => $companies_model->code])->execute();

                                # REVERTE CPF
                                $client->client_id = $cliente->client_id;
                                $client->save();
    
                                $this->view->title = Yii::$app->name . ' - Assinar - Erros';
                                return $this->render('assinar', [
                                        'model' => $model
                                    ,   'dados' => Yii::$app->request->post('Requests')
                                    ,   'cliente' => $cliente
                                    ,   'cidades' => $cidades
                                    ,   'estados' => $estados
                                    ,   'branches' => $branches
                                    ,   'sectors' => $sectors
                                    ,   'class_errors_clients' => $client->errors
                                    ,   'class_errors_users' => $user->errors
                                    ,   'class_errors_companies' => $companies_model->errors
                                ]);
                            }
                            
                            # PROCESSA PLANO POR TIPO
                            # PLANO BASICO
                            if($post['plano'] == 'plano-basico')
                            {        
                                $assinatura = RequestsExt::findById($model->code, $model->client);

                                $moip = new Moip;
                                $pagamento = $moip->submitPayment($model->payment_method, $assinatura, Yii::$app->request->post('Cartao'), $moip_customer_code, $new_client);

                                if(count($pagamento['errors']) == 0)
                                {
                                    # $model->moip_subscription_status = $pagamento['customer']['code'];
                                    # $model->save();

                                    # MOIP CUSTOMER ID
                                    $client->moip_customer_code = $moip_customer_code;
                                    $client->save();
                                    
                                    # CREATE APP USER
                                    $create_app_user = $moip->createAppUser($assinatura, $post['senha']);

                                    if($create_app_user == 'true')
                                    {
                                        if($assinatura->payment_method == 'BOLETO')
                                        {
                                            $faturas = $moip->listFaturas($assinatura->moip_subscription_code);
                                            $boleto = $faturas['invoices'][0]['_links']['boleto']['redirect_href'];
                                        }
                                        
                                        # SEND EMAIL #
                                        $subject = Yii::$app->params['mail_subject'] . ' - Recebemos seu Pedido de Assinatura #' . $model->code_alias;
                                        $recover_html = $this->renderPartial('/mail/assinatura',['assinatura' => $assinatura, 'subject' => $subject, 'fatura' => isset($boleto) ? $boleto : '']);
                                        
                                        CustomHelper::sendEmail
                                        (
                                                Yii::$app->params['mail_ceo'] # FROM
                                            , 	$client->email # TO
                                            , 	$subject # SUBJECT
                                            , 	'' # TEXT BODY
                                            , 	$recover_html # HTML
                                        );

                                        Yii::$app->session->setFlash('sucesso', 'RECEBEMOS SEU PEDIDO DE ASSINATURA!');
                                        if($boleto)
                                        {
                                            Yii::$app->session->setFlash('boleto', $boleto);
                                        }
                                        return $this->redirect(['/assinatura/' . $model->code]);
                                    
                                    # CREATE USER ERROR
                                    } else {
                                        $model->erro = $create_app_user;
                                        $model->save();
                                        
                                        $this->view->title = Yii::$app->name . ' - Assinar - Erros';
                                        return $this->render('assinar', [
                                                'model' => $model
                                            ,   'dados' => Yii::$app->request->post('Requests')
                                            ,   'cliente' => $cliente
                                            ,   'cidades' => $cidades
                                            ,   'estados' => $estados
                                            ,   'branches' => $branches
                                            ,   'sectors' => $sectors
                                            ,   'erros' => $erros
                                        ]);
                                    }
                                        
                                } else {
                                    # DELETE COMPANY
                                    \Yii::$app->db->createCommand()->delete('companies', ['code' => $companies_model->code])->execute();

                                    # REVERTE CPF
                                    $client->client_id = $cliente->client_id;
                                    $client->save();

                                    $erros = '<font color="red"><b>ATENÇÃO! Foram encontrados os seguintes erros:</b></font><br /><br />';
                                    for($i = 0 ; $i < count($pagamento['errors']) ; $i++)
                                    {
                                        $erros .= '* ' .  ($pagamento['errors'][$i]['description']) . '<br />';
                                    }

                                    $model->erro = $erros;
                                    $model->status = 2;
                                    $model->save();
                                    
                                    $this->view->title = Yii::$app->name . ' - Assinar - Erros';
                                    return $this->render('assinar', [
                                            'model' => $model
                                        ,   'dados' => Yii::$app->request->post('Requests')
                                        ,   'cliente' => $cliente
                                        ,   'cidades' => $cidades
                                        ,   'estados' => $estados
                                        ,   'branches' => $branches
                                        ,   'sectors' => $sectors
                                        ,   'erros' => $erros
                                    ]);
                                }
                            
                            # PLANO GRATUITO
                            } else if($post['plano'] == 'plano-gratuito') {
                                $assinatura = RequestsExt::findById($model->code, $model->client);
                                    
                                # MOIP CUSTOMER ID
                                $client->moip_customer_code = $moip_customer_code;
                                $client->save();
                                
                                # CREATE APP USER
                                $moip = new Moip;
                                $create_app_user = $moip->createAppUser($assinatura, $post['senha']);

                                if($create_app_user == 'true')
                                {
                                    # SEND EMAIL #
                                    $subject = Yii::$app->params['mail_subject'] . ' - Assinatura Gratuita Efetuada #' . $model->code_alias;
                                    $recover_html = $this->renderPartial('/mail/assinatura',['assinatura' => $assinatura, 'subject' => $subject]);
                                    
                                    CustomHelper::sendEmail
                                    (
                                            Yii::$app->params['mail_ceo'] # FROM
                                        , 	$user->email # TO
                                        , 	$subject # SUBJECT
                                        , 	'' # TEXT BODY
                                        , 	$recover_html # HTML
                                    );

                                    Yii::$app->session->setFlash('sucesso', 'ASSINATURA GRATUITA EFETUADA COM SUCESSO!');
                                    return $this->redirect(['/assinatura/' . $model->code]);
                                    
                                    # CREATE USER ERROR
                                } else {
                                    $model->erro = $create_app_user;
                                    $model->save();
                                    
                                    $this->view->title = Yii::$app->name . ' - Assinar - Erros';
                                    return $this->render('assinar', [
                                            'model' => $model
                                        ,   'dados' => Yii::$app->request->post('Requests')
                                        ,   'cliente' => $cliente
                                        ,   'cidades' => $cidades
                                        ,   'estados' => $estados
                                        ,   'branches' => $branches
                                        ,   'sectors' => $sectors
                                        ,   'erros' => $create_app_user
                                    ]);
                                }
                            } # FIM PROCESSA PLANO POR TIPO
            
                        } else {
                            # DELETE COMPANY
                            \Yii::$app->db->createCommand()->delete('companies', ['code' => $companies_model->code])->execute();

                            # RENDER
                            $this->view->title = Yii::$app->name . ' - Assinar - Erros';
                            return $this->render('assinar', [
                                    'model' => $model
                                ,   'dados' => Yii::$app->request->post('Requests')
                                ,   'cliente' => $cliente
                                ,   'cidades' => $cidades
                                ,   'estados' => $estados
                                ,   'branches' => $branches
                                ,   'sectors' => $sectors
                                ,   'class_errors_users' => $model->errors
                            ]);
                        } # FIM SAVE PLANO

                    } else {
                        $this->view->title = Yii::$app->name . ' - Assinar - Erros';
                        return $this->render('assinar', [
                                'model' => $model
                            ,   'dados' => Yii::$app->request->post('Requests')
                            ,   'cliente' => $cliente
                            ,   'cidades' => $cidades
                            ,   'estados' => $estados
                            ,   'branches' => $branches
                            ,   'sectors' => $sectors
                            ,   'class_errors_companies' => $companies_model->errors
                        ]);
                    } # FIM SAVE EMPRESAS
                } # FIM VALIDATE EMPRESAS
            } # FIM VALIDATE POST            
        }# FIM POST

        # PLANO
        if(isset($_REQUEST['plano']))
        {
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => '_siteRDOplano',
                'value' => $_REQUEST['plano'] ,
            ]));
        }
        
        if (Yii::$app->user->isGuest) 
		{
            return $this->redirect(['/login']);
        }
        
		## RENDER ##
		$this->view->title = Yii::$app->name . ' - Assinar';
        return $this->render('assinar', [
                'model' => $model
            ,   'dados' => Yii::$app->request->post('Requests')
            ,   'cliente' => $cliente
            ,   'cidades' => $cidades
            ,   'estados' => $estados
            ,   'branches' => $branches
            ,   'sectors' => $sectors
            ,   'erros' => isset($validate_errors) ? $validate_errors : ''
        ]);
    }

	# ASSINATURA #
    public function actionAssinatura()
    {
        # CLASSES
        $model = new Requests;

		# DATA
        $cliente = ClientsExt::findCompleteById(Yii::$app->user->identity->id);

        if (Yii::$app->user->isGuest) 
		{
            return $this->redirect(['/login']);
        
        } else {
            $assinatura = RequestsExt::findById(Yii::$app->request->get('code'), $cliente->code);
            $moip = new Moip;
            $assinatura_moip = $moip->getAssinatura($assinatura->moip_subscription_code);
            $faturas = $moip->listFaturas($assinatura->moip_subscription_code);
        }
        
		## PAGE TITLE ##
		$this->view->title = Yii::$app->name . ' - Assinatura';
        return $this->render('assinatura', ['model' => $model, 'assinatura' => $assinatura, 'status_moip' => $assinatura_moip['status'], 'faturas' => $faturas['invoices']]);
    }

    # ASSINATURAS #
    public function actionAssinaturas()
    {
        # CLASSES
        $model = new Requests;

		# DATA
        if (Yii::$app->user->isGuest) 
		{
            return $this->redirect(['/login']);
        
        } else {
            $assinaturas = RequestsExt::findAllById(Yii::$app->user->identity->id);
        }

        ## PAGE TITLE ##
        $this->view->title = Yii::$app->name . ' - Requests';
        return $this->render('assinaturas', ['assinaturas' => $assinaturas]);
    }
        
}
