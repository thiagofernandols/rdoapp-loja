<title><?=$subject?></title>
<style type="text/css">*{margin:0;padding:0;border:none;font-family:verdana;text-decoration:none;}img+div{display:none !important;}a:link{color: yellow}a:visited{color: white}</style>
<center>
<table cellpadding="0" cellspacing="0" border="0" width="600" style="width:600px;margin:10px;">
<tr><td align="center" width="600" style="height:80px;text-align:center;"><a href="<?=Yii::$app->params['pathUrlWeb']?>"><img src="<?=Yii::$app->params['pathUrlImages']?>mail/topo-logo.jpg" width="600" height="80" style="width:600px;height:80px;" alt="" align="center" /></a></td></tr>
<tr>
	<td width="600" align="center" style="background-color:#0095da;text-align:left;padding:20px 60px;font-family:verdana;font-size:16px;color:#fff;">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#0095da;font-family:verdana;font-size:24px;color:#fff;padding:20px 0;">
		<tr>
			<td align="center"><strong>Olá, <?=$assinatura->name?> <?=$assinatura->lastname?></strong></td>
		</tr>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#0095da;font-family:verdana;font-size:16px;color:#fff;padding:20px 0;line-height:24px;">
		<tr>
			<td align="center">
				Recebemos sua solicitação de assinatura #<?=$assinatura->code_alias?>.
				<br><br>
				<?	if(isset($fatura))
					 {
				?>
				<b>
				<a href="<?=$fatura?>" title="Baixar Boleto" target="_blank">Clique aqui para baixar o boleto</a>
				</b>
				<? 	} ?>
			</td>
		</tr>
		</table>
		<table cellpadding="0" cellspacing="5" border="0" width="100%" style="background-color:#0095da;font-family:verdana;font-size:16px;color:#fff;">
		<tr>
			<td width="100" align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">CÓDIGO DA ASSINATURA</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->code_alias?></td>
		</tr>
		<tr>
			<td width="100" align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">PLANO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->plano?></td>
		</tr>
		<tr>
			<td width="100" align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">TIPO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->licenca?></td>
		</tr>
		<tr>
			<td width="100" align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">VALOR</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;">R$ <?=number_format($assinatura->checkout_value, 2)?></td>
		</tr>
        <?  if($assinatura->payment_method) {?>
		<tr>
			<td width="100" align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">FORMA DE PAGAMENTO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->payment_method?></td>
		</tr>
        <?  } ?>
        <?  if($assinatura->dia_vencimento > 0) {?>
		<tr>
			<td width="100" align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">DIA DE VENCIMENTO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=sprintf('%02d', $assinatura->dia_vencimento); ?></td>
		</tr>
        <?  } ?>
		<tr>
			<td width="100" align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">NOME</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->name?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">SOBRENOME</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->lastname?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">CPF</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->client_id?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">E-MAIL</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->email?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">TELEFONE</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->phone?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">SEXO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->client_sex?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">DATA DE NASCIMENTO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->client_birthdate?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">CEP</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->postal_code?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">ENDEREÇO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->street?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">NÚMERO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->number?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">COMPLEMTENTO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->complement?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">BAIRRO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->neighborhood?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">CIDADE</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->cidade?></td>
		</tr>
		<tr>
			<td align="center" style="padding:10px;border-radius:50px;font-size:10px;background-color:#eee;color:#0095da;font-weight:bold;">ESTADO</td>
			<td align="left" style="padding:10px 20px;border-radius:50px;font-size:14px;background-color:#fff;color:#777;"><?=$assinatura->estado?></td>
		</tr>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#0095da;font-family:verdana;font-size:14px;color:#fff;padding:20px 0;line-height:20px;">
		<tr>
			<td align="center">
				<b>
				<a href="<?=Yii::$app->params['pathUrlWeb'] . 'assinatura/' . $assinatura->code?>" target="_blank">
					Clique aqui para consultar sua assinatura<br /><br />
				</a>
				</b>
			</td>
		</tr>
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

