<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property string $code
 * @property string $state
 * @property string $name
 *
 * @property States $state0
 * @property Users[] $users
 */
class Cities extends \yii\db\ActiveRecord
{
    public $city, $abbr;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'state', 'name'], 'required'],
            [['code', 'state'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['state'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['state' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'state' => 'State',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState0()
    {
        return $this->hasOne(States::className(), ['code' => 'state']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['city' => 'code']);
    }
}
