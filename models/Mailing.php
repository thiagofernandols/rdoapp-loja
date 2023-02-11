<?php

namespace app\models;

use Yii;

/**
* This is the base-model class for table "mailing".
*
    * @property integer $id
    * @property string $nome
    * @property string $email
    * @property string $origem
    * @property integer $status
    * @property string $datacadastro
*/
class Mailing extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'mailing';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['status'], 'integer'],
            [['datacadastro'], 'safe'],
            [['nome', 'email', 'origem'], 'string', 'max' => 255]
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'nome' => 'Nome',
    'email' => 'Email',
    'origem' => 'Origem',
    'status' => 'Status',
    'datacadastro' => 'Datacadastro',
];
}
}
