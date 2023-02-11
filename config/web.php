<?php
// Yii::setAlias('Moip', 'C:/xampp/htdocs/__projetos/_rdo/local/vendor/moip/src');
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$db_dev = require __DIR__ . '/db_devel.php';
$db_test = require __DIR__ . '/db_test.php';

###### PROD ######
$config = [
    'id' => 'RDO',
    'name' => 'RDO App',
	'language'=>'pt-BR',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        // '@Moip'   => '@vendor/moip/',
        // '@Moip'   => '@vendor/moip/src',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dlrgP-M_plWG8Oe0ZWOoAbkV27Rj6n5c',
        ],
        // 'view' => [
            // 'class' => 'app\components\View',
        // ],
		'menu' => [
			'class' => 'app\components\Menu',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\extension\UsersExt',
            'enableAutoLogin' => true,
            'loginUrl'=>'/login',
            'identityCookie' => [
                'name' => '_siteRDO',//change this
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'smtp.rdoapp.com.br',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
				'username' => 'contato@rdoapp.com.br',
				'password' => 'Rdo@3010871',
				'port' => '587', // Port 25 is a very common port too
                // 'encryption' => 'tls',

				# GMAIL	 
				// 'encryption' => 'ssl', // It is often used, check your provider or mail server specs
				// 'streamOptions' => 
				// [ 
				// 'ssl' => [ 
				// 'allow_self_signed' => true,
				// 'verify_peer' => false,
				// 'verify_peer_name' => false,
				// ],
				// ],
			],			            
			// send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'baseUrl' => __PATHURLWEB__,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				# GENERAL
                __PATHURI__ . 'minify/<group:[^\/]+>' => 'minify/index',
				 
				# SITE
				__PATHURI__ . '/' => 'site/index',
				__PATHURI__ . '/login' => 'site/login',
				__PATHURI__ . '/downloads' => 'site/downloads',
				__PATHURI__ . '/faq' => 'site/faqs',
				__PATHURI__ . '/funcionalidades' => 'site/funcionalidades',
				__PATHURI__ . '/sistema' => 'site/sistema',
				__PATHURI__ . '/precos' => 'site/precos',
				__PATHURI__ . '/tutoriais' => 'site/tutoriais',
				__PATHURI__ . '/logout' => 'site/logout',
                __PATHURI__ . '/lista-cidades' => 'site/lista-cidades',
                __PATHURI__ . '/lista-estado-cidade/' => 'site/lista-estado-cidade',
				 
				# ASSINATURAS
				__PATHURI__ . '/assinar/<plano>' => 'requests/assinar',
				__PATHURI__ . '/assinatura/<code>' => 'requests/assinatura',
				__PATHURI__ . '/assinaturas' => 'requests/assinaturas',
				
				# CONTATO
				__PATHURI__ . '/contato' => 'contato/contato',
				__PATHURI__ . '/newsletter' => 'site/newsletter',
				
				# CLIENTES
				__PATHURI__ . '/minha-conta' => 'clients/minha-conta',
				__PATHURI__ . '/cadastro' => 'users/cadastro',
				__PATHURI__ . '/recover' => 'users/recover',
                __PATHURI__ . '/redefinir-senha/<senha_recover>' => 'users/redefinir-senha',
                
				# PAGAMENTO
				__PATHURI__ . '/pagamento' => 'pagamentos/pagamento',
            ]
        ]		
    ],
	// 'as AccessBehavior' => [
		// 'class'         => 'app\components\AccessBehavior',
		// 'allowedRoutes' => [
			// '/index.php?r=site/recover',
			// '/index.php?r=site/login','/index.php?r=site/recover',
			// ['/index.php?r=site/recover'],
		// ],
		//'redirectUri' => '/'
	// ],	
    'params' => $params,
];

###### DEV ######
if (YII_ENV_DEV) 
{
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['components']['db'] = $db_dev;
}

###### LOCAL ######
if (YII_ENV_TEST) 
{
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['components']['db'] = $db_test;
}

return $config;
