<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property string $code
 * @property string $user
 * @property string $moip_customer_code
 * @property string $client_id
 * @property string $client_sex
 * @property string $client_birthdate
 * @property string $twitter-account
 * @property string $facebook-account
 * @property string $instagram-account
 * @property string $fbconnect
 *
 * @property Users $user0
 * @property Companies[] $companies
 * @property Requests[] $requests
 */
class Clients extends \yii\db\ActiveRecord
{
    public $company_name, $fantasy_name, $company_id, $branch, $sector;
    public $name, $lastname, $phone, $email, $postal_code, $street, $number, $complement, $neighborhood, $city, $state;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            #[['code', 'user'], 'required'],
            [['code', 'user'], 'string', 'max' => 36],
            [['moip_customer_code', 'twitter-account', 'facebook-account', 'instagram-account', 'fbconnect'], 'string', 'max' => 100],
            [['client_id'], 'string', 'max' => 15],
            [['client_sex'], 'string', 'max' => 1],
            [['client_birthdate'], 'string', 'max' => 10],
            [['code'], 'unique'],
            [['user'], 'unique'],
            [['client_id'], 'unique'],
            [['moip_customer_code'], 'unique'],
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
            'user' => 'User',
            'moip_customer_code' => 'Moip Customer Code',
            'client_id' => 'Client ID',
            'client_sex' => 'Client Sex',
            'client_birthdate' => 'Client Birthdate',
            'twitter-account' => 'Twitter Account',
            'facebook-account' => 'Facebook Account',
            'instagram-account' => 'Instagram Account',
            'fbconnect' => 'Fbconnect',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Users::className(), ['code' => 'user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Companies::className(), ['client' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Requests::className(), ['client' => 'code']);
    }
}
