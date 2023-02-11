<?php

namespace app\models;

use Yii;

/**
* This is the base-model class for table "faqs".
*
    * @property integer $id
    * @property integer $ordem
    * @property string $faq
    * @property string $texto
    * @property integer $status
    * @property string $datacadastro
    * @property string $datamodificacao
*/
class Faqs extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'faqs';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['ordem', 'status'], 'integer'],
            [['texto'], 'string'],
            [['datacadastro', 'datamodificacao'], 'safe'],
            [['faq'], 'string', 'max' => 255]
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'ordem' => 'Ordem',
    'faq' => 'Faq',
    'texto' => 'Texto',
    'status' => 'Status',
    'datacadastro' => 'Datacadastro',
    'datamodificacao' => 'Datamodificacao',
];
}
}
