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
    <!-- Google Analytics -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-127752441-1', 'auto');
    ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->
    <link rel="icon" type="image/x-icon" sizes="16x16" href="<?php echo Yii::$app->params['pathUrlImages'];?>favicon.ico" width="290" height="68">
    <link rel="shortcut icon" href="<?php echo Yii::$app->params['pathUrlImages'];?>favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/reset.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/default.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/materialdesignicons.min.css"><!-- FONT/ICONS -->
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/font/style.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/jquery.fancybox.min.css"><!-- FancyBox -->
    <link rel="stylesheet" href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/style.css?v05">
    <link href="<?php echo Yii::$app->params['pathUrlWeb'];?>css/jquery_validator.css" rel="stylesheet">
	<script src="<?php echo Yii::$app->params['pathUrlWeb'];?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->params['pathUrlWeb'];?>js/jquery-2.0.3.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
<?php 	###### MENU ###### ?>
<?php echo Yii::$app->menu->run(); ?>
		
	
	<div id="main-wrapper">
		<div class="page-wrapper">
			<hr />
			<?php echo $content; ?>

		</div>
	</div>

    <footer id="rodape">
        <div class="logoin">
            <a href="<?php echo Yii::$app->params['pathUrlWeb'];?>">
                <img src="<?php echo Yii::$app->params['pathUrlImages'];?>logo-rdo-120x120.png" class="logo" />
            </a>
        </div>
        <?php /*
        <div class="contato">
            <div class="box1">
                <a href="tel:+55<?php echo preg_replace("/[^0-9]/","",Yii::$app->params['fone_sac'])?>" class="effectp5" target="_blank"><?php echo Yii::$app->params['fone_sac'];?></a>
                <a href="mailto:<?php echo Yii::$app->params['mail_sac'];?>" class="effectp5" target="_blank"><?php echo Yii::$app->params['mail_sac'];?></a>
            </div>
            <div class="box2">
                <?php echo Yii::$app->params['address'];?> - Bairro: <?php echo Yii::$app->params['district'];?><br> <?php echo Yii::$app->params['city'];?>/<?php echo Yii::$app->params['state'];?> - <?php echo Yii::$app->params['zipcode'];?>
            </div>
        </div>
        */?>
        <ul class="list-redes contato">
            <li class="li-rede  box1">
                <a href="tel:+55<?php echo preg_replace("/[^0-9]/","",Yii::$app->params['fone_sac']);?>" class="effectp5" target="_blank"><?php echo Yii::$app->params['fone_sac'];?></a>
                <a href="mailto:<?php echo Yii::$app->params['mail_sac'];?>" class="effectp5" target="_blank"><?php echo Yii::$app->params['mail_sac'];?></a>
            </li>
            <li class="li-rede effectp5">
                <a href="<?php echo Yii::$app->params['instagram'];?>" target="_blank">
                    <i class="mdi mdi-instagram effectp5"></i>
                </a>
            </li>
            <li class="li-rede effectp5">
                <a href="<?php echo Yii::$app->params['facebook'];?>" target="_blank">
                    <i class="mdi mdi-facebook effectp5"></i>
                </a>
            </li>
            <li class="li-rede effectp5">
                <a href="<?php echo Yii::$app->params['linkedin'];?>" target="_blank">
                    <i class="mdi mdi-linkedin effectp5"></i>
                </a>
            </li>
            <li class="li-rede effectp5">
                <script src="https://platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
                <script type="IN/FollowCompany" data-id="22300740" data-counter="bottom"></script>
                <?php /*
                    Como administrador da página da empresa, a ID da sua empresa pode ser recuperada navegando até a seção de administração da página da empresa. Por exemplo, a página do administrador da empresa no LinkedIn é https://www.linkedin.com/company/1337/admin/. Usaremos o ID da empresa 1337 em nosso exemplo.
                */ ?>
            </li>
        </ul>
        <div class="copyright"><?php echo Yii::$app->params['copyright'];?></div>
    </footer>
    
    <script src="<?php echo Yii::$app->params['pathUrlWeb'];?>js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->params['pathUrlWeb'];?>js/highlight.js"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->params['pathUrlWeb'];?>js/app.js"></script>
	<script type="text/javascript" src="<?php echo  Yii::$app->params['pathUrlWeb'] ?>js/jquery.validationEngine-pt_BR.js"></script>
	<script type="text/javascript" src="<?php echo  Yii::$app->params['pathUrlWeb'] ?>js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo  Yii::$app->params['pathUrlWeb'] ?>js/jquery.meio.mask.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
			$('form').validationEngine();
            $('#alerta').delay(3000).fadeOut();
			$('[data-mask]').each(function(e,f){
				$(f).setMask(f.getAttribute('data-mask'));
			});
			$('[data-mask-credit-card]').each(function(e,f){
				$(f).setMask({
					mask:"9999999999999999999",
					defaultValue: '',
				});
			});
			$('[data-mask-price]').each(function(e,f){
				$(f).setMask({
					mask:"99,999.999.999.99",
					defaultValue: '',
					type : 'reverse'
				});
			});
			$('[data-mask-integer-thousands]').each(function(e,f){
				$(f).setMask({
					mask:"999.999.999.99",
					defaultValue: '',
					type : 'reverse'
				});
			});
            $('[data-mask-telephone]').each(function(e,f){
                var phone_length = $(this).val().replace(/[^0-9]/gi, '').length;
                if(phone_length == 11)
                {
                    $(this).setMask({
                            mask:"(99) 99999-9999",
                            defaultValue: '',
                        });

                } else {
                    $(this).setMask({
                            mask:"(99) 9999-99999",
                            defaultValue: '',
                        });
                }
            });
            $('[data-mask-telephone]').on('keyup', function () {
                var phone_length = $(this).val().replace(/[^0-9]/gi, '').length;
                if(phone_length == 11)
                {
                    $(this).setMask({
                            mask:"(99) 99999-9999",
                            defaultValue: '',
                        });

                } else {
                    $(this).setMask({
                            mask:"(99) 9999-99999",
                            defaultValue: '',
                        });
                }
			});
            var nav = $('#topo');
            var stbanner = $('#st-banner');
            $(window).scroll(function () {
                if ($(this).scrollTop() > 1) {
                    nav.addClass("fixo");
                } else {
                    nav.removeClass("fixo");
                };
                if ($(this).scrollTop() > 200) {
                    stbanner.addClass("rolagem");
                } else {
                    stbanner.removeClass("rolagem");
                };
            });
			$("#recover-form").submit(function(e){
				$('#recover-bt').prop('disabled', true);
				var result = $(this).validationEngine('validate');
				
				if(result)
				{
					$(this).unbind().submit();
					
				} else {
					e.preventDefault();
					$('#recover-bt').prop('disabled', false);
				}
			});
			$("#login-form").submit(function(e){
				$('#login-bt').prop('disabled', true);
				var result = $(this).validationEngine('validate');
				
				if(result)
				{
					$(this).unbind().submit();
					
				} else {
					e.preventDefault();
					$('#login-bt').prop('disabled', false);
				}
			});
			$("#cadastro-form").submit(function(e){
				$('#cadastro-bt').prop('disabled', true);
				var result = $(this).validationEngine('validate');
				
				if(result)
				{
					$(this).unbind().submit();
					
				} else {
					e.preventDefault();
					$('#cadastro-bt').prop('disabled', false);
				}
			});
			$("#assinar-form").submit(function(e){
                $('#assinar-bt').prop('disabled', true);
                var result = $(this).validationEngine('validate');

				if(result)
				{
                    $('#loader').toggleClass('hide');
					$(this).unbind().submit();
					
				} else {
					e.preventDefault();
					$('#assinar-bt').prop('disabled', false);
				}
			});
            $('body').on('blur', '[data-cep-cadastro]', function () {
                /* Preenche os campos com carregando enquanto nao retorna os dados */
                $("#endereco, #bairro").attr('placeholder', "aguarde...");
                /* seta a variavel requisitada no campo cep */
                var cep = $("#postal_code").val().replace('-', '');
                /* Faz a consulta */
                $.getJSON("//viacep.com.br/ws/" + cep + "/json/", function (resultadoCEP) {
                    /* seta as variaveis de retorno */
                    var rua = unescape(resultadoCEP.logradouro);
                    var bairro = unescape(resultadoCEP.bairro);
                    var cidade = unescape(resultadoCEP.localidade);
                    var uf = unescape(resultadoCEP.uf);
                    var _csrf = $('#_csrf').val();

                    /* preenche os campos */
                    if (!("erro" in resultadoCEP)) {
                        var jsonData = $.ajax({
                            url: "/lista-estado-cidade",
                            type: 'POST',
                            data: {_csrf: _csrf, estado: uf, cidade: cidade},
                            dataType: "json",
                            async: false,
                        }).responseText;
                        var obj = jQuery.parseJSON(jsonData);

                        $.post("/lista-cidades", {
                            _csrf: _csrf, estado_id: obj.state
                        }, function (d) {
                            $("[data-cidade]").html(d);
                            /* setInterval(function(){ */
                            $("#street").val(rua);
                            $("#neighborhood").val(bairro);
                            $("#city").val(obj.code);
                            $("#state").val(obj.state);
                            $("#number").focus();
                            /*  },1000); */
                        });

                    } else {
                        $("#endereco").val('');
                        $("#bairro").val('');
                        $("#cidade_id").val('');
                        $("#estado_id").val('');
                        $("#endereco").attr('placeholder', "");
                        $("#bairro").attr('placeholder', "");
                        $("#endereco").focus();
                    }
                });
            });
            $('[data-estado]').on('change', function () {
                var _csrf = $('#_csrf').val();

                $.post("/lista-cidades", {
                    _csrf: _csrf, estado_id: $(this).val()
                }, function (d) {
                    $("[data-cidade]").html(d);
                });
            });
			$('.fechar').click(function(){
                $('.contato-frame').removeClass('open');
                $('.termos-frame').removeClass('open');
			});
            $('.contato1').click(function(){$('#contato1-frame').addClass('open');});
            $('.termos').click(function(){$('#termos-frame').addClass('open');});
			$('.bt-recuperar').click(function(){
				$('.f-recuperar').toggleClass('hide');
				$('.f-acessar').toggleClass('hide');
			});
			$('.bt-cadastrar').click(function(){
				$('.telaacesso').toggleClass('hide');
				$('.telacadastro').toggleClass('hide');
			});
			$('.bt-mudarsenha').click(function(){
				$('.linhaformsenha').toggleClass('hide');
			});
			$('.ico-menu').click(function(){
				$('#menu2').toggleClass("aberto");
				$('#menu2').toggleClass("fechado");
			});
			$('.op-menu').click(function(){
				$('#menu2').toggleClass("aberto");
				$('#menu2').toggleClass("fechado");
			});
        });
        $("#contato-form").submit(function(e){
            $('#contato-bt').prop('disabled', true);
            var result = $(this).validationEngine('validate');
            
            if (grecaptcha.getResponse() == "")
            {
                $('.error-content').html("<table cellpadding='0' cellspacing='0'><tr><td class='error-name ta-r va-t'>Recaptcha</td><td><span class='error-item d-ib'>Clique no reCAPTCHA e confirme que você não é um robô.</span></td></tr></table>");
                $('#error-box').removeClass('d-n');
                $('#contato-bt').prop('disabled', false);
                return false;

            } else if(result) {
                $(this).unbind().submit();
                
            } else {
                e.preventDefault();
                $('#contato-bt').prop('disabled', false);
            }
        });
    </script>
</body>

</html>