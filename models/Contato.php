<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contato".
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $telefone
 * @property string $cidade
 * @property string $sigla
 * @property string $mensagem
 * @property string $assunto
 * @property int $status
 * @property string $datacadastro
 * @property string $datamodificacao
 */
class Contato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mensagem'], 'string'],
            [['status'], 'integer'],
            [['datacadastro', 'datamodificacao'], 'safe'],
            [['nome', 'email', 'telefone', 'cidade', 'sigla'], 'string', 'max' => 255],
            [['assunto'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'email' => 'Email',
            'telefone' => 'Telefone',
            'cidade' => 'Cidade',
            'sigla' => 'Sigla',
            'mensagem' => 'Mensagem',
            'assunto' => 'Assunto',
            'status' => 'Status',
            'datacadastro' => 'Datacadastro',
            'datamodificacao' => 'Datamodificacao',
        ];
    }
}
