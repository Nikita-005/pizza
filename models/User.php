<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    // public $id;
    // public $username;
    // public $password;
    // public $authKey;
    // public $accessToken;

    public $password;
    public $check;

    public function rules()
    {
        return [
            [['name', 'login', 'email', 'phone', 'password', 'birth'], 'required'],
            ['name', 'match', 'pattern' => '/^[а-яА-ЯёЁ\-]+$/ui', 'message' => 'Только русские буквы, тире'],
            ['login', 'match', 'pattern' => '/^[-A-Za-z\d]+$/', 'message' => 'Только латиница, цифры, тире'],
            ['login', 'unique'],
            // ['password', 'SPasswordValidator'],
            ['email', 'email'],
            ['email', 'unique'],
            ['birth', 'date', 'format' => 'php:Y-m-d', 'max' => '2006-01-01', 'tooBig' => 'Дата рождения не должна быть больше 01.01.2006.'],
            ['phone', 'match', 'pattern' => '/^\+7\([\d]{3}\)-[\d]{3}(-[\d]{2}){2}$/', 'message' => 'В формате +7(XXX)-XXX-XX-XX'],
            ['check', 'required', 'requiredValue' => true, 'message' => 'Необходимо согласится с правилами на обработку персональных данных']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'login' => 'Login',
            'email' => 'Адрес e-mail',
            'phone' => 'Телефон',
            'created_at' => 'Зарегистрирован',
            'password' => 'Пароль',
            'birth' => 'Дата рождения',
            'check' => 'Согласие на обработку персональных данных',
        ];
    }




    /**
     * {@inheritdoc}
     */

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['login' => $username]);
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
        return $this->auth_key;
    }

    public function getIsAdmin()
    {
        return $this->role_id;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }
}






