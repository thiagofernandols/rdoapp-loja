<?php

namespace app\helpers;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Standard;
Use yii\helpers\Html;

class CustomHelper
{
    /**
     * Checa status do registro pra colorir a linha.
     *
     * @param string $status to atributo que contém o status do registro
     * @return Response|string
     */
    public static function mudaCorStatus($status='')
    {
        if ($status == 'INATIVO') {
            return 'class="bg-danger text-white"';
        }else{
            return null;
        }
    }

    public static function limpaCamposEspeciais($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public static function formatCnpj ( $cnpj ){
        $y = sprintf("%014s",$cnpj);// só inclui esta linha
        $str = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})([0-9]{2})/", "$1.$2.$3/$4-$5", $y);
        return $str;
    }

    public static function retornaObjetoCombo($model, $nomeBase, $idBase, $idHtml, $prompt, $orderBy, $size=20  ) {
        $models = ArrayHelper::map($model::find()->orderBy([$orderBy=>SORT_ASC])->all(), $idBase, $nomeBase);
        $cmbCombo = Html::activeDropDownList($model, $idBase, $models,
            ['class' => 'form-control', 'prompt' => $prompt,'style' => 'width:'.$size.'%', 'required' => '',
                'id' => $idHtml, 'name' => $idHtml]);

        return $cmbCombo;
    }
	
	public static function sendEmail($from, $to, $subject, $text_body, $html_body)
	{
		$send = Yii::$app->mailer->compose()
        ->setFrom([$from => Yii::$app->params['smtp_from_name']])
        ->setTo($to)
        #->setBcc(Yii::$app->params['mail_dev'])
        ->setBcc(array(Yii::$app->params['mail_dev'], Yii::$app->params['mail_ceo'], Yii::$app->params['mail_ceo2']))
		->setSubject($subject)
		->setTextBody($text_body)
		->setHtmlBody($html_body)
		->send();
		
		return $send;
	}
    
    public static function pegarImagem($strCaminhoFull, $strPathSalvar, $strNomeImagemSalvar) {
        if (!is_dir($strPathSalvar)) {
            if (!mkdir($strPathSalvar, 0777, true)) {
                throw new \yii\web\BadRequestHttpException('Erro ao criar o diretório ' . $strPathSalvar, 500);
            }
        }
		
        if (!file_exists($strPathSalvar . $strNomeImagemSalvar))
		{
            $ctx = stream_context_create(array('http' => array('timeout' => 60)));
            $strImagem = file_get_contents($strCaminhoFull, 0, $ctx);
            $hndSalvar = fopen($strPathSalvar . $strNomeImagemSalvar, "w");
            fwrite($hndSalvar, $strImagem);
            fclose($hndSalvar);
            return $strPathSalvar . $strNomeImagemSalvar;
			
        } else {
            return $strPathSalvar . $strNomeImagemSalvar;
        }
    }

    public static function guidv4($data = '')
    {
        if(!$data)
        {
            $data = openssl_random_pseudo_bytes(16);
        }
        
        assert(strlen($data) == 16);
    
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public static function getRealIpAddr()
    {
        $ips = array();

        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
        $ip=$_SERVER['REMOTE_ADDR'];
        }

        if(in_array($ip, $ips))
        {
            return true;
        
        } else {
            return false;
        }
    }
    
    public function validateRecaptcha($recaptcha)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret=6Ld8LnoaAAAAAA2fF4fBleHlijzlE1AhHqWz2Yla&response='.$recaptcha);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        if($response->success) 
        {
            return $recaptcha = true;

        } else {
            return $recaptcha = false;
        }
    }

}
