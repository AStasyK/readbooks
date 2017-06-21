<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
<div class="container">
    <div class="profile">
        <?php if(Yii::$app->session->hasFlash('success')) {
            echo '<div class="alert alert-success">' . Yii::$app->session->getFlash('success') . '</div>';
            }
            if(Yii::$app->session->hasFlash('error')) {
                echo '<div class="alert alert-danger">' . Yii::$app->session->getFlash('error') . '</div>';
            }
        ?>
        <div class="row">
            <div id="have_read" class="col-md-4">
                <p>I have read:</p>
                <?php if(empty($books_read)): ?>
                    <p>User has not added any books yet.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($books_read as $book):?>
                            <li>
                                <a href="<?=Yii::$app->homeUrl?>search/<?=$book->book->author ?>"><?= $book->book->author ?></a>:
                                <a href="<?=Yii::$app->homeUrl?>search/<?=$book->book->title ?>"> <?= $book->book->title ?></a>
                                <div><?= $book->comment ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if($user->login == Yii::$app->user->identity->login) {
                    $form = ActiveForm::begin();
                    echo $form->field($model, 'author'),
                    $form->field($model, 'title'),
                    $form->field($model, 'status')->hiddenInput(['value' => 1]),
                    $form->field($model, 'comment'),
                    '<div class="form-group">',
                    Html::submitButton('Add', ['class' => 'btn btn-primary']),
                    '</div>';
                    ActiveForm::end();
                }
                ?>
            </div>
            <div id="profile" class="col-md-4"><p><?= $user->name ?></p></div>
            <div id="want_read" class="col-md-4">
                <p>I would like to read:</p>
                <?php if(empty($books_want)): ?>
                    <p>User has not added any books yet.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($books_want as $book):?>
                            <li>
                                <a href="<?=Yii::$app->homeUrl?>search/<?=$book->book->author ?>"><?= $book->book->author ?></a> :
                                <a href="<?=Yii::$app->homeUrl?>search/<?=$book->book->title ?>"> <?= $book->book->title ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if($user->login == Yii::$app->user->identity->login) {
                    $form = ActiveForm::begin();
                    echo $form->field($model, 'author'),
                    $form->field($model, 'title'),
                    $form->field($model, 'status')->hiddenInput(['value' => 2]),
                    '<div class="form-group">',
                    Html::submitButton('Add', ['class' => 'btn btn-primary']),
                    '</div>';
                    ActiveForm::end();
                }
                ?>
            </div>
        </div>
    </div>
</div>