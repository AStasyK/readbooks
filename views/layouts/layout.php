<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
appAsset::register($this);
?>
    <!-- Page hook-->
<?= $this->beginPage() ?>

    <!doctype html>
    <html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Yii::$app->name ?></title>

        <!-- Head hook-->
        <?= $this->head() ?>
    </head>
    <body>
    <!-- Body hook-->
    <?= $this->beginBody() ?>

    <header>
    <!--Navigation bar-->
    <?php
    #до nav widget
    $menu = [
        ['label' => 'Main', 'url' => ['/main/index']],
        ['label' => 'About', 'url' => ['/main/about']],
    ];
    if (Yii::$app->user->isGuest) {
        $menu[] = ['label' => 'Log in', 'url' => ['/main/login']];
    } else {
        $menu[] = ['label' => Yii::$app->user->identity->name, 'url' => ['/profile/'. Yii::$app->user->identity->login]];
        $menu[] = ['label' => 'Выход', 'url' => ['/main/logout'], /*'linkOptions' => ['data-method' => 'post']*/];
    }
    NavBar::begin([
        'brandLabel' => 'MySite',
        'brandUrl'   => Yii::$app->homeUrl,
        'options'    => [
            'class'  => 'navbar navbar-default navbar-custom navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'items' => $menu,
        'options' => ['class' => 'navbar-nav navbar-right'],
    ]);
    NavBar::end();
    ?>
    </header>
    <main>
        <!-- Main Content -->
        <?= $content ?>
    </main>
    <footer class="footer">
        <div class="container">
            <p class="copyright text-muted">Copyright &copy; ANAKUC 2017</p>
        </div>
    </footer>
    <?= $this->endBody() ?>
    </body>
    </html>
<?= $this->endPage() ?>