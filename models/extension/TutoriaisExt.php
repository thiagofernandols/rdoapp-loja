<?php

namespace app\models\extension;

use Yii;
use \app\models\Tutoriais;
use app\helpers\CustomHelper;

class TutoriaisExt extends \app\models\Tutoriais
{
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function LoadTutoriais() 
    {
        $tutoriais = Tutoriais::find()
        ->select(['*' , 'DATE_FORMAT(datacadastro, "%d/%m/%Y") as datacadastro'])
        ->where(" status = 1 " )
        ->orderBy('datacadastro DESC')
        ->all();

		# PEGAR IMAGEM
		if ($tutoriais) 
		{
			foreach ($tutoriais as $tutorial)
			{
				if($tutorial->imagem != '')
				{
					ini_set("allow_url_fopen", 1);
					CustomHelper::pegarImagem(
                            Yii::$app->params['pathUrlAdm'] . 'assets/images/tutoriais/' . $tutorial['imagem']
                        ,   Yii::$app->params['pathSysAssets'] . 'images/tutoriais/'
                        ,   $tutorial['imagem']
                    );
					ini_set("allow_url_fopen", 0);
				}
			}
		}

        return $tutoriais;
    }
}
