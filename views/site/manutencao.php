<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
?>
<html lang="<?php echo  Yii::$app->language;?>" dir="ltr" xmlns:fb="http://ogp.me/ns/fb#" itemscope itemtype="http://schema.org/Organization">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php echo Html::csrfMetaTags();?>
    <title><?php echo Html::encode($this->title);?></title>	
    <?php $this->head()?>
    <meta charset="<?php echo  Yii::$app->charset;?>">
    <meta name="googlebot" content="index,follow">
    <meta name="google-site-verification" content="" />
    <meta name="author" content="">
    <meta name="description" content="<?php echo Yii::$app->params['site_descrition'];?>" />
    <meta name="keywords" content="<?php echo Yii::$app->params['site_keywords'];?>" />
    <meta name="distribution" content="Global">
    <meta name="designer" content="<?php echo Yii::$app->params['site_designer'];?>">
    <meta name="developer" content="<?php echo Yii::$app->params['site_developer'];?>">
    <meta name="reply-to" content="<?php echo Yii::$app->params['mail_ceo'];?>">
    <meta name="rating" content="General">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta itemprop="name" content="<?php echo Html::encode($this->title);?>">
    <meta itemprop="url" content="<?php echo Yii::$app->params['pathUrlWeb']. ltrim($_SERVER['REQUEST_URI'], '/');?>">	
    <meta itemprop="description" content="<?php echo Yii::$app->params['site_descrition'];?>">
    <meta itemprop="image" content="<?php echo Yii::$app->params['site_image'];?>">
	<meta property="og:locale" content="pt_BR" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="<?php echo Yii::$app->name;?>" />
	<meta property="og:title" content="<?php echo Html::encode($this->title);?>" />
	<meta property="og:url" content="<?php echo Yii::$app->params['pathUrlWeb']. ltrim($_SERVER['REQUEST_URI'], '/')?>" />
	<meta property="og:image" content="<?php echo Yii::$app->params['site_image'];?>" />
	<meta property="og:image:secure_url" content="<?php echo Yii::$app->params['site_image'];?>" />
	<meta property="og:image:width" content="200" />
	<meta property="og:image:height" content="200" />
	<meta property="og:description" content="<?php echo Yii::$app->params['site_descrition'];?>" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:description" content="<?php echo Yii::$app->params['site_descrition'];?>" />	
	<meta name="twitter:title" content="<?php echo Html::encode($this->title);?>" />
	<meta name="twitter:image" content="<?php echo Yii::$app->params['site_image'];?>" />
    <link rel="icon" type="image/x-icon" sizes="16x16" href="<?php echo Yii::$app->params['pathUrlImages'];?>favicon.ico" width="290" height="68">
    <link rel="shortcut icon" href="<?php echo Yii::$app->params['pathUrlImages'];?>favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/reset.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/default.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/materialdesignicons.min.css"><!-- FONT/ICONS -->
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/font/style.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/jquery.fancybox.min.css"><!-- FancyBox -->
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/style.css?v04">
    <link href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/jquery_validator.css" rel="stylesheet">
	<script src="<?php echo Yii::$app->params['pathUrlWeb'];?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->params['pathUrlWeb'];?>js/jquery-2.0.3.min.js"></script>
</head>

<body>

<style type="text/css">#rodape{display:none;}</style>

    <main id="main" class="interna acesso login">
        <article id="st-in-acesso">
            <section class="centro">
                <a href="<?=Yii::$app->params['pathUrlWeb']?>">
                    <img src="<?php echo Yii::$app->params['pathUrlImages']?>logo-rdo-120x120.png" class="logo" alt="Logo RDO" />
                </a>
                <div class="telaacesso">
                    <div class="tit">
                        <i class="mdi mdi-lock-open"></i> <span>Site em Manutenção</span>
                    </div>
                </div>
            </section>
        </article>
    </main>
</body>
</html>