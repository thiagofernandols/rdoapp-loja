<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property string $code
 * @property string $name
 * @property string $status
 *
 * @property Companies[] $companies
 */
class Branches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'status'], 'required'],
            [['code'], 'string', 'max' => 36],
            [['name', 'status'], 'string', 'max' => 45],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Companies::className(), ['branch' => 'code']);
    }
}
