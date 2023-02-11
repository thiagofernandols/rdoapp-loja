<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plans".
 *
 * @property string $code
 * @property string $plan_type
 * @property string $slug
 * @property string $moip_plan_code
 * @property string $name
 * @property string $subtitle
 * @property string $description
 * @property string $date_create
 * @property string $value
 * @property string $setup_fee
 * @property string $interval
 * @property string $payment_method
 * @property int $status
 *
 * @property Licenses $planType
 * @property Requests[] $requests
 */
class Plans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'slug'], 'required'],
            [['description', 'interval', 'payment_method'], 'string'],
            [['date_create'], 'safe'],
            [['value', 'setup_fee'], 'number'],
            [['status'], 'integer'],
            [['code', 'plan_type'], 'string', 'max' => 36],
            [['slug', 'name'], 'string', 'max' => 45],
            [['moip_plan_code'], 'string', 'max' => 100],
            [['subtitle'], 'string', 'max' => 245],
            [['code'], 'unique'],
            [['slug'], 'unique'],
            [['moip_plan_code'], 'unique'],
            [['name'], 'unique'],
            [['plan_type'], 'exist', 'skipOnError' => true, 'targetClass' => Licenses::className(), 'targetAttribute' => ['plan_type' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'plan_type' => 'Plan Type',
            'slug' => 'Slug',
            'moip_plan_code' => 'Moip Plan Code',
            'name' => 'Name',
            'subtitle' => 'Subtitle',
            'description' => 'Description',
            'date_create' => 'Date Create',
            'value' => 'Value',
            'setup_fee' => 'Setup Fee',
            'interval' => 'Interval',
            'payment_method' => 'Payment Method',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanType()
    {
        return $this->hasOne(Licenses::className(), ['code' => 'plan_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Requests::className(), ['plan' => 'code']);
    }
}
