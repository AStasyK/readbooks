<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\SignupForm */
/* @var $form ActiveForm */
?>
<div class="container">
    <div class="main-signup">
<?php if(Yii::$app->session->hasFlash('success')) {
        echo '<div class="alert alert-success">' . Yii::$app->session->getFlash('success') . '</div>';
    }
    if(Yii::$app->session->hasFlash('error')) {
        echo '<div class="alert alert-danger">' . Yii::$app->session->getFlash('error') . '</div>';
    }

        $form = ActiveForm::begin();
        echo $form->field($model, 'login'),
             $form->field($model, 'name'),
             $form->field($model, 'email')->input('email'),
             $form->field($model, 'password')->passwordInput(),
             $form->field($model, 'password_repeat')->passwordInput();

        echo '<div class="form-group">',
            Html::submitButton('Sign up', ['class' => 'btn btn-primary']),
        '</div>';
        ActiveForm::end();
?>
    </div>
</div>
