<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
?>
    <div class="pag-erro">
    	<div class="cont-erro">
			<img src="<?=Yii::$app->params['pathUrlImages']?>img-erro.png" class="img-erro" width="245" height="198" />
			<h3 class="tit-erro">Aconteceu um erro!</h3>
			<div class="txt-erro"><?= nl2br(Html::encode($message)) ?></div>
	        <a href="<?=Yii::$app->request->referrer?>" onclick="window.history.go(-1); return false;" class="bt-voltar-erro effect">Voltar</a>
    	</div>
    </div>