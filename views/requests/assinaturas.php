    <main id="main" class="interna conta">
        <article id="st-in-tit">
            <i class="mdi mdi-account"></i>
            <div class="tit">Minha CONTA</div>
        </article>
        <article id="st-in-conta">
            <section class="w1280">
                <div class="abas">
                    <a class="atual effectp5"><i class="mdi mdi-view-list effectp5"></i> Assinaturas</a>
                    <a href="<?=Yii::$app->params['pathUrlWeb']?>minha-conta" class="opcao effectp5"><i class="mdi mdi-account effectp5"></i> Conta</a>
                </div>
                <ul class="list-pedidos">
                <?  if(count($assinaturas) > 0)
                     {
                ?>
                <?  foreach($assinaturas as $assinatura)
                    {
                ?>
                    <?/*Abaixo a class pode ser "status-ativo" ou "status-inativo" */?>
                    <li class="li-pedidos status-ativo">
                        <?/*<div class="status"><?//=$assinatura->status_label?></div>*/?>
                        <?/*<div class="codigo"><small>Código</small><span class="fmenor"><?=$assinatura->assinatura_code ? $assinatura->assinatura_code : $assinatura->id?></span></div>*/?>
                        <div class="status" style="width:100px"><?=$assinatura->code_alias?></div>
                        <div class="data"><small>Solicitado em</small><span class="fmenor"><?=$assinatura->checkout_date?></span></div>
                        <div class="empresa"><small>Empresa</small><span class="fmenor"><?=$assinatura->fantasy_name?></span></div>
                        <hr class="linha">
                        <!-- :: Abaixo a class pode ser "verde" ou "amarelo" -->
                        <div class="plano"><small>Plano</small><span class="fmaior verde"><i class="mdi mdi-star"></i> <?=$assinatura->plano?></span></div>
                        <!-- :: Abaixo a class pode ser "verde" ou "amarelo" -->
                        <div class="tipo"><small>Licença</small><span class="fmaior verde"><?=$assinatura->licenca?></span></div>
                        <!-- :: Abaixo a class pode ser "verde" ou "amarelo" -->
                        <div class="valor"><small>Valor</small><span class="fmaior verde">R$ <?=str_replace('.', ',', $assinatura->checkout_value)?> /mês</span></div>
                        <div class="status_moip"><?//=$assinatura->assinatura_code?></div>
                        <a href="<?=Yii::$app->params['pathUrlWeb'] . 'assinatura/' . $assinatura->code?>" title="Ver assinatura" class="effect btver">VER</a>
                    </li>
                <?  } ?>
                <?  } else { ?>
                <br /><br />
                Esta conta ainda não possui assinaturas.
                <br /><br />
                <b><a href="<?=Yii::$app->params['pathUrlWeb']?>precos"><font color="#ffa500">Clique aqui para assinar</font></a></b>
                <?  } ?>
                </ul>
            </section>
        </article>
    </main>
