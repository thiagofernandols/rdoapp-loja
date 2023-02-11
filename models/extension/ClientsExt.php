<?php

namespace app\models\extension;

use Yii;
use \app\models\Clients;
use \app\models\Users;

class ClientsExt extends \app\models\Clients implements \yii\web\IdentityInterface
{
    public $id;
    public $email;
    public $password;
    public $authKey;
    public $accessToken;
    public $nome;

    public static function findById($id)
    {
        $cliente = Clients::find()
            ->alias('c')
            ->select(['c.*'
            , 'DATE_FORMAT(STR_TO_DATE(c.client_birthdate, "%d/%m/%Y"), "%Y-%m-%d") AS client_birthdate'
            ])
            ->where(['c.user' => $id])
            ->one();

        if (count($cliente) == 1)
		{
            return $cliente;
        
		} else { 
			throw new \yii\web\BadRequestHttpException('Usuário inativo ou inexistente.', 500);
		}
    }
	
    public static function findCompleteById($id)
    {
        $cliente = Clients::find()
            ->alias('c')
            ->select(['c.*'
            ,   'DATE_FORMAT(STR_TO_DATE(c.client_birthdate, "%d/%m/%Y"), "%Y-%m-%d") AS client_birthdate'
            ,   'u.name', 'u.lastname', 'u.phone', 'u.email', 'u.postal_code', 'street', 'number', 'neighborhood', 'complement', 'city', 'state'
            ,   'cp.company_name', 'cp.fantasy_name', 'cp.company_id', 'cp.branch', 'cp.sector'
            ])
            ->innerJoin('users u', 'u.code = c.user')
            ->leftJoin('companies cp', 'cp.client = c.code')
            ->where(['c.user' => $id])
            ->one();

        if (count($cliente) == 1)
		{
            return $cliente;
        
		} else { 
			throw new \yii\web\BadRequestHttpException('Usuário inativo ou inexistente.', 500);
		}
    }
	
    public static function findCompleteByEmail($email)
    {
        $cliente = Clients::find()
            ->alias('c')
            ->select(['c.*'
            ,   'DATE_FORMAT(STR_TO_DATE(c.client_birthdate, "%d/%m/%Y"), "%Y-%m-%d") AS client_birthdate'
            ,   'u.name', 'u.lastname', 'u.phone', 'u.email', 'u.postal_code', 'street', 'number', 'neighborhood', 'complement', 'city', 'state'
            ,   'cp.company_name', 'cp.fantasy_name', 'cp.company_id', 'cp.branch', 'cp.sector'
            ])
            ->innerJoin('users u', 'u.code = c.user')
            ->leftJoin('companies cp', 'cp.client = c.code')
            ->where(['u.email' => $email])
            ->one();

        if (count($cliente) == 1)
		{
            return $cliente;
		}
    }
	
    public static function findByClienteEmail($email)
    {
        $clienteFind = Clients::find()
            ->where(['email' => $email])
            ->one();

        if (count($clienteFind) < 1)
		{
            Yii::$app->session->setFlash('error_user', 'ERRO 1: Login inválido.');
            return null;
        }

        if ($clienteFind->status != 1) 
		{
            Yii::$app->session->setFlash('error_user', 'ERRO 2: Usuário inativo.');
            return null;
        }

        if (count($clienteFind) > 0) 
		{
            $cliente['email'] = $clienteFind->email;
            $cliente['id'] = $clienteFind->id;
            $cliente['password'] = $clienteFind->password;
            $cliente['authKey'] = "key_".$clienteFind->id;
            $cliente['nome'] = $clienteFind->nome;
            $cliente['accessToken'] = "token_".$clienteFind->id;
			
            return new static($cliente);
        }

        Yii::$app->session->setFlash('error_user', 'ERRO 3: Login inválido.');
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$clientes as $cliente) {
            if ($cliente['accessToken'] === $token) {
                return new static($cliente);
            }
        }

        return null;
    }
	

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $clienteFind = \app\models\Clients::find()
            ->where(['id' => $id])
            ->one();

        if (count($clienteFind) > 0) {
            $cliente['email'] = $clienteFind->email;
            $cliente['id'] = $clienteFind->id;
            $cliente['password'] = $clienteFind->password;
            $cliente['authKey'] = "key_".$clienteFind->id;
            $cliente['nome'] = $clienteFind->nome;
            $cliente['accessToken'] = "token_".$clienteFind->id;
            return new static($cliente);
        }else{
            return null;
        }
        #//return isset(self::$clientes[$id]) ? new static(self::$clientes[$id]) : null;
    }
	
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
	
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current cliente
     */
    public function validatePassword($password)
    {
        if (!Yii::$app->getSecurity()->validatePassword($password, $this->password))
        {
            Yii::$app->session->setFlash('error_password', 'ERRO: Senha inválida.');
            return false;

        }else {
            return true;
        }
    }

    public static function checkEmail($clientes_ids, $clientes_emails) 
	{
        if (isset($clientes_ids)) 
		{
            $query = Clients::find()
                ->select(['email'])
                ->where(['email' => $clientes_emails])
                ->andWhere(['<>', 'id', $clientes_ids])
                ->One();
				
        }else{
            $query = Clients::find()
                ->select(['email'])
                ->where(['email' => $clientes_emails])
                ->One();
        }
        return $query;
    }
	
    public static function findBySenhaHash($password_recover) 
	{
		$query = Clients::find()
			->select()
			->where(['password_recover' => $password_recover])
			->One();
				
        return $query;
    }
	
    public function trocaSenha($idClients, $passwordClients, $novaSenha)
    {
        $query = \app\models\Clients::find()->where(['id' => $idClients])->one();

        if (!Yii::$app->getSecurity()->validatePassword($passwordClients, Yii::$app->user->identity->password)) {
            return false;
        }

        if ($query->id) {
            $query->password = $novaSenha;
            if ($query->save()) 
            {
                return true;

            }else{
                return false;
            }
        }else{
            return false;
        }
    }	
}
