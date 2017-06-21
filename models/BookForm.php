<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\UsersBooks;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $title
 * @property string $author
 *
 * @property UsersBooks[] $usersBooks
 */
class BookForm extends Model
{
    /**
     * @inheritdoc
     */
    public $status;
    public $author;
    public $title;
    public $comment;

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
            [['title', 'author'], 'required'],
            [['title', 'author', 'comment'], 'string', 'max' => 255],
            [['status'], 'integer'],
            [['title', 'author'], 'trim'],
            [['title', 'author'], 'filter', 'filter' => function ($value) {
                $value = stripslashes($value);
                $value = htmlspecialchars($value);
                return $value;
            }],
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
            'status' => '',
            'comment' => 'Comment'
        ];
    }

    public function addBook(){
        $status = UsersBooks::addBook($this->author, $this->title, $this->status, $this->comment);
        return $status;
    }
}
