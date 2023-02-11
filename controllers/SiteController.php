<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;
use app\models\Mailing;
use app\models\Cidades;
use app\models\Estados;
use app\models\extension\CitiesExt;
use app\models\extension\DownloadsExt;
use app\models\extension\FaqsExt;
use app\models\extension\TutoriaisExt;
use app\models\extension\MailingExt;
use app\models\extension\ClientesExt;
use app\helpers\CustomHelper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
	# BEHAVIORS #
    public function behaviors()
    {
        return [
            'access' => 
			[
                'class' => AccessControl::className(),
                'only' => 	[
									'login'
								,	'recover'
								,	'logout'
								,	'index'
								,	'downloads'
								,	'faq'
								,	'funcionalidades'
								,	'sistema'
								,	'precos'
								,	'tutorias'
								,	'contato'
								,	'newsletter'
								,	'lista-estado-cidade'
							],
                'rules' => [
                    [
                        'actions' => [		
											'login'
										,	'recover'
										,	'logout'
										,	'index'
										,	'downloads'
										,	'faq'
										,	'funcionalidades'
										,	'sistema'
										,	'precos'
										,	'tutorias'
										,	'contato'
										,	'newsletter'
										,	'lista-estado-cidade'
									 ],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
											'login'
										,	'logout'
										,	'index'
										,	'downloads'
										,	'faq'
										,	'funcionalidades'
										,	'sistema'
										,	'precos'
										,	'tutorias'
										,	'contato'
										,	'newsletter'
										,	'lista-estado-cidade'
										
										# 	LOGGED IN
										,	'historico'
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
	
	# HOME #
    public function actionIndex()
    {
		## PAGE TITLE ##
        $this->view->title = Yii::$app->name . ' - Home';
        # MANUTENCAO
        // if(CustomHelper::getRealIpAddr())
        // {
        //     return $this->render('index');

        // } else {
        //     return $this->render('manutencao');
        // }

        return $this->render('index');
    }
	
	# DOWNLOADS #
    public function actionDownloads()
    {
		## PAGE TITLE ##
        $this->view->title = Yii::$app->name . ' - Downloads';
        
        $downloads = DownloadsExt::LoadDownloads();

        return $this->render('downloads', ['downloads' => $downloads]);
    }
	
	# FAQ #
    public function actionFaqs()
    {
		## PAGE TITLE ##
        $this->view->title = Yii::$app->name . ' - FAQ';
        
        $faqs = FaqsExt::LoadFaqs();

        return $this->render('faqs', ['faqs' => $faqs]);
    }
	
	# FUNCIONALIDADES #
    public function actionFuncionalidades()
    {
		## PAGE TITLE ##
		$this->view->title = Yii::$app->name . ' - Funcionalidades';
        return $this->render('funcionalidades');
    }
	
	# SISTEMA #
    public function actionSistema()
    {
		## PAGE TITLE ##
		$this->view->title = Yii::$app->name . ' - Sistema';
        return $this->render('sistema');
    }
	
	# PRECOS #
    public function actionPrecos()
    {
		## PAGE TITLE ##
		$this->view->title = Yii::$app->name . ' - Preços';
        return $this->render('precos');
    }
	
	# TUTORIAIS #
    public function actionTutoriais()
    {
		## PAGE TITLE ##
        $this->view->title = Yii::$app->name . ' - Tutoriais';
        
        $tutoriais = TutoriaisExt::LoadTutoriais();

        return $this->render('tutoriais',['tutoriais' => $tutoriais]);
    }
	
	# CONTATO #
    public function actionContato()
    {
		## PAGE TITLE ##
		$this->view->title = Yii::$app->name . ' - Contato';
        return $this->render('contato');
    }
	
	# LOGIN #
    public function actionLogin()
    {
		## PAGE TITLE ##
		$this->view->title = Yii::$app->name . ' - Login';
        if (!Yii::$app->user->isGuest) 
		{
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) 
		{
            $cookies = Yii::$app->response->cookies;
            Yii::$app->session->setFlash('sucesso_login');
            if ($cookies->has('_siteRDOplano'))
            {
                return $this->redirect(['/carrinho']);
                
            } else {
                return $this->goBack();
            }
        }

        $model->password = '';
		
        return $this->render('login', [
            'model' => $model,
        ]);
    }

	# ERRO #
    public function actionError() 
	{
		## PAGE TITLE ##
		$this->view->title = Yii::$app->name . ' - Erro';
				
		$exception = Yii::$app->errorHandler->exception;
		
		if ($exception !== null)
		{
			$statusCode = $exception->statusCode;
			$name = $exception->getName();
			$message = $exception->getMessage();

			return $this->render('error', [
				'exception' => $exception,
				'statusCode' => $statusCode,
				'name' => $name,
				'message' => $message
			]);
		}
	
    }
	
	# LOGOUT #
    public function actionLogout()
    {
        Yii::$app->user->logout();

        $cookies = Yii::$app->response->cookies;
        $cookies->remove('_siteRDOplano');

        return $this->goBack('/login');
    }
	
    public function actionListaEstadoCidade() 
	{
        $request = Yii::$app->request;
        $post    = $request->post();
    
        if ($request->isAjax)
        {
            $localizacao = CitiesExt::LoadCidade('nome', (isset($_POST['cidade']) ? $_POST['cidade'] : ''), (isset($_POST['state']) ? $_POST['state'] : ''));
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            return  [
                            'state' => $localizacao->state
                        ,   'abbr' => $localizacao->abbr
                        ,   'city' => $localizacao->city
                        ,   'code' => $localizacao->code
                    ];
        }
    }

    public function actionListaCidades() 
	{
        $request = Yii::$app->request;
        $post    = $request->post();
    
        if ($request->isAjax)
        {
            $cidades = CitiesExt::LoadCidadesPorEstado($_POST['estado_id']);
            
            return $this->renderPartial('lista-cidades', array('cidades' => $cidades));
        }
    }

    public function actionNewsletter()
    {
		# CLASSES #
        $model = new Mailing;
        $post = Yii::$app->request->post('Mailing');

		# POST #
        if($post)
		{
			# VALIDATE #
			if ($model->validate()) 
			{			
                if(MailingExt::CadastrarNews('', $post['email']))
                {
                    Yii::$app->session->setFlash('sucesso_newsletter', 'E-mail salvo com sucesso!');

                } else {
                    Yii::$app->session->setFlash('erro_newsletter', 'Não foi possível cadastrar, tente novamente mais tarde.');
                }
            }
        }
        return $this->redirect(['/']);
    }
	
#################


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

}
