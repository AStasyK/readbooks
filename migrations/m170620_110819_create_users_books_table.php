<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users_books`.
 * Has foreign keys to the tables:
 *
 * - `users`
 * - `books`
 * - `status`
 */
class m170620_110819_create_users_books_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users_books', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'comment' => $this->text()->defaultValue(null)
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-users_books-user_id',
            'users_books',
            'user_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-users_books-user_id',
            'users_books',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        // creates index for column `book_id`
        $this->createIndex(
            'idx-users_books-book_id',
            'users_books',
            'book_id'
        );

        // add foreign key for table `books`
        $this->addForeignKey(
            'fk-users_books-book_id',
            'users_books',
            'book_id',
            'books',
            'id',
            'RESTRICT'
        );

        // creates index for column `status_id`
        $this->createIndex(
            'idx-users_books-status_id',
            'users_books',
            'status_id'
        );

        // add foreign key for table `status`
        $this->addForeignKey(
            'fk-users_books-status_id',
            'users_books',
            'status_id',
            'status',
            'id',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `users`
        $this->dropForeignKey(
            'fk-users_books-user_id',
            'users_books'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-users_books-user_id',
            'users_books'
        );

        // drops foreign key for table `books`
        $this->dropForeignKey(
            'fk-users_books-book_id',
            'users_books'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            'idx-users_books-book_id',
            'users_books'
        );

        // drops foreign key for table `status`
        $this->dropForeignKey(
            'fk-users_books-status_id',
            'users_books'
        );

        // drops index for column `status_id`
        $this->dropIndex(
            'idx-users_books-status_id',
            'users_books'
        );

        $this->dropTable('users_books');
    }
}
