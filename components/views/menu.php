<style type="text/css">
	/*#rodape{display:none;}*/
	#st-in-acesso form label{height:40px;}
	#st-in-acesso form label .box{padding:10px 0;}
	.error-content{display:block;margin-top:20px;}
	.error-content .error-name{padding:10px;font-size:12px;color:#fff;font-weight:bold;}
	.error-content .error-item{padding:10px;font-size:12px;color:#fff;}
	.g-recaptcha{width:100%;text-align:center;margin-top:20px;}
    .g-recaptcha>div{margin:0 auto !important;}
</style>

	<? 	###### CONTATO ###### ?>
	<div id="contato1-frame" class="contato-frame effect1">
		<div class="bg effect"></div>
		<div class="conteudo">
			<a href="#!" class="fechar effect">X</a>
			<span></span>
			<div class="conteudoint">
				<div class="tit"><i class="mdi mdi-mail"></i> <span>Contate-nos</span></div>
				<div class="txt">
				</div>
                <form class="form f-contato" id="contato-form" action="<?=Yii::$app->params['pathUrlWeb']?>contato" method="post">
					<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
					<input type="hidden" name="Contato[assunto]" value="FORM EXPANSIVEL" />
					<label>
						<input type="text" name="Contato[nome]" class="box effectp5" placeholder="Nome" data-validation-engine="validate[required]" >
					</label>
					<label>
						<input type="text" name="Contato[email]" class="box effectp5" placeholder="E-mail" data-validation-engine="validate[required,custom[email]]" >
					</label>
					<label>
						<input type="text" name="Contato[telefone]" class="box effectp5" placeholder="Telefone" data-validation-engine="validate[required]" data-mask-telephone >
					</label>
					<label>
						<input type="text" name="Contato[cidade]" class="box effectp5" placeholder="Cidade" data-validation-engine="validate[required]" >
					</label>
					<label>
						<select id="estado" name="Contato[sigla]" class="box effectp5" data-validation-engine="validate[required]" >
							<option value="">Estado</option>
							<option value="AC" <?=$dados['estado'] == 'AC' ? 'selected' : ''?>>Acre</option>
							<option value="AL" <?=$dados['estado'] == 'AL' ? 'selected' : ''?>>Alagoas</option>
							<option value="AP" <?=$dados['estado'] == 'AP' ? 'selected' : ''?>>Amapá</option>
							<option value="AM" <?=$dados['estado'] == 'AM' ? 'selected' : ''?>>Amazonas</option>
							<option value="BA" <?=$dados['estado'] == 'BA' ? 'selected' : ''?>>Bahia</option>
							<option value="CE" <?=$dados['estado'] == 'CE' ? 'selected' : ''?>>Ceará</option>
							<option value="DF" <?=$dados['estado'] == 'DF' ? 'selected' : ''?>>Distrito Federal</option>
							<option value="ES" <?=$dados['estado'] == 'ES' ? 'selected' : ''?>>Espírito Santo</option>
							<option value="GO" <?=$dados['estado'] == 'GO' ? 'selected' : ''?>>Goiás</option>
							<option value="MA" <?=$dados['estado'] == 'MA' ? 'selected' : ''?>>Maranhão</option>
							<option value="MT" <?=$dados['estado'] == 'MT' ? 'selected' : ''?>>Mato Grosso</option>
							<option value="MS" <?=$dados['estado'] == 'MS' ? 'selected' : ''?>>Mato Grosso do Sul</option>
							<option value="MG" <?=$dados['estado'] == 'MG' ? 'selected' : ''?>>Minas Gerais</option>
							<option value="PA" <?=$dados['estado'] == 'PA' ? 'selected' : ''?>>Pará</option>
							<option value="PB" <?=$dados['estado'] == 'PB' ? 'selected' : ''?>>Paraíba</option>
							<option value="PR" <?=$dados['estado'] == 'PR' ? 'selected' : ''?>>Paraná</option>
							<option value="PE" <?=$dados['estado'] == 'PE' ? 'selected' : ''?>>Pernambuco</option>
							<option value="PI" <?=$dados['estado'] == 'PI' ? 'selected' : ''?>>Piauí</option>
							<option value="RJ" <?=$dados['estado'] == 'RJ' ? 'selected' : ''?>>Rio de Janeiro</option>
							<option value="RN" <?=$dados['estado'] == 'RN' ? 'selected' : ''?>>Rio Grande do Norte</option>
							<option value="RS" <?=$dados['estado'] == 'RS' ? 'selected' : ''?>>Rio Grande do Sul</option>
							<option value="RO" <?=$dados['estado'] == 'RO' ? 'selected' : ''?>>Rondônia</option>
							<option value="RR" <?=$dados['estado'] == 'RR' ? 'selected' : ''?>>Roraima</option>
							<option value="SC" <?=$dados['estado'] == 'SC' ? 'selected' : ''?>>Santa Catarina</option>
							<option value="SP" <?=$dados['estado'] == 'SP' ? 'selected' : ''?>>São Paulo</option>
							<option value="SE" <?=$dados['estado'] == 'SE' ? 'selected' : ''?>>Sergipe</option>
							<option value="TO" <?=$dados['estado'] == 'TO' ? 'selected' : ''?>>Tocantins</option>
						</select>						
					</label>
					<label>
						<textarea name="Contato[mensagem]" class="box effect" data-validation-engine="validate[required]" placeholder="Mensagem"></textarea>
					</label>
					<label>
                        <center><input type="checkbox" name="newsletter" checked /> <small><font color="white">Desejo receber novidades por e-mail</font></small></center>
					</label>
					<div class="error-content"></div>
					<div class="g-recaptcha" data-sitekey="6Ld8LnoaAAAAAJDUsF3Zh-cSVJicvilaS4IKTc2Z"></div>
					<div class="linhasubmite">
						<input type="submit" name="" value="Enviar" class="bt-salvar effectp5" id="contato-bt" />
						<hr class="linha" />
					</div>
				</form>
			</div>
		</div>
	</div>
	<header id="topo" class="effectp5">
		<div class="w1280">
			<nav class="effectp5">
				<ul class="menu effectp5">
					<li class="link effectp5"><a href="<?=Yii::$app->params['pathUrlWeb']?>" class="effectp5"><i class="mdi mdi-home effectp5"></i>Home</a></li>
					<li class="link effectp5"><a href="<?=Yii::$app->params['pathUrlWeb']?>funcionalidades" class="effectp5"><i class="mdi mdi-hammer-wrench effectp5"></i>Funcionalidades</a></li>
					<li class="link effectp5"><a href="<?=Yii::$app->params['pathUrlWeb']?>precos" class="effectp5"><i class="mdi mdi-star effectp5"></i>Preços</a></li>
					<li class="link effectp5 menu-sup">
						<a class="effectp5 bt-menu-sup"><i class="mdi mdi-face-agent effectp5"></i>Suporte</a>
						<a class="sublink effectp5 contato1">Contato</a>
						<a href="<?=Yii::$app->params['pathUrlWeb']?>downloads" class="sublink effectp5">Downloads</a>
						<a href="<?=Yii::$app->params['pathUrlWeb']?>faq" class="sublink effectp5">FAQ</a>
						<a href="<?=Yii::$app->params['pathUrlWeb']?>tutoriais" class="sublink effectp5">Tutoriais</a>
					</li>
				</ul>
				<a href="<?=Yii::$app->params['pathUrlWeb']?>"><img src="<?=Yii::$app->params['pathUrlImages']?>logo-rdo-120x120.png" class="logo effectp5" alt="Logo RDO" /></a>
				<ul class="acessos effectp5">
				<?php
					if(!Yii::$app->user->isGuest && Yii::$app->request->cookies->has('_siteRDO'))
					{
				?>
					<li class="link effectp5"><a href="<?=Yii::$app->params['pathUrlWeb']?>minha-conta" class="effectp5"><i class="mdi mdi-account effectp5"></i>Conta</a></li>
				<?php	} else { ?>
					<li class="link effectp5"><a href="<?=Yii::$app->params['pathUrlWeb']?>login" class="effectp5"><i class="mdi mdi-lock-open effectp5"></i>Login</a></li>
				<?php	} ?>
					<li class="link effectp5">
						<a href="
						<?//=Yii::$app->params['pathUrlWeb'] . 'sistema'?>
						https://sistema.rdoapp.com.br/login
						" target="_blank" class="effectp5">
							<i class="mdi mdi-open-in-app effectp5"></i>Sistema
						</a>
					</li>
				<?php
					if(!Yii::$app->user->isGuest && Yii::$app->request->cookies->has('_siteRDO'))
					{
				?>
					<li class="link effectp5"><a href="<?=Yii::$app->params['pathUrlWeb']?>logout" class="effectp5"><i class="mdi mdi-power effectp5"></i>Sair</a></li>
				<?php	} ?>
				</ul>
				<a href="https://wa.me/55<?=preg_replace("/[^0-9]/","",Yii::$app->params['fone_whatsapp'])?>" class="whatsapp effectp5" target="_blank"><img src="<?=Yii::$app->params['pathUrlImages']?>ico-whatsapp.png" class="effectp5" /><span>WHATSAPP</span><?=Yii::$app->params['fone_whatsapp']?></a></li>
				<div id="menu2" class="effectp2 fechado">
					<a class="ico-menu effectp2"><i class="mdi mdi-dots-vertical"></i></a>
					<a href="<?=Yii::$app->params['pathUrlWeb']?>" class="op-menu effectp2"><i class="mdi mdi-home effectp2"></i> Home</a>
					<a href="<?=Yii::$app->params['pathUrlWeb']?>funcionalidades" class="op-menu effectp2"><i class="mdi mdi-hammer-wrench effectp2"></i> Funcionalidades</a>
					<a href="<?=Yii::$app->params['pathUrlWeb']?>precos" class="op-menu effectp2"><i class="mdi mdi-star effectp2"></i> Preços</a>
					<a class="op-menu effectp2 contato1"><i class="mdi mdi-mail effectp2"></i> Contato</a>
					<a href="<?=Yii::$app->params['pathUrlWeb']?>downloads" class="op-menu effectp2"><i class="mdi mdi-download effectp2"></i> Downloads</a>
					<a href="<?=Yii::$app->params['pathUrlWeb']?>faq" class="op-menu effectp2"><i class="mdi mdi-forum effectp2"></i> FAQ</a>
					<a href="<?=Yii::$app->params['pathUrlWeb']?>tutoriais" class="op-menu effectp2"><i class="mdi mdi-play-box-outline effectp2"></i> Tutoriais</a>
					<?php
								if(!Yii::$app->user->isGuest && Yii::$app->request->cookies->has('_siteRDO'))
								{
					?>
					<a href="<?=Yii::$app->params['pathUrlWeb']?>minha-conta" class="op-menu effectp2"><i class="mdi mdi-account effectp2"></i> Conta</a>
					<?php	} else { ?>
					<a href="<?=Yii::$app->params['pathUrlWeb']?>login" class="op-menu effectp2"><i class="mdi mdi-lock-open effectp2"></i> Login</a>
					<?php	} ?>
					<a href="<?//=Yii::$app->params['pathUrlWeb'] . 'sistema'?>
						https://sistema.rdoapp.com.br/login"
						target="_blank" class="op-menu effectp2">
						<i class="mdi mdi-open-in-app effectp2"></i> Sistema
					</a>
				<?php
					if(!Yii::$app->user->isGuest && Yii::$app->request->cookies->has('_siteRDO'))
					{
				?>
					<a href="<?=Yii::$app->params['pathUrlWeb']?>logout" class="op-menu effectp2"><i class="mdi mdi-power effectp2"></i> Sair</a>
				<?php	} ?>
				</div>
			</nav>
		</div>
	</header>
	<?php	if(Yii::$app->session->hasFlash('sucesso_login')):
	?>
	<div id="alerta" class="alerta-logado">Você está logado!</div>
	<?php endif;?>