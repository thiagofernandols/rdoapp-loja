<style type="text/css">#rodape{display:none;}</style>

    <main id="main" class="interna acesso login">
        <article id="st-in-acesso">
            <section class="centro">
                <a href="<?=Yii::$app->params['pathUrlWeb']?>" class="bt-voltar effectp5">voltar</a>
                <img src="<?=Yii::$app->params['pathUrlImages']?>logo-rdo-120x120.png" class="logo" alt="Logo RDO" />
                <div class="telaacesso <?=isset($cadastro_return) ? 'hide' : ''?>">
                    <div class="tit">
                        <i class="mdi mdi-lock-open"></i> <span>Redefinir Senha</span>
                    </div>
                    <form class="form f-acessar <?=!isset($recover_return) ? 'hide' : ''?>" id="recover-form" action="<?=Yii::$app->params['pathUrlWeb'] . 'redefinir-senha/' . $senha_recover?>" method="post">
						<input type="hidden" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked>
						<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
						<?	if(Yii::$app->session->hasFlash('recover_password'))
							{
						?>
						<font color="white"><?=Yii::$app->session->getFlash('recover_password')?></font>
						<?	} ?>
                        <label class="effectp5">
                            <i class="mdi mdi-key effectp5"></i>							
                            <input type="password" id="CadastroSenha" name="Users[senha]" placeholder="Digite a nova senha" class="box effectp5" data-validation-engine="validate[required,minSize[4],maxSize[10]]" />
                        </label>
                        <label class="effectp5">
                            <i class="mdi mdi-key effectp5"></i>							
                            <input type="password" name="Users[senha_confirm]" placeholder="Confirme a senha" class="box effectp5" data-validation-engine="validate[required,equals[CadastroSenha],minSize[4],maxSize[10]]" />
                        </label>
                        <input type="submit" id="recover-bt" value="Enviar" class="bt-entrar effectp5" />
                    </form>
                </div>
            </section>
        </article>
    </main>
