<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\UsersBooks;

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
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */

    //public $login;
    //public $name;
    //public $email;
    //public $password;
    //public $password_repeat;
    public $auth_key;
    public $books_read;
    public $books_want;

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
            [['login', 'name', 'email', 'password'], 'required'],
            [['login', 'name', 'email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 64],
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
            //'password_repeat' => 'Confirm password'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersBooks()
    {
        return $this->hasMany(UsersBooks::className(), ['user_id' => 'id']);
    }
    public function getBooks($status)
    {
        return UsersBooks::find()->where(['user_id' => $this->id, 'status_id' => $status])->joinWith('book')->all();
    }

    public static function findByLoginPass($login, $password) {
        $user = self::findOne(['login' => $login]);
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
            return $user;
        } else {
            return $user = [];
        }
    }

    public static function findUserInfo($login) {
        return self::findOne(['login' => $login]);
    }
    public static function insertUser($login, $name, $email, $password) {
        $user = new User;
        $user->login = $login;
        $user->name = $name;
        $user->email = $email;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($password);
        return $user->save();
    }
    #IndentityInterface
    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }
}
