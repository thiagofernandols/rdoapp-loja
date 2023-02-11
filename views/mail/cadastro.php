<title><?=$subject?></title>
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
				Seu cadastro foi realizado com sucesso.
				<br><br>
				<b>
				<a href="<?=Yii::$app->params['pathUrlWeb'] . 'login'?>" target="_blank">
					Clique aqui para acessar o site
				</a>
				</b>
			</td>
		</tr>
		</table>
		<table cellpadding="0" cellspacing="5" border="0" width="100%" style="background-color:#0095da;font-family:verdana;font-size:16px;color:#fff;">
		<tr>
			<td width="100" align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">NOME</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$user->name?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">SOBRENOME</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$user->lastname?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">E-MAIL</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$user->email?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">TELEFONE</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$cliente->phone?></td>
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

