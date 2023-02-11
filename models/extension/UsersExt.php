<?php

namespace app\models\extension;

use Yii;
use \app\models\Users;
use \app\models\Clients;

class UsersExt extends \app\models\Users implements \yii\web\IdentityInterface
{
    public $code;
    public $email;
    public $password;
    public $authKey;
    public $accessToken;
    public $name;

    public static function findById($code)
    {
        $user = Users::find()
            ->alias('c')
            ->select(['c.*'
            ])
            ->where(['c.code' => $code, 'c.status' => 1])
            ->one();

        if (count($user) == 1)
		{
            return $user;
        
		} else { 
			throw new \yii\web\BadRequestHttpException('Usuário inativo ou inexistente.', 500);
		}
    }
	
    public static function findByUserEmail($email)
    {
        $userFind = Users::find()
            ->where(['email' => $email])
            ->one();

        if (count($userFind) < 1)
		{
            Yii::$app->session->setFlash('error_user', 'ERRO: Login inválido.');
            return null;
        }

        if ($userFind->status != 1) 
		{
            Yii::$app->session->setFlash('error_user', 'ERRO: Usuário inativo.');
            return null;
        }

        if (count($userFind) > 0) 
		{
            $user['email'] = $userFind->email;
            $user['code'] = $userFind->code;
            $user['password'] = $userFind->password;
            $user['authKey'] = "key_".$userFind->code;
            $user['name'] = $userFind->name;
            $user['accessToken'] = "token_".$userFind->code;
			
            return new static($user);
        }

        Yii::$app->session->setFlash('error_user', 'ERRO: Login inválido.');
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
	

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($code)
    {
        $userFind = \app\models\Users::find()
            ->where(['code' => $code])
            ->one();

        if (count($userFind) > 0) {
            $user['email'] = $userFind->email;
            $user['code'] = $userFind->code;
            $user['password'] = $userFind->password;
            $user['authKey'] = "key_".$userFind->code;
            $user['name'] = $userFind->name;
            $user['accessToken'] = "token_".$userFind->code;
            return new static($user);
        }else{
            return null;
        }
    }
	
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->code;
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
     * @return bool if password provided is valid for current user
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

    public static function checkEmail($users_ids, $users_emails) 
	{
        if (isset($users_ids)) 
		{
            $query = Users::find()
                ->select(['email'])
                ->where(['email' => $users_emails])
                ->andWhere(['<>', 'code', $users_ids])
                ->One();
				
        }else{
            $query = Users::find()
                ->select(['email'])
                ->where(['email' => $users_emails])
                ->One();
        }
        return $query;
    }
	
    public static function findByEmail($email) 
	{
		$query = Users::find()
			->select('*')
			->where(['email' => $email])
			->One();
				
        return $query;
    }
	
    public static function findBySenhaHash($password_recover) 
	{
		$query = Users::find()
			->select('*')
			->where(['senha_recover' => $password_recover])
			->One();
				
        return $query;
    }
	
    public function trocaSenha($idUsers, $passwordUsers, $novaSenha)
    {
        $query = \app\models\Users::find()->where(['code' => $idUsers])->one();

        if (!Yii::$app->getSecurity()->validatePassword($passwordUsers, Yii::$app->user->identity->password)) {
            return false;
        }

        if ($query->code) {
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
