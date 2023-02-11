    <main id="main" class="home">
	    <article id="st-banner" style="background-image:url(<?php echo Yii::$app->params['pathUrlImages'];?>layout/bg-topo-home-2.jpg)">
            <section>
                <span class="ct1 effect1">O verdadeiro</span><br>
                <span class="ct2 effect1">diário de obras</span><br>
                <span class="ct3 effect1">100% digital</span>
                <div class="newsletter">
                     <?php if(Yii::$app->session->hasFlash('sucesso_newsletter')):?>
						<font color="yellow"><?php echo Yii::$app->session->getFlash('sucesso_newsletter');?></font><br /><br />
                        <?php endif; ?>
                     <?php if(Yii::$app->session->hasFlash('erro_newsletter')):?>
						<font color="yellow"><?php echo Yii::$app->session->getFlash('erro_newsletter');?></font><br /><br />
                        <?php endif; ?>
                    <div>
                        <i class="mdi mdi-email-newsletter"></i>
                        <div class="info">
                            <span class="recb">Receba nossa</span>
                            <span class="news">Newsletter</span>
                        </div>
                        <i class="mdi mdi-arrow-right"></i>
                        <form class="form f-newsletter" id="newsletter-form" action="<?php echo Yii::$app->params['pathUrlWeb']?>newsletter" method="post">
    						<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
                            <input type="email" name="Mailing[email]" placeholder="E-mail" class="box effectp5" value="<?php echo isset($dados['email']) ? $dados['email'] : ''?>" data-validation-engine="validate[required]" />
                            <input type="submit" value="Enviar" id="newsletter-bt" class="bt-entrar effectp5 bt-enviar" />
                        </form>
                    </div>
                </div>
            </section>
            <picture>
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <source srcset="<?php echo Yii::$app->params['pathUrlImages'];?>layout/faixa-branca-bot-1920.png" media="(min-width:1900px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca-bot-1600.png" media="(min-width:1580px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca-bot-1366.png" media="(min-width:1346px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca-bot-1280.png" media="(min-width:1260px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca-bot-960.png" media="(max-width:1259px)">
                <!--[if IE 9]></video><![endif]-->
                <img srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca-bot-1920.png" class="faixa-branca-bot">
            </picture>
        </article>
        <article id="st-vantagens">
            <div class="w1280">
                <section>
                    <div class="div-info">
                        <div class="tit">As vantagens de usar <span>RDO App</span></div>
                        <div class="txt">O RDO App oferece melhor desempenho e conveniência tanto para Contratada quanto para Contratante. Com uma única informação digitada no dia é possível gerar três importantes relatórios: <span>DIÁRIO DE OBRA</span>, <span>MEDIÇÃO</span> E <span>FOTOGRÁFICO</span>.</div>
                    </div>
                    <div class="div-destaque">
                        <div class="capa">
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>banner/banner-destaque-capa-home.jpg" class="img-capa" />
                        </div>
                        <ul class="func-dest">
                            <li>
                                <div class="ico"><i class="mdi mdi-book-open-page-variant"></i></div>
                                <div class="box">DIÁRIO DE OBRA</div>
                                <hr class="linhahorizontal" />
                            </li>
                            <li>
                                <div class="ico"><i class="mdi mdi-image-album"></i></div>
                                <div class="box umalinha">MEDIÇÃO</div>
                                <hr class="linhahorizontal" />
                            </li>
                            <li>
                                <div class="ico"><i class="mdi mdi-file-tree"></i></div>
                                <div class="box umalinha">FOTOGRÁFICO</div>
                                <hr class="linhahorizontal" />
                            </li>
                            <hr class="linhavertical1" />
                        </ul>
                        <hr class="linhavertical2" />
                    </div>
                    <div class="div-tresdest">
                        <ul>
                            <li class="effectp2">
                                <picture>
                                    <!--[if IE 9]><video style="display: none;"><![endif]-->
                                    <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>banner/funcionalidade02.jpg" media="(min-width:460px)">
                                    <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>banner/funcionalidade02-mini.jpg" media="(max-width:459px)">
                                    <!--[if IE 9]></video><![endif]-->
                                    <img srcset="<?php echo Yii::$app->params['pathUrlImages']?>banner/funcionalidade02.jpg">
                                </picture>
                                <div class="nome">Logins Independentes para Contratante e Contratada</div>
                            </li>
                            <li class="effectp2">
                                <picture>
                                    <!--[if IE 9]><video style="display: none;"><![endif]-->
                                    <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>banner/funcionalidade05.jpg" media="(min-width:460px)">
                                    <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>banner/funcionalidade05-mini.jpg" media="(max-width:459px)">
                                    <!--[if IE 9]></video><![endif]-->
                                    <img srcset="<?php echo Yii::$app->params['pathUrlImages']?>banner/funcionalidade05.jpg">
                                </picture>
                                <div class="nome">Inéditos Cards de Tarefas e suas Cores para os Status</div>
                            </li>
                            <li class="effectp2 mr-0">
                                <picture>
                                    <!--[if IE 9]><video style="display: none;"><![endif]-->
                                    <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>banner/funcionalidade07.jpg" media="(min-width:460px)">
                                    <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>banner/funcionalidade07-mini.jpg" media="(max-width:459px)">
                                    <!--[if IE 9]></video><![endif]-->
                                    <img srcset="<?php echo Yii::$app->params['pathUrlImages']?>banner/funcionalidade07.jpg">
                                </picture>
                                <div class="nome">06 Dashboards para Tomada de Decisão!</div>
                            </li>
                            <hr class="linhahorizontal" />
                            <hr class="linhavertical" />
                        </ul>
                        <hr class="linhavertical2" />
                    </div>
                </section>
            </div>
            <picture>
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza1-bot-1920.png" media="(min-width:1900px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza1-bot-1600.png" media="(min-width:1580px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza1-bot-1366.png" media="(min-width:1346px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza1-bot-1280.png" media="(min-width:1260px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza1-bot-960.png" media="(max-width:1259px)">
                <!--[if IE 9]></video><![endif]-->
                <img srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza1-bot-1920.png" class="faixa-cinza1-bot">
            </picture>
        </article>
        <article id="st-comofunciona">
            <section class="w1920">
                <div class="tit">Como Funciona?</div>
                <ul>
                    <li class="effectp5">
                        <i class="mdi mdi-arrow-right effectp5"></i>
                        <div class="circulo effectp5">1</div><hr class="linha1 effect1" /><hr class="linha2 effect1" />
                        <div class="tit effectp5">Cadastro na loja e acesso ao sistema</div>
                        <div class="txt effectp5">Após fazer o <span>cadastro</span> na loja e escolher um plano de assinatura, o usuário acessa o sistema e abre uma nova obra como <span>Contratante</span> ou <span>Contratada</span>.</div>
                    </li>
                    <li class="effectp5">
                        <i class="mdi mdi-arrow-right effectp5"></i>
                        <div class="circulo effectp5">2</div><hr class="linha1 effect1" /><hr class="linha2 effect1" />
                        <div class="tit effectp5">Enviando convite para outra parte</div>
                        <div class="txt effectp5">Após escolher o que vai ser na obra (Contratada ou Contratante) o <span>usuário envia o convite</span> para outra parte (Contratada/Contratante) que preenche seus dados.</div>
                    </li>
                    <li class="effectp5">
                        <i class="mdi mdi-arrow-right effectp5"></i>
                        <div class="circulo effectp5">3</div><hr class="linha1 effect1" /><hr class="linha2 effect1" />
                        <div class="tit effectp5">Planejamento da obra</div>
                        <div class="txt effectp5">Usuário da Contratada <span>insere as Etapas</span> e os <span>Cards de Tarefas com status</span> de Planejada.</span>.</div>
                    </li>
                    <li class="effectp5">
                        <i class="mdi mdi-arrow-right effectp5"></i>
                        <div class="circulo effectp5">4</div><hr class="linha1 effect1" /><hr class="linha2 effect1" />
                        <div class="tit effectp5">Execução da obra e geração do RDO (PDF)</div>
                        <div class="txt effectp5">Ao iniciar a obra, o usuário da Contratada muda o status dos Cards de Tarefas para Em Execução que <span>recebem Comentários</span>, Colaboradores e Máquinas gerando e assinando diariamente os <span>RDO's em PDF</span>.</div>
                    </li>
                    <li class="effectp5">
                        <div class="circulo effectp5">5</div><hr class="linha1 effect1" /><hr class="linha2 effect1" />
                        <div class="tit effectp5">Contratante comenta e assina o RDO (PDF)</div>
                        <div class="txt effectp5">Usuário da Contratante acessa o sistema e comenta e <span>assina o RDO PDF</span> fechando o ciclo diário.</div>
                    </li>
                </ul>
            </section>
        </article>
        <article id="st-planos">
            <picture>
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza2-top-1920.png" media="(min-width:1900px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza2-top-1600.png" media="(min-width:1580px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza2-top-1366.png" media="(min-width:1346px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza2-top-1280.png" media="(min-width:1260px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza2-top-960.png" media="(max-width:1259px)">
                <!--[if IE 9]></video><![endif]-->
                <img srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-cinza2-top-1920.png" class="faixa-cinza2-top">
            </picture>
            <section class="w1280">
                <div class="tit">
                    <img src="<?php echo Yii::$app->params['pathUrlImages']?>layout/celular-capacete.png" />
                    <span class="tc1">Conheça</span>
                    <span class="tc2">Nossos planos</span>
                </div>
                <div class="planos">
                    <div class="plano pl-gratuito effectp5">
                        <div class="bordlinha bld effectp5"></div>
                        <div class="bg-branco effectp5">
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>logo-rdo-120x120.png" class="logo" />
                            <i class="mdi mdi-star-half-full effectp5"></i>
                            <div class="titp">Plano</div>
                            <div class="titc">Gratuito</div>
                            <hr class="linha" />
                            <ul>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>01 Obra</span> por mês.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i>Gere e <span>Assine RDO</span> eletrônico como Contratada.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>10 Tarefas</span> por obra através dos inéditos Cards de Tarefas.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i>Use <span>cores para os status</span> disponíveis: Planejamento, Em Execução, Cancelada, Pausada e Finalizada.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>01 Foto</span> por Tarefa.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i>Até <span>30 Colaboradores</span> por obra.</li>
                            </ul>
                            <a href="<?php echo Yii::$app->params['pathUrlWeb']?>precos" class="bt-saibamais effectp5">Saiba <span>MAIS</span></a>
                        </div>
                    </div>
                    <div class="meio effectp5">
                        <i class="mdi mdi-swap-horizontal effectp5"></i>
                    </div>
                    <div class="plano pl-basico effectp5">
                        <div class="bordlinha ble effectp5"></div>
                        <div class="bg-branco effectp5">
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>logo-rdo-120x120.png" class="logo" />
                            <i class="mdi mdi-star effectp5"></i>
                            <div class="titp">Plano</div>
                            <div class="titc">Básico</div>
                            <hr class="linha" />
                            <ul>
                                <li class="desc effectp5">O plano Básico apresenta todas as funcionalidades do plano Gratuito e mais</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>01 Obra</span> por mês.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>Assinatura eletrônica</span> entre Contratante e Contratada.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>05 Fotos</span> por Tarefa.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>Relatório de Medição</span>.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>06 Dashboards</span>.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>100 Colaboradores</span> por obra.</li>
                            </ul>
                            <a href="<?php echo Yii::$app->params['pathUrlWeb']?>precos" class="bt-saibamais effectp5">Saiba <span>MAIS</span></a>
                        </div>
                    </div>
                </div>
            </section>
            <picture>
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca2-bot-1920.png" media="(min-width:1900px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca2-bot-1600.png" media="(min-width:1580px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca2-bot-1366.png" media="(min-width:1346px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca2-bot-1280.png" media="(min-width:1260px)">
                <source srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca2-bot-960.png" media="(max-width:1259px)">
                <!--[if IE 9]></video><![endif]-->
                <img srcset="<?php echo Yii::$app->params['pathUrlImages']?>layout/faixa-branca2-bot-1920.png" class="faixa-branca2-bot">
            </picture>
        </article>
        <article id="st-premios">
            <section class="w1280">
                <div class="tit">Prêmios</div>
                <ul class="list-logos">
                    <li class="li-logo">
                        <a href="http://www.pitch.salvador.ba.gov.br/images/Pitch-Resultado_Final_Selecao.pdf" target="_blank">
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>premios/logo-01-cinza.jpg" alt="Pitch Salvador" class="logo cinza" />
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>premios/logo-01-colorido.jpg" alt="Pitch Salvador" class="logo colorido" />
                        </a>
                    </li>
                    <li class="li-logo">
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>premios/logo-02-cinza.jpg" alt="Startup Acelerada" class="logo cinza" />
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>premios/logo-02-colorido.jpg" alt="Startup Acelerada" class="logo colorido" />
                    </li>
                    <li class="li-logo">
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>premios/logo-03-cinza.jpg" alt="Sebrae LIKE a BOSS" class="logo cinza" />
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>premios/logo-03-colorido.jpg" alt="Sebrae LIKE a BOSS" class="logo colorido" />
                    </li>
                    <li class="li-logo">
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>premios/logo-04-cinza.jpg" alt="Inovativa Brasil" class="logo cinza" />
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>premios/logo-04-colorido.jpg" alt="Inovativa Brasil" class="logo colorido" />
                    </li>
                    <li class="li-logo">
                        <a href="http://www.portaldaindustria.com.br/canais/plataforma-inovacao-para-a-industria/" target="_blank">
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>premios/logo-05-pretobranco.jpg" alt="Senai Cimatec" class="logo cinza" />
                            <img src="<?php echo Yii::$app->params['pathUrlImages']?>premios/logo-05-colorido.jpg" alt="Senai Cimatec" class="logo colorido" />
                        </a>
                    </li>
                </ul>
            </section>
        </article>
    </main>