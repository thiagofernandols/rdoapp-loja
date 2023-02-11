<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\Contato;
use app\helpers\CustomHelper;
use app\models\extension\ClientesExt;
use app\models\extension\MailingExt;

class ContatoController extends Controller
{
	##### BEHAVIORS #####
    public function behaviors()
    {
        return [
            'access' => 
			[
                'class' => AccessControl::className(),
                'only' => 	[
									'contato'
							],
                'rules' => [
                    [
                        'actions' => [		
											'contato'
									 ],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
											'contato'
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
	
    public function actionContato()
    {
		# PAGE TITLE #
		$this->view->title = Yii::$app->name . ' - Contato';
		
		# CLASSES #
        $contato_model = new Contato;

        # DADOS
        if (!Yii::$app->user->isGuest && Yii::$app->request->get('cliente_id'))
        {
            $subject = Yii::$app->params['mail_subject'] . ' - Solicitação de Cancelamento';
            
        } else {
            $subject = Yii::$app->params['mail_subject'] . ' - Contato';
        }

		# POST #
        if(Yii::$app->request->post())
		{
            if(!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
                $recaptcha = false;

            } else {
                $recaptcha = CustomHelper::validateRecaptcha($_POST['g-recaptcha-response']);                
            }

			# VALIDATE #
			if ($contato_model->load(Yii::$app->request->post()) && $contato_model->validate() && $recaptcha) 
			{				
				# ATRIBUTES #
				$contato_model->attributes = Yii::$app->request->post();
				
				# SAVE #
				if ($contato_model->save()) 
				{
                    # SEND EMAIL #                    
					$recover_html = $this->renderPartial('/mail/contato',['dados' => $contato_model, 'subject' => $subject]);
					
					CustomHelper::sendEmail
					(
							Yii::$app->params['mail_sac'] # FROM
						, 	$contato_model->email # TO
						, 	$subject # SUBJECT
						, 	'' # TEXT BODY
						, 	$recover_html # HTML
					);
							
					# NEWSLETTER #
					if(Yii::$app->request->post('newsletter'))
					{
						MailingExt::CadastrarNews($contato_model->nome, $contato_model->email);
					}
					Yii::$app->session->setFlash('sucesso', 'Mensagem enviada com sucesso');
					return $this->redirect(['/contato']);
					
				} else {
					throw new \yii\web\BadRequestHttpException('Não foi possível enviar seus dados, tente novamente mais tarde.', 500);
				}

			} else {
                if(!$recaptcha)
                {
                    return $this->render('/site/contato',['dados' => Yii::$app->request->post("Contato"), 'class_errors' => array(array(0 => 'Validação do reCAPTCHA falhou, por favor, tente de novo.'))]);
                
                } else {
                    return $this->render('/site/contato',['dados' => Yii::$app->request->post("Contato"), 'class_errors' => $contato_model->errors]);
                }
			}			
        }
		
		# RENDER #
        return $this->render('/site/contato', ['dados' => isset($cliente) ? $cliente : '']);
    }
}
