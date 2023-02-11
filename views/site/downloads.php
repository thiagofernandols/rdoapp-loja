    <main id="main" class="interna downloads">
        <article id="st-in-tit">
            <i class="mdi mdi-download"></i>
            <div class="tit">Downloads</div>
        </article>
        <article id="st-in-downloads">
            <section class="w960">
            <?  foreach($downloads as $download)
                {
            ?>
                <a href="<?=Yii::$app->params['pathUrlImages'] . 'downloads/'. $download->arquivo?>" class="effectp5" target="_blank" alt="<?=$download->download?>">
                    <i class="mdi mdi-download"></i> <span><?=$download->download?></span> <small>(<?=$download->extension?>)</small>
                </a>
            <?  } ?>
            </section>
        </article>
    </main>
