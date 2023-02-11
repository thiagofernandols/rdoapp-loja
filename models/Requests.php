<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property string $code
 * @property string $code_alias
 * @property string $client
 * @property string $user
 * @property string $plan
 * @property string $company
 * @property string $moip_subscription_code
 * @property string $checkout_date
 * @property string $checkout_value
 * @property string $setup_fee_subscription
 * @property string $payment_method
 * @property string $moip_subscription_status
 * @property int $dia_vencimento
 * @property string $erro
 * @property int $status
 *
 * @property Clients $client0
 * @property Companies $company0
 * @property Plans $plan0
 * @property Users $user0
 */
class Requests extends \yii\db\ActiveRecord
{
    public $state, $city, $status_label;
    public $client_birthdate, $client_sex, $client_id, $moip_customer_code;
    public $email, $name, $lastname, $phone, $postal_code, $street, $number, $complement, $neighborhood;
    public $company_name, $fantasy_name, $company_id, $branch, $sector;
    public $plano;
    public $licenca;
    public $cidade;
    public $estado;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'code_alias', 'client', 'user', 'plan', 'company', 'moip_subscription_code', 'checkout_date', 'checkout_value', 'setup_fee_subscription'], 'required'],
            [['checkout_date'], 'safe'],
            [['checkout_value', 'setup_fee_subscription'], 'number'],
            [['dia_vencimento', 'status'], 'integer'],
            [['erro'], 'string'],
            [['code', 'client', 'user', 'plan', 'company'], 'string', 'max' => 36],
            [['code_alias'], 'string', 'max' => 10],
            [['moip_subscription_code'], 'string', 'max' => 100],
            [['payment_method', 'moip_subscription_status'], 'string', 'max' => 45],
            [['code'], 'unique'],
            [['moip_subscription_code'], 'unique'],
            [['client'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client' => 'code']],
            [['company'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['company' => 'code']],
            [['plan'], 'exist', 'skipOnError' => true, 'targetClass' => Plans::className(), 'targetAttribute' => ['plan' => 'code']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'code_alias' => 'Code Alias',
            'client' => 'Client',
            'user' => 'User',
            'plan' => 'Plan',
            'company' => 'Company',
            'moip_subscription_code' => 'Moip Subscription Code',
            'checkout_date' => 'Checkout Date',
            'checkout_value' => 'Checkout Value',
            'setup_fee_subscription' => 'Setup Fee Subscription',
            'payment_method' => 'Payment Method',
            'moip_subscription_status' => 'Moip Subscription Status',
            'dia_vencimento' => 'Dia Vencimento',
            'erro' => 'Erro',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient0()
    {
        return $this->hasOne(Clients::className(), ['code' => 'client']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany0()
    {
        return $this->hasOne(Companies::className(), ['code' => 'company']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlan0()
    {
        return $this->hasOne(Plans::className(), ['code' => 'plan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Users::className(), ['code' => 'user']);
    }
}
