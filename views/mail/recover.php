﻿<title><?=$subject?></title>
<style type="text/css">*{margin:0;padding:0;border:none;font-family:verdana;text-decoration:none;}img+div{display:none !important;}a:link{color: yellow}a:visited{color: white}</style>
<center>
<table cellpadding="0" cellspacing="0" border="0" width="600" style="width:600px;margin:10px;">
<tr><td align="center" width="600" style="height:80px;text-align:center;"><a href="<?=Yii::$app->params['pathUrlWeb']?>"><img src="<?=Yii::$app->params['pathUrlImages']?>mail/topo-logo.jpg" width="600" height="80" style="width:600px;height:80px;" alt="" align="center" /></a></td></tr>
<tr>
	<td width="600" align="center" style="background-color:#0095da;text-align:left;padding:20px 60px;font-family:verdana;font-size:16px;color:#fff;">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#0095da;font-family:verdana;font-size:24px;color:#fff;padding:20px 0;">
		<tr>
			<td align="center"><strong>Olá, <?=$user->name?> <?=$user->lastname?></strong></td>
		</tr>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#0095da;font-family:verdana;font-size:16px;color:#fff;padding:20px 0;line-height:24px;">
		<tr>
			<td align="center">
				Recebemos sua solicitação para redefinir senha.
				<br><br>
				<b>
				<a href="<?=Yii::$app->params['pathUrlWeb'] . 'redefinir-senha/' . $user->senha_recover?>" target="_blank">
					Clique aqui para redefinir sua senha
				</a>
				</b>
			</td>
		</tr>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#0095da;font-family:verdana;font-size:14px;color:#fff;padding:20px 0;line-height:20px;">
		<tr>
			<td align="center">
				Atenciosamente,<br>
				<strong><?=Yii::$app->params['mail_assinatura']?></strong> 
			</td>
		</tr>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#0095da;font-family:verdana;font-size:12px;color:#fff;padding:20px 0;">
		<tr>
		<?/*
			<td align="left">
				<small>Endereço</small><br>
				<?=Yii::$app->params['address']?> - Bairro: <?=Yii::$app->params['district']?><br> <?=Yii::$app->params['city']?>/<?=Yii::$app->params['state']?> - <?=Yii::$app->params['zipcode']?>
			</td>
		*/?>
			<td colsspan="2" align="left">
				<br />
				<small>SAC:</small>	<a href="mailto:<?=Yii::$app->params['mail_sac']?>" target="_blank" style="color:white"><?=Yii::$app->params['mail_sac']?></a>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr><td align="center" width="600" style="height:31px;text-align:center;"><img src="<?=Yii::$app->params['pathUrlImages']?>mail/rodape-curva.jpg" width="600" height="31" style="width:600px;height:31px;" alt="Curva final" align="center" /></td></tr>
</table>
</center>