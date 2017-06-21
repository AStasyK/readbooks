<?php

namespace app\models;

use Yii;
use app\models\Book;

/**
 * This is the model class for table "users_books".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $book_id
 * @property integer $status_id
 * @property string $comment
 *
 * @property Book $book
 * @property Status $status
 * @property User $user
 */
class UsersBooks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'book_id', 'status_id'], 'required'],
            [['user_id', 'book_id', 'status_id'], 'integer'],
            [['comment'], 'string'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'book_id' => 'Book ID',
            'status_id' => 'Status ID',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function addBook($author, $title, $status, $comment = null)
    {
        $book = new Book;
        $book->author = $author;
        $book->title = $title;
        if($book->save()){
            $usersBook = new UsersBooks;
            $usersBook->book_id = $book->id;
            $usersBook->user_id = Yii::$app->user->identity->id;
            $usersBook->status_id = $status;
            $usersBook->comment = $comment;
            return $usersBook->save();
        }
    }
}
