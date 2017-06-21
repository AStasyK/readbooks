<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\BookForm;

class ProfileController extends Controller
{
    public function actionProfile()
    {
        if(Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'You are not authorized in the system');
            Yii::error('User was not found');
            return $this->redirect(Yii::$app->homeUrl . 'main/login');
        } else {
            $model = new BookForm();
            $profile = Yii::$app->request->get('login');
            $user = User::findUserInfo($profile);
            if(!$user) {
                Yii::$app->session->setFlash('error', 'User was not found');
                $user = Yii::$app->user->identity;
            }
            $books_read = $user->getBooks(1);
            $books_want = $user->getBooks(2);

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if($model->addBook()){
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', 'Book was not added');
                    Yii::error('Book not added');
                    return $this->refresh();
                }
            }

            return $this->render('profile',
                ['user' => $user, 'books_read' => $books_read, 'books_want' => $books_want, 'model' => $model]
            );
        }
    }

}
