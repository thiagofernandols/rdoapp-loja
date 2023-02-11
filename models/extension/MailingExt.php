<?php

namespace app\models\extension;

use Yii;
use \app\models\Mailing;

class MailingExt extends \app\models\Mailing
{
    public function CadastrarNews($nome = '', $email)
	{
		# CLASSES #
		$mailing = new Mailing;
		
		# DUPLICIDADE #
        $query = $mailing->find()->where(['email' => $email])->one();
		
		# INSERT #
		if(count($query) == 0)
		{
			$mailing->nome = $nome;
			$mailing->email = $email;
			
			if($mailing->save())
			{
				return true;
			
			} else {
				return false;
			}
		
		} else {
			return true;
		}
    }
}
