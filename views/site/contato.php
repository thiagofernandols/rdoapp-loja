<style type="text/css">
	#rodape{display:none;}
	#st-in-acesso form label{height:40px;}
	#st-in-acesso form label .box{padding:10px 0;}
	.error-content{display:block;margin-top:20px;}
	.error-content .error-name{padding:10px;font-size:12px;color:#fff;font-weight:bold;}
	.error-content .error-item{padding:10px;font-size:12px;color:#fff;}
	.g-recaptcha{width:100%;text-align:center;margin-top:20px;}
    .g-recaptcha>div{margin:0 auto !important;}
</style>

    <main id="main" class="interna acesso login">
        <article id="st-in-acesso">
            <section class="centro">
                <a href="<?=Yii::$app->params['pathUrlWeb']?>" class="bt-voltar effectp5">voltar</a>
                <img src="<?=Yii::$app->params['pathUrlImages']?>logo-rdo-120x120.png" class="logo" alt="Logo RDO" />
                <div class="telacadastro">
                    <div class="tit">
                        <span>Contato</span>
						<?	if(Yii::$app->session->hasFlash('sucesso'))
							{
						?>
						<br /><br />
						<font color="white" size="18px"><?=Yii::$app->session->getFlash('sucesso')?></font><br />
						<?	} ?>
                    </div>
                    <form class="form f-cadastro <?=Yii::$app->session->hasFlash('sucesso') ? 'hide' : ''?>" id="contato-form" action="<?=Yii::$app->params['pathUrlWeb'] . ltrim($_SERVER['REQUEST_URI'], '/')?>" method="post">
						<?	if(isset($class_errors) && !empty($class_errors))
							{
						?>
						<font color="white">ATENÇÃO: Aconteceram os seguintes erros:</font><br /><br />
						<?
								foreach($class_errors as $class_error)
								{
									foreach($class_error as $class_error_each)
									{
						?>
						<font color="white"><?=$class_error_each?></font><br />
						<?			} ?>
						<?		} ?>
						<?	} ?>
						<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
						<input type="hidden" name="Contato[assunto]" value="FORM ESTATICO" />
                        <label class="effectp5">
                            <input type="text" name="Contato[nome]" placeholder="Nome" class="box effectp5" value="<?=isset($dados['nome']) ? $dados['nome'] : ''?>" data-validation-engine="validate[required]" />
                        </label>
                        <label class="effectp5">
                            <input type="text" name="Contato[email]" placeholder="Email" class="box effectp5" value="<?=isset($dados['email']) ? $dados['email'] : ''?>" data-validation-engine="validate[required,custom[email]]" />
                        </label>
                        <label class="effectp5">
                            <input type="text" name="Contato[telefone]" placeholder="Telefone" class="box effectp5" value="<?=isset($dados['telefone']) ? $dados['telefone'] : ''?>" data-validation-engine="validate[required]" data-mask-telephone />
                        </label>
                        <label class="effectp5">
                            <input type="text" name="Contato[cidade]" placeholder="Cidade" class="box effectp5" value="<?=isset($dados['cidade']) ? $dados['cidade'] : ''?>" data-validation-engine="validate[validate[required]" />
                        </label>
                        <label class="effectp5">
							<?	$sigla = isset($dados['sigla']) ? $dados['sigla'] : '';?>
							<select id="sigla" name="Contato[sigla]" class="box effectp5" data-validation-engine="validate[required]" >
								<option value="">Estado</option>
								<option value="AC" <?=$sigla == 'AC' ? 'selected' : ''?>>Acre</option>
								<option value="AL" <?=$sigla == 'AL' ? 'selected' : ''?>>Alagoas</option>
								<option value="AP" <?=$sigla == 'AP' ? 'selected' : ''?>>Amapá</option>
								<option value="AM" <?=$sigla == 'AM' ? 'selected' : ''?>>Amazonas</option>
								<option value="BA" <?=$sigla == 'BA' ? 'selected' : ''?>>Bahia</option>
								<option value="CE" <?=$sigla == 'CE' ? 'selected' : ''?>>Ceará</option>
								<option value="DF" <?=$sigla == 'DF' ? 'selected' : ''?>>Distrito Federal</option>
								<option value="ES" <?=$sigla == 'ES' ? 'selected' : ''?>>Espírito Santo</option>
								<option value="GO" <?=$sigla == 'GO' ? 'selected' : ''?>>Goiás</option>
								<option value="MA" <?=$sigla == 'MA' ? 'selected' : ''?>>Maranhão</option>
								<option value="MT" <?=$sigla == 'MT' ? 'selected' : ''?>>Mato Grosso</option>
								<option value="MS" <?=$sigla == 'MS' ? 'selected' : ''?>>Mato Grosso do Sul</option>
								<option value="MG" <?=$sigla == 'MG' ? 'selected' : ''?>>Minas Gerais</option>
								<option value="PA" <?=$sigla == 'PA' ? 'selected' : ''?>>Pará</option>
								<option value="PB" <?=$sigla == 'PB' ? 'selected' : ''?>>Paraíba</option>
								<option value="PR" <?=$sigla == 'PR' ? 'selected' : ''?>>Paraná</option>
								<option value="PE" <?=$sigla == 'PE' ? 'selected' : ''?>>Pernambuco</option>
								<option value="PI" <?=$sigla == 'PI' ? 'selected' : ''?>>Piauí</option>
								<option value="RJ" <?=$sigla == 'RJ' ? 'selected' : ''?>>Rio de Janeiro</option>
								<option value="RN" <?=$sigla == 'RN' ? 'selected' : ''?>>Rio Grande do Norte</option>
								<option value="RS" <?=$sigla == 'RS' ? 'selected' : ''?>>Rio Grande do Sul</option>
								<option value="RO" <?=$sigla == 'RO' ? 'selected' : ''?>>Rondônia</option>
								<option value="RR" <?=$sigla == 'RR' ? 'selected' : ''?>>Roraima</option>
								<option value="SC" <?=$sigla == 'SC' ? 'selected' : ''?>>Santa Catarina</option>
								<option value="SP" <?=$sigla == 'SP' ? 'selected' : ''?>>São Paulo</option>
								<option value="SE" <?=$sigla == 'SE' ? 'selected' : ''?>>Sergipe</option>
								<option value="TO" <?=$sigla == 'TO' ? 'selected' : ''?>>Tocantins</option>
							</select>						
                        </label>
                        <label style="height:200px;">
							<textarea name="Contato[mensagem]" class="box effect" data-validation-engine="validate[required]" placeholder="Mensagem" style="height:200px;"><?=(Yii::$app->request->get('assinatura_id')) ? 'Solicito o cancelamento da minha assinatura de código #' . (Yii::$app->request->get('assinatura_id')) : (isset($dados['mensagem']) ? $dados['mensagem'] : '')?></textarea>
                        </label>
						<br />
                        <input type="checkbox" name="newsletter" checked /><font color="white">Desejo receber novidades por e-mail</font>
						<div class="error-content"></div>
						<div class="g-recaptcha" data-sitekey="6Ld8LnoaAAAAAJDUsF3Zh-cSVJicvilaS4IKTc2Z"></div>
                        <input type="submit" value="Enviar" id="contato-bt" class="bt-entrar effectp5 bt-enviar" />
                    </form>
                </div>
            </section>
        </article>
    </main>
