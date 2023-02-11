<?php

namespace app\models\extension;

use Yii;
use \app\models\Downloads;
use app\helpers\CustomHelper;

class DownloadsExt extends \app\models\Downloads
{
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function LoadDownloads() 
    {
        $downloads = Downloads::find()
        ->select(['*', 'UPPER(SUBSTRING_INDEX(arquivo, ".", -1)) AS extension'])
        ->where(" status = 1 " )
        ->all();

		# PEGAR IMAGEM
		if ($downloads) 
		{
			foreach ($downloads as $download)
			{
				if($download->arquivo != '')
				{
					ini_set("allow_url_fopen", 1);
					CustomHelper::pegarImagem(
                            Yii::$app->params['pathUrlAdm'] . 'assets/images/downloads/' . $download['arquivo']
                        ,   Yii::$app->params['pathSysAssets'] . 'images/downloads/'
                        ,   $download['arquivo']
                    );
					ini_set("allow_url_fopen", 0);
				}
			}
		}

        return $downloads;
    }
}
