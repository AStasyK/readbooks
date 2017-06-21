<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $title
 * @property string $author
 *
 * @property UsersBooks[] $usersBooks
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $status;

    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'author'], 'required'],
            [['title', 'author'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author' => 'Author',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersBooks()
    {
        return $this->hasMany(UsersBooks::className(), ['book_id' => 'id']);
    }
    //public static function findByStatus($status, $user_id){
    //    return self::findALL(['user_id' => $user_id, 'status' => $status]);
    //}
}
