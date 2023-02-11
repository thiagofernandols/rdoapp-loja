    <main id="main" class="interna faq">
        <article id="st-in-tit">
            <i class="mdi mdi-forum"></i>
            <div class="tit">FAQ</div>
        </article>
        <article id="st-in-faq">
            <section class="w960">
                <ul>
                <?  foreach($faqs as $faq)
                    {
                ?>
                    <li>
                        <div class="numero"><?=$faq->ordem?></div>
                        <div class="tit"><?=$faq->faq?></div>
                        <div class="txt" style="white-space: pre-wrap;"><?=$faq->texto?></div>
                    </li>
                <?  } ?>
                </ul>
            </section>
        </article>
    </main>
