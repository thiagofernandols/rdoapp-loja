<?php

namespace app\models;

use Yii;

/**
* This is the base-model class for table "downloads".
*
    * @property integer $id
    * @property string $download
    * @property string $arquivo
    * @property integer $status
    * @property string $datacadastro
    * @property string $datamodificacao
*/
class Downloads extends \yii\db\ActiveRecord
{
    public $extension;
/**
* @inheritdoc
*/
public static function tableName()
{
return 'downloads';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['status'], 'integer'],
            [['datacadastro', 'datamodificacao'], 'safe'],
            [['download', 'arquivo'], 'string', 'max' => 255]
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'download' => 'Download',
    'arquivo' => 'Arquivo',
    'status' => 'Status',
    'datacadastro' => 'Datacadastro',
    'datamodificacao' => 'Datamodificacao',
];
}
}
