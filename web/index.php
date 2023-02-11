<?php

###### LOCAL ######
if (strstr($_SERVER['HTTP_HOST'], "local.rdo.com.br"))
{
	define('__PATHSYSROOT__', 'C:\xampp\htdocs\__projetos\_rdo\local\\');
	define('__PATHSYSASSETS__', 'C:\xampp\htdocs\__projetos\_rdo\local\web\assets\\');
	define('__PATHURLWEB__', 'http://local.rdo.com.br/');
	define('__PATHURLIMAGES__', 'http://local.rdo.com.br/assets/images/');
	define('__PATHURI__', '');
	define('__PATHURLADM__', 'http://local.rdoadm.com.br/');
	defined('YII_DEBUG') or define('YII_DEBUG', true);
	defined('YII_ENV_TEST') or define('YII_ENV_TEST', 'test');
		
###### DEV ######
} else if (strstr($_SERVER['HTTP_HOST'], "rdo.asprana.com.br")) {
    define('__PATHSYSROOT__', '/asprana/data/domains/www.asprana.com.br/htdocs/sites/rdo/');
	define('__PATHSYSASSETS__', '/asprana/data/domains/www.asprana.com.br/htdocs/sites/rdo/web/assets/');
    define('__PATHURLWEB__', 'http://rdo.asprana.com.br/');
	define('__PATHURLIMAGES__', 'http://rdo.asprana.com.br/assets/images/');
	define('__PATHURI__', '');
	define('__PATHURLADM__', 'http://www.asprana.com.br/administrador/rdo/web/');
	defined('YII_DEBUG') or define('YII_DEBUG', true);
	defined('YII_ENV_DEV') or define('YII_ENV_DEV', 'dev');
		
###### PROD ######
} else {
    define('__PATHSYSROOT__', '/var/www/html/Public/www/');
	define('__PATHSYSASSETS__', '/var/www/html/Public/www/web/assets/');
    define('__PATHURLWEB__', 'https://loja.rdoapp.com.br/');
	define('__PATHURLIMAGES__', 'https://loja.rdoapp.com.br/assets/images/');
	define('__PATHURI__', '');
	define('__PATHURLADM__', 'http://www.asprana.com.br/administrador/rdo/web/');
	#defined('YII_DEBUG') or define('YII_DEBUG', true);
	#defined('YII_ENV_DEV') or define('YII_ENV_TEST', 'test');
}

###### LOAD APPLICATION ######
require __PATHSYSROOT__ . 'vendor/autoload.php';
require __PATHSYSROOT__ . 'vendor/yiisoft/yii2/Yii.php';

$config = require __PATHSYSROOT__ . 'config/web.php';

(new yii\web\Application($config))->run();
