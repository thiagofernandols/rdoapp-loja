<style type="text/css">#rodape{display:none;}</style>

    <main id="main" class="interna acesso login">
        <article id="st-in-acesso">
            <section class="centro">
                <a href="<?=Yii::$app->params['pathUrlWeb']?>" class="bt-voltar effectp5">voltar</a>
                <a href="<?=Yii::$app->params['pathUrlWeb']?>">
                    <img src="<?=Yii::$app->params['pathUrlImages']?>logo-rdo-120x120.png" class="logo" alt="Logo RDO" />
                </a>
                <div class="telaacesso">
                    <div class="tit">
                        <i class="mdi mdi-open-in-app"></i> <span>Sistema</span>
                    </div>
                    <form class="form f-acessar">
                        <label class="effectp5">
                            <i class="mdi mdi-account effectp5"></i>
                            <input type="text" name="" placeholder="Email" class="box effectp5" />
                        </label>
                        <label class="effectp5">
                            <i class="mdi mdi-key effectp5"></i>
                            <input type="password" name="" placeholder="Senha" class="box effectp5" />
                        </label>
                        <div class="recuperar"><a class="bt-recuperar effectp5">Recuperar senha</a></div>
                        <input type="submit" value="Entrar" class="bt-entrar effectp5" />
                    </form>
                    <form class="form f-recuperar hide">
                        <label class="effectp5">
                            <i class="mdi mdi-account effectp5"></i>
                            <input type="text" name="" placeholder="Email" class="box effectp5" />
                        </label>
                        <div class="recuperar"><a class="bt-recuperar effectp5">lembrei minha senha</a></div>
                        <input type="submit" value="Resetar" class="bt-entrar effectp5" />
                    </form>
                </div>
            </section>
        </article>
    </main>
