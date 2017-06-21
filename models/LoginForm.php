<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $login
 * @property string $name
 * @property string $email
 * @property string $password
 *
 * @property UsersBooks[] $usersBooks
 */
class LoginForm extends Model
{
    /**
     * @inheritdoc
     */
    private $_user = false; #подчеркивание т.к. приватное
    public $login;
    public $password;

    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'trim'],
            [['login'], 'filter', 'filter' => function ($value) {
                $value = stripslashes($value);
                $value = htmlspecialchars($value);
                return $value;
            }],
            [['login'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 64],
            [['password'], 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user) {
                return Yii::$app->user->login($user, 3600*24*30);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByLoginPass($this->login, $this->password);
        }
        return $this->_user;
    }

    public function validatePassword($attribute) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, 'Wrong login or password given');
            }
        }
    }
}
