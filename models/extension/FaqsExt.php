<?php

namespace app\models\extension;

use Yii;
use \app\models\Faqs;

class FaqsExt extends \app\models\Faqs
{
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function LoadFaqs() 
    {
        $faqs = Faqs::find()
        ->where(" status = 1 " )
        ->orderBy('ordem')
        ->all();

        return $faqs;
    }
}
