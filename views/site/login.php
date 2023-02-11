<style type="text/css">#rodape{display:none;}</style>

    <main id="main" class="interna acesso login">
        <article id="st-in-acesso">
            <section class="centro">
                <a href="<?php echo Yii::$app->params['pathUrlWeb']?>" class="bt-voltar effectp5">voltar</a>
                <a href="<?=Yii::$app->params['pathUrlWeb']?>">
                    <img src="<?php echo Yii::$app->params['pathUrlImages']?>logo-rdo-120x120.png" class="logo" alt="Logo RDO" />
                </a>
                <div class="telaacesso <?php echo (isset($cadastro_return) ? ($cadastro_return ? 'hide' : '') : '');?>">
                    <div class="tit">
                        <i class="mdi mdi-lock-open"></i> <span>Login</span>
                    </div>
                    <form class="form f-acessar <?php echo isset($recover_return) ?($recover_return ? 'hide' : '') : '';?>" id="login-form" action="<?php echo Yii::$app->params['pathUrlWeb']?>login" method="post">
						<input type="hidden" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked>
						<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
						<?php if(Yii::$app->session->hasFlash('recover_sucess'))
							{
						?>
						<font color="white"><?php echo Yii::$app->session->getFlash('recover_sucess')?></font>
						<?php } ?>
						<?php if(Yii::$app->session->hasFlash('error_user'))
							{
						?>
						<font color="white"><?php echo Yii::$app->session->getFlash('error_user')?></font>
						<?php } ?>
						<?php if(Yii::$app->session->hasFlash('error_password'))
							{
						?>
						<font color="white"><?php echo Yii::$app->session->getFlash('error_password')?></font>
						<?php } ?>
                        <label class="effectp5">
                            <i class="mdi mdi-account effectp5"></i>
                            <input type="text" name="LoginForm[email]" placeholder="Email" class="box effectp5" value="" data-validation-engine="validate[required,custom[email]]" />
                        </label>
                        <label class="effectp5">
                            <i class="mdi mdi-key effectp5"></i>
                            <input type="password" name="LoginForm[password]" placeholder="Senha" class="box effectp5" data-validation-engine="validate[required]"  value="" />
                        </label>
                        <div class="recuperar"><a class="bt-recuperar effectp5">Recuperar senha</a></div>
                        <input type="submit" id="login-bt" value="Entrar" class="bt-entrar effectp5" />
                    </form>
                    <form class="form f-recuperar <?php echo !isset($recover_return) ? 'hide' : ''?>" id="recover-form" action="<?php echo Yii::$app->params['pathUrlWeb']?>recover" method="post">
						<?php if(Yii::$app->session->hasFlash('recover_feedback'))
							{
						?>
						<font color="white"><?php echo Yii::$app->session->getFlash('recover_feedback')?></font>
						<?php } ?>
                        <label class="effectp5">
                            <i class="mdi mdi-account effectp5"></i>
							<input type="hidden" id="recover-form" name="LoginForm[rememberMe]" value="1" checked>
							<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
                            <input type="text" name="Users[email]" placeholder="Email" class="box effectp5" data-validation-engine="validate[required,custom[email]]" />
                        </label>
                        <div class="recuperar"><a class="bt-recuperar effectp5">lembrei minha senha</a></div>
                        <input type="submit" id="recover-bt" value="Resetar" class="bt-entrar effectp5" />
                    </form>
                    <div class="oucadastrar">
                        <a class="bt-cadastrar effectp5">
                            <small>ou clique aqui e</small>
                            <span>Cadastre-se</span>
                        </a>
                    </div>
                </div>
                <div class="telacadastro <?php echo !isset($cadastro_return) ? 'hide' : ''?>">
                    <div class="tit">
                        <span>Cadastre-se</span>
                    </div>
                    <form class="form f-cadastro" id="cadastro-form" action="<?php echo Yii::$app->params['pathUrlWeb']?>cadastro" method="post">
						<?php if(Yii::$app->session->hasFlash('error_user_cadastro'))
							{
						?>
						<font color="white"><?php echo Yii::$app->session->getFlash('error_user_cadastro')?></font><br />
						<?php } ?>
						<?php if(isset($class_errors))
							{
						?>
						<font color="white">ATENÇÃO: Aconteceram os seguintes erros:</font><br /><br />
						<?
								foreach($class_errors as $class_error)
								{
									foreach($class_error as $class_error_each)
									{
						?>
						<font color="white"><?php echo $class_error_each?></font><br />
						<?php 		} ?>
						<?php 	} ?>
						<?php } ?>
						<?php if(isset($class_errors_clients))
							{
						?>
						<font color="white">ATENÇÃO: Aconteceram os seguintes erros:</font><br /><br />
						<?
								foreach($class_errors_clients as $class_error)
								{
									foreach($class_error as $class_error_each)
									{
						?>
						<font color="white"><?php echo $class_error_each?></font><br />
						<?php 		} ?>
						<?php 	} ?>
						<?php } ?>
						<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
                        <label class="effectp5">
                            <input type="text" name="Users[name]" placeholder="Nome" class="box effectp5" value="<?php echo isset($dados['name']) ? $dados['name'] : (isset($_GET['teste']) ? 'André' : '')?>" data-validation-engine="validate[required]" />
                        </label>
                        <label class="effectp5">
                            <input type="text" name="Users[lastname]" placeholder="Sobrenome" class="box effectp5" value="<?php echo isset($dados['lastname']) ? $dados['lastname'] : (isset($_GET['teste']) ? 'Corção' : '')?>" data-validation-engine="validate[required]" />
                        </label>
                        <label class="effectp5">
                            <input type="text" name="Users[email]" placeholder="Email" class="box effectp5" value="<?php echo isset($dados['email']) ? $dados['email'] : (isset($_GET['teste']) ? date("Ymd.His").'@gmail.com' : '')?>" data-validation-engine="validate[required,custom[email]]" />
                        </label>
                        <label class="effectp5">
                            <input type="tel" name="Users[phone]" placeholder="Telefone" class="box effectp5" data-validation-engine="validate[required]"  value="<? echo isset($dados['phone']) ? $dados['phone'] : (isset($_GET['teste']) ? '(99) 9999-99991' : '');?>" maxlength="255" data-mask-telephone />
                        </label>
                        <label class="effectp5">
                            <input type="password" id="CadastroSenha" name="Users[password]" placeholder="Senha" class="box effectp5" value="<?=(isset($_GET['teste']) ? 'teste' : '')?>" data-validation-engine="validate[required,minSize[4],maxSize[10]]" />
                        </label>
                        <label class="effectp5">
                            <input type="password" name="Users[senha_confirm]" placeholder="Confirmar Senha" class="box effectp5" value="<?=(isset($_GET['teste']) ? 'teste' : '')?>" data-validation-engine="validate[required,equals[CadastroSenha],minSize[4],maxSize[10]]" />
                        </label>
						<br />
                        <input type="checkbox" name="newsletter" checked /><font color="white">Desejo receber novidades por e-mail</font>
                        <input type="submit" id="cadastro-bt" value="Cadastrar" class="bt-entrar effectp5" />
                    </form>
                    <div class="oucadastrar">
                        <a class="bt-cadastrar effectp5">
                            <small>ou clique aqui e</small>
                            <span>faça Login</span>
                        </a>
                    </div>
                </div>
            </section>
        </article>
    </main>
