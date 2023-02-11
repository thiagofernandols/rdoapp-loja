<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property string $code
 * @property string $client
 * @property string $branch
 * @property string $sector
 * @property string $company_id
 * @property string $company_name
 * @property string $fantasy_name
 *
 * @property Branches $branch0
 * @property Clients $client0
 * @property Sectors $sector0
 * @property Requests[] $requests
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'company_id', 'company_name', 'fantasy_name'], 'required'],
            [['code', 'client', 'branch', 'sector'], 'string', 'max' => 36],
            [['company_id'], 'string', 'max' => 19],
            [['company_name', 'fantasy_name'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['company_id'], 'unique'],
            [['branch'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch' => 'code']],
            [['client'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client' => 'code']],
            [['sector'], 'exist', 'skipOnError' => true, 'targetClass' => Sectors::className(), 'targetAttribute' => ['sector' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'client' => 'Client',
            'branch' => 'Branch',
            'sector' => 'Sector',
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'fantasy_name' => 'Fantasy Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch0()
    {
        return $this->hasOne(Branches::className(), ['code' => 'branch']);
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
    public function getSector0()
    {
        return $this->hasOne(Sectors::className(), ['code' => 'sector']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Requests::className(), ['company' => 'code']);
    }
}
