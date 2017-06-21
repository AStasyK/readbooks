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
class SignupForm extends Model
{
    /**
     * @inheritdoc
     */
    public $login;
    public $name;
    public $email;
    public $password;
    public $password_repeat;

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
            [['login', 'name', 'email', 'password', 'password_repeat'], 'required'],
            [['login', 'email'], 'unique', 'targetClass' => 'app\models\User'],
            [['login', 'name', 'email'], 'string', 'max' => 255],
            [['login', 'name', 'email', 'password'], 'trim'],
            [['login', 'name', 'email'], 'filter', 'filter' => function ($value) {
                $value = stripslashes($value);
                $value = htmlspecialchars($value);
                return $value;
            }],
            [['password'], 'string', 'max' => 64],
            [['password_repeat'], 'string', 'max' => 64],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['password_repeat', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Confirm password'
        ];
    }

    public function signup()
    {
        $status = User::insertUser($this->login, $this->name, $this->email, $this->password);
        //$status = User::insertUser($this->login, $this->name, $this->email, $this->password);
        return $status;
    }
}
