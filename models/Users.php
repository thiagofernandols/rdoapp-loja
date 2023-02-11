<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $code
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $city_other
 * @property string $state_other
 * @property string $role
 * @property string $username
 * @property string $email
 * @property string $name
 * @property string $lastname
 * @property string $phone
 * @property string $password
 * @property int $access-date
 * @property int $registration_date
 * @property string $token_notfication
 * @property string $plataform
 * @property string $postal_code
 * @property string $neighborhood
 * @property string $street
 * @property string $number
 * @property string $complement
 * @property int $status
 * @property int $how_you_meet
 * @property string $senha_recover
 *
 * @property Clients $clients
 * @property Requests[] $requests
 * @property Cities $city0
 * @property States $state0
 */
class Users extends \yii\db\ActiveRecord
{
    public $client_sex, $client_birthdate, $client_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            #[['code', 'role', 'username', 'email', 'name', 'registration_date'], 'required'],
            [['access-date', 'registration_date', 'status', 'how_you_meet'], 'integer'],
            [['code', 'city', 'state'], 'string', 'max' => 36],
            [['country', 'city_other', 'state_other', 'username'], 'string', 'max' => 200],
            [['role', 'plataform', 'number'], 'string', 'max' => 10],
            [['email', 'password', 'street'], 'string', 'max' => 100],
            [['name', 'lastname', 'postal_code', 'neighborhood'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 15],
            [['token_notfication'], 'string', 'max' => 356],
            [['complement'], 'string', 'max' => 145],
            [['senha_recover'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city' => 'code']],
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
            'country' => 'Country',
            'city' => 'City',
            'state' => 'State',
            'city_other' => 'City Other',
            'state_other' => 'State Other',
            'role' => 'Role',
            'username' => 'Username',
            'email' => 'Email',
            'name' => 'Name',
            'lastname' => 'Lastname',
            'phone' => 'Phone',
            'password' => 'Password',
            'access-date' => 'Access Date',
            'registration_date' => 'Registration Date',
            'token_notfication' => 'Token Notfication',
            'plataform' => 'Plataform',
            'postal_code' => 'Postal Code',
            'neighborhood' => 'Neighborhood',
            'street' => 'Street',
            'number' => 'Number',
            'complement' => 'Complement',
            'status' => 'Status',
            'how_you_meet' => 'How You Meet',
            'senha_recover' => 'Senha Recover',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasOne(Clients::className(), ['user' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Requests::className(), ['user' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(Cities::className(), ['code' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState0()
    {
        return $this->hasOne(States::className(), ['code' => 'state']);
    }
}
