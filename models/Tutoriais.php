<?php

namespace app\models;

use Yii;

/**
* This is the base-model class for table "tutoriais".
*
    * @property integer $id
    * @property string $tutorial
    * @property string $tag
    * @property string $texto
    * @property string $imagem
    * @property string $video
    * @property integer $status
    * @property string $datacadastro
    * @property string $datamodificacao
*/
class Tutoriais extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'tutoriais';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['status'], 'integer'],
            [['datacadastro', 'datamodificacao'], 'safe'],
            [['tutorial', 'tag', 'imagem', 'video'], 'string', 'max' => 255],
            [['texto'], 'string', 'max' => 155]
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'tutorial' => 'Tutorial',
    'tag' => 'Tag',
    'texto' => 'Texto',
    'imagem' => 'Imagem',
    'video' => 'Video',
    'status' => 'Status',
    'datacadastro' => 'Datacadastro',
    'datamodificacao' => 'Datamodificacao',
];
}
}
