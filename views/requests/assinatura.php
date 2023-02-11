<?
    use yii\helpers\Html;
    use app\models\extension\RequestsExt;
    ?>
    <main id="main" class="interna conta">
        <article id="st-in-tit">
            <i class="mdi mdi-account"></i>
            <div class="tit">Minha CONTA</div>
        </article>
        <article id="st-in-conta">
            <section class="w1280">
                <div class="abas">
                    <a href="<?=Yii::$app->params['pathUrlWeb']?>assinaturas" class="opcao effectp5"><i class="mdi mdi-view-list effectp5"></i> Assinaturas</a>
                    <a href="<?=Yii::$app->params['pathUrlWeb']?>minha-conta" class="opcao effectp5"><i class="mdi mdi-account effectp5"></i> Conta</a>
                </div>
                <? if(Yii::$app->session->hasFlash('sucesso')) { ?>
                    <div class="errobg">
                        <div class="errocaixa">
                            <a class="bterrofechar">x</a>
                            <div class="sucesso"><i class="mdi mdi-check"></i> <?=Yii::$app->session->getFlash('sucesso');?></div>
                        </div>
                    </div>
                <? } ?>
                <div class="detalheassinatura">
                    <?/*<div><small>Status</small><span class="status"><?=$assinatura->status_label?></span></div>*/?>
                    <div><small>Status</small><span class="status"><?=$status_moip ? RequestsExt::translateStatusAssinatura($status_moip) : $assinatura->status_label?></span></div>
                    <div><small>Data de solicitação</small><span class="fmaior"><?=$assinatura->checkout_date?></span></div>
                    <div><small>Código da Assinatura</small><span class="fmaior"><?=$assinatura->code_alias?></span></div>
                    <hr>
                    <!--  :: Abaixo a class pode ser "verde" ou "amarelo" -->
                    <div><small>Plano</small><span class="fmaior verde"><i class="mdi mdi-star"></i> <?=$assinatura->plano?></span></div>
                    <!--  :: Abaixo a class pode ser "verde" ou "amarelo" -->
                    <div><small>Licença</small><span class="fmaior verde"><?=$assinatura->licenca?></span></div>
                    <!--  :: Abaixo a class pode ser "verde" ou "amarelo" -->
                    <div><small>Valor</small><span class="fmaior verde">R$ <?=number_format($assinatura->checkout_value, 2)?></span></div>
                    <hr>
                    <? if($assinatura->payment_method) {?>
                        <div><small>Forma de Pagamento</small><span><?=$assinatura->payment_method?></span></div>
                    <? } ?>
                    <? if($assinatura->dia_vencimento > 0) {?>
                        <div><small>Dia de vencimento</small><span><?=sprintf('%02d', $assinatura->dia_vencimento); ?></span></div>
                    <? } ?>
                    <div><small>Razão Social</small><span><?=$assinatura->company_name?></span></div>
                    <div><small>Nome Fantasia</small><span><?=$assinatura->fantasy_name?></span></div>
                    <div><small>CNPJ</small><span><?=$assinatura->company_id?></span></div>
                    <div><small>Nome</small><span><?=$assinatura->name?></span></div>
                    <div><small>Sobrenome</small><span><?=$assinatura->lastname?></span></div>
                    <div><small>CPF</small><span><?=$assinatura->client_id?></span></div>
                    <div><small>E-mail</small><span><?=$assinatura->email?></span></div>
                    <div><small>Telefone</small><span><?=$assinatura->phone?></span></div>
                    <div><small>Sexo</small><span><?=$assinatura->client_sex?></span></div>
                    <div><small>Data de Nascimento</small><span><?=$assinatura->client_birthdate?></span></div>
                    <?  if(isset($status_moip_disabled)) {?>
                        <div><small>Status Moip</small><span><?=$status_moip?></span></div>
                    <?  } ?>
                    <hr>
                    <div><small>CEP</small><span><?=$assinatura->postal_code?></span></div>
                    <div><small>Endereço</small><span><?=$assinatura->street?></span></div>
                    <div><small>Número</small><span><?=$assinatura->number?></span></div>
                    <div><small>Complemento</small><span><?=$assinatura->complement?></span></div>
                    <div><small>Bairro</small><span><?=$assinatura->neighborhood?></span></div>
                    <div><small>Cidade</small><span><?=$assinatura->cidade?></span></div>
                    <div><small>Estado</small><span><?=$assinatura->estado?></span></div>
                    <hr>
                    <a href="<?=Yii::$app->params['pathUrlWeb']?>contato?assinatura_id=<?=$assinatura->code_alias?>&cliente_id=<?=$assinatura->client_id?>" title="Cancelamento" class="btcancelar">ENTRE EM CONTATO CONOSCO POR WHATSAPP OU EMAIL PARA CANCELAR ESSA ASSINATURA</a>
                    <!-- <a href="<?=Yii::$app->params['pathUrlWeb']?>assinaturas" title="Assinaturas">Voltar</a> -->
        	    </div>
                <? if(count($faturas) > 0) { ?>
                    <div class="titfaturas">FATURAS</div>
                    <table cellpadding="0" cellspacing="0" border="0" class="tabfaturas">
                        <tr>
                            <td class="tit">Referência</td>
                            <td class="tit">Plano</td>
                            <td class="tit">Valor</td>
                            <td class="tit">Vencimento</td>
                            <td align="right" class="tit">Status</td>
                        </tr>
                        <? foreach($faturas as $fatura) {   
                        // echo '<pre>';
                        // print_r($fatura);
                        // echo '</pre>';
                        ?>
                            <tr>
                                <td><?=$fatura['creation_date']['month']?>/<?=$fatura['creation_date']['year']?></td>
                                <?/*  :: Abaixo a class pode ser "verde" ou "amarelo" */?>
                                <td class="verde"><?=$fatura['plan']['name']?></td>
                                <td>R$ <?=substr($fatura['amount'], 0,-2) . ',' .  substr($fatura['amount'], -2)?></td>
                                <td>
                                    <? if(count($fatura['due_date']) > 0) {
                                        echo sprintf('%02d', $fatura['due_date']['day']) . '/' . sprintf('%02d', $fatura['due_date']['month']) . '/' . $fatura['due_date']['year'];
                                    } else {
                                        echo sprintf('%02d', $fatura['creation_date']['day']) . '/' . sprintf('%02d', $fatura['creation_date']['month']) . '/' . $fatura['creation_date']['year'];
                                    } ?>
                                </td>
                                <?/* Abaixo a class pode ser "status-pago" ou "status-pendente" */?>
                                <td align="right" class="status-pago">
                                    <span><?=$fatura['status']['description']?></span>
                                    <? if(count($fatura['due_date']) > 0 &&  $fatura['status']['code'] != 3) { ?>
                                        <a href="<?=$fatura['_links']['boleto']['redirect_href']?>" title="Baixar Boleto" target="_blank"> | BAIXAR BOLETO</a>
                                    <? } ?>
                                </td>
                            </tr>
                        <? } ?>
                    </table>
                <? } ?>
            </section>
        </article>
    </main>
    <script>
    $( document ).ready(function() {
        <? if(Yii::$app->session->hasFlash('boleto')) { ?>
        window.open('<?=Yii::$app->session->getFlash('boleto')?>', '_blank');
        <?  } ?>

        $('.bterrofechar').click(function(){
            $('.errobg').addClass('hide');
        });
        $('.errobg').click(function(){
            $(this).addClass('hide');
        });
        $('.errocaixa').click(function(){
            $('.errobg').addClass('hide');
        });
    });
    </script>
