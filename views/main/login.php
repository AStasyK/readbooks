<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    /* @var $this yii\web\View */
    /* @var $model app\models\LoginForm */
    /* @var $form ActiveForm */
    $this->title = Yii::$app->name . '- Log in';
?>
<div class="container">
    <div class="main-login">
<?php if(Yii::$app->session->hasFlash('success')) {
        echo '<div class="alert alert-success">' . Yii::$app->session->getFlash('success') . '</div>';
    }
    if(Yii::$app->session->hasFlash('error')) {
        echo '<div class="alert alert-danger">' . Yii::$app->session->getFlash('error') . '</div>';
    }

    $form = ActiveForm::begin();

    echo $form->field($model, 'login'),
         $form->field($model, 'password')->passwordInput(),

        '<div class="form-group">',
            Html::submitButton('Log in', ['class' => 'btn btn-primary']),
            '<p> Do not have an account? ',
                '<a href="', Yii::$app->homeUrl, 'main/signup"> Sign up </a>',
            '</p>',
        '</div>';
    ActiveForm::end();
?>
    </div>
</div>

