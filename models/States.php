<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property string $code
 * @property string $abbr
 * @property string $name
 * @property string $region
 *
 * @property Cities[] $cities
 * @property Users[] $users
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'abbr', 'name', 'region'], 'required'],
            [['code', 'abbr', 'name'], 'string', 'max' => 36],
            [['region'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['abbr'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'abbr' => 'Abbr',
            'name' => 'Name',
            'region' => 'Region',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['state' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['state' => 'code']);
    }
}
