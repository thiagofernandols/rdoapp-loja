<style type="text/css">#rodape{display:none;}</style>

    <main id="main" class="interna carrinho">
        <article id="st-carrinho">
            <section class="centro">
                <img src="<?=Yii::$app->params['pathUrlImages']?>logo-rdo-120x120.png" class="logom" alt="Logo RDO" />
            </section>
            <section class="w1280">
                <div class="pagamento">
                    <div class="bg-branco">
                        <div class="titulo">Forma de pagamento</div>
                        <ul class="escolherforma">
                            <li><a href="#!" class="effect btcartao on">Cartão de crédito</a></li>
                            <li><a href="#!" class="effect btboleto">Boleto</a></li>
                        </ul>
                        <div class="escolhacartao">
                            <form class="form f-pagamento" action="<?=Yii::$app->params['pathUrlWeb']?>pedidos">
                                <label class="col2">
                                    <input type="text" id="nomecartao" name="nomecartao" class="box effect" placeholder="Nome do titular" required></input>
                                </label>
                                <label class="col2">
                                    <input type="text" id="cpf" name="cpf" class="box effect cpf" placeholder="CPF do titular" required></input>
                                </label>
                                <label class="col2">
                                    <input type="text" id="numerocartao" name="numerocartao" class="box effect" placeholder="Número do cartão" required></input>
                                </label>
                                <label class="col2">
                                    <input type="text" id="codcvv" name="codcvv" class="box effect" placeholder="Cód. CVV" required></input>
                                </label>
                                <label class="col2">
                                    <select id="vencimentomes" name="vencimentomes" class="box effect" required>
                                        <option>Mês de vencimento</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </label>
                                <label class="col2">
                                    <select id="vencimentoano" name="vencimentoano" class="box effect" required>
                                        <option>Ano de vencimento</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                    </select>
                                </label>
                                <br><br>
                                <label class="col2">
                                    <select id="parcelamento" name="parcelamento" class="box effect" required>
                                        <option>Parcelamento</option>
                                        <option value="x1">A vista (R$ 3.740,00)</option>
                                        <option value="x2">2x de R$ 1.870,00</option>
                                        <option value="x3">3x de R$ 1.246,67</option>
                                        <option value="x4">4x de R$ 935,00</option>
                                        <option value="x5">5x de R$ 748,00</option>
                                        <option value="x6">6x de R$ 623,34</option>
                                        <option value="x7">7x de R$ 534,29</option>
                                        <option value="x8">8x de R$ 467,50</option>
                                        <option value="x9">9x de R$ 415,55</option>
                                        <option value="x10">10x de R$ 374,00</option>
                                        <option value="x11">11x de R$ 340,00</option>
                                        <option value="x12">12x de R$ 311,67</option>
                                    </select>
                                </label>
                                <label class="col2" style="color:#888;">
                                    Parcele em até <strong>X vezes</strong> sem juros.
                                </label>
                                <br><br>
                                <div class="bt-finalizar effect">
                                    <input type="submit" class="bt-sub effect" value="Finalizar compra"></input>
                                </div>
                            </form>
                        </div>
                        <div class="escolhaboleto hide">
                            <form class="form f-pagamento" action="pedidos.php">
                                <label class="col2">
                                    <input type="text" id="nome" name="nome" class="box effect" placeholder="Nome" required></input>
                                </label>
                                <label class="col2">
                                    <input type="text" id="cpfcnpj" name="cpfcnpj" class="box effect" placeholder="CPF/CNPJ" required></input>
                                </label>
                                <label>
                                    <input type="text" id="endereco" name="endereco" class="box effect" placeholder="Endereço" required></input>
                                </label>
                                <label class="col2">
                                    <select id="parcelamento" name="parcelamento" class="box effect" required>
                                        <option>Parcelamento</option>
                                        <option value="x1">A vista (R$ 3.740,00)</option>
                                        <option value="x2">2x de R$ 1.870,00</option>
                                        <option value="x3">3x de R$ 1.246,67</option>
                                        <option value="x4">4x de R$ 935,00</option>
                                        <option value="x5">5x de R$ 748,00</option>
                                        <option value="x6">6x de R$ 623,34</option>
                                        <option value="x7">7x de R$ 534,29</option>
                                        <option value="x8">8x de R$ 467,50</option>
                                        <option value="x9">9x de R$ 415,55</option>
                                        <option value="x10">10x de R$ 374,00</option>
                                        <option value="x11">11x de R$ 340,00</option>
                                        <option value="x12">12x de R$ 311,67</option>
                                    </select>
                                </label>
                                <label class="col2" style="color:#888;">
                                    Parcele em até <strong>12 vezes</strong> sem juros.
                                </label>
                                <br><br>
                                <div class="bt-finalizar effect">
                                    <input type="submit" class="bt-sub effect" value="Finalizar compra"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="planos">
                    <!-- Mesma estrutura da pagina precos.php -->
                    <div class="plano pl-basico effectp5">
                        <img src="<?=Yii::$app->params['pathUrlImages']?>logo-rdo-120x120.png" class="logo" />
                        <i class="mdi mdi-star effectp5"></i>
                        <div class="titp">Plano</div>
                        <div class="titc">Básico</div>
                        <div class="valor"><span class="pt1">R$</span> <span class="pt2">99,90</span> <span class="pt3">/MÊS</span></div>
                        <div class="border effectp5">
                            <ul>
                                <li class="desc effectp5">O plano Básico apresenta todas as funcionalidades do plano Gratuito e mais</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>01 OBRA</span> por mês.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>Assinatura eletrônica</span> entre Contratante e Contratada.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>05 Fotos</span> por Tarefa.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>Relatório de Medição</span>.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>06 Dashboards</span>.</li>
                                <li class="effectp5"><i class="mdi mdi-check effectp5"></i><span>100 Colaboradores</span> por obra.</li>
                            </ul>
                        </div>
                    </div>
                    <!---->
                </div>
            </section>
        </article>
    </main>
    <script type="text/javascript">
        $('.btcartao').click(function(){
            $(this).addClass('on'); 
            $('.btboleto').removeClass('on'); 
            $('.escolhacartao').removeClass('hide'); 
            $('.escolhaboleto').addClass('hide');
        });
        $('.btboleto').click(function(){
            $(this).addClass('on'); 
            $('.btcartao').removeClass('on'); 
            $('.escolhaboleto').removeClass('hide'); 
            $('.escolhacartao').addClass('hide');
        });
    </script>
