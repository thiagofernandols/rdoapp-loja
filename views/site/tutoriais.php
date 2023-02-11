    <main id="main" class="interna tutoriais">
        <article id="st-in-tit">
            <i class="mdi mdi-play-box-outline"></i>
            <div class="tit">Tutoriais</div>
        </article>
        <article id="st-in-tutoriais">
            <section class="w1280">
                <ul class="list-tutoriais">
                <?  foreach($tutoriais as $tutorial)
                    {
                ?>
                    <li class="li-tutoriais effectp5">
                        <a data-fancybox href="<?=$tutorial->video?>" title="Fácil e prático de usar">
                                <div class="data"><?=$tutorial->datacadastro?></div>
                            <div class="bg-branco effectp5">
                                <div class="capa effectp5">
                                <?  if($tutorial->tag)
                                    {
                                ?>
                                    <div class="novo"><?=$tutorial->tag?></div>
                                <?  } ?>
                                    <img src="<?=Yii::$app->params['pathUrlImages']?>tutoriais/<?=$tutorial->imagem?>" class="effect1" />
                                </div>
                                <div class="tit"><?=$tutorial->tutorial?></div>
                                <div class="txt"><?=$tutorial->texto?></div>
                            </div>
                        </a>
                    </li>
                <?  } ?>
                </ul>
                <? /*
                <ul class="paginacao">
                    <li><a href="#!" class="effectp5 op5"><</a></li>
                    <li><a href="#!" class="effectp5 atual">1</a></li>
                    <li><a href="#!" class="effectp5">2</a></li>
                    <li><a href="#!" class="effectp5">3</a></li>
                    <li><a href="#!" class="effectp5">4</a></li>
                    <li><a class="effectp5 pontos">...</a></li>
                    <li><a href="#!" class="effectp5">51</a></li>
                    <li><a href="#!" class="effectp5 op5">></a></li>
                </ul>
                */ ?>
            </section>
        </article>
    </main>
