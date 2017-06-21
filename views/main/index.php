<?php
    use yii\bootstrap\Carousel;
    /* @var $this yii\web\View */

    $this->title = Yii::$app->name . '- Home';
?>
<?php
    echo Carousel::widget([
        'items' => [
                // the item contains only the image
            [
                'content' => '<img src="' . Yii::$app->homeUrl . 'img/cosmos1.jpg"/>',
                'caption' => '<h1>Wecome</h1><h2>Read books</h2>',
            ],                // equivalent to the above
            [
                'content' => '<img src="' . Yii::$app->homeUrl . 'img/cosmos2.jpg"/>',
                'caption' => '<h1>Catalogue</h1><h2>Create list of books you\'ve read or want to read</h2>',
            ],                // the item contains both the image and the caption
            [
                'content' => '<img src="' . Yii::$app->homeUrl . 'img/cosmos3.jpg"/>',
                'caption' => '<h1>Find people</h1><h2>Check people with similar interests</h2>',
            ],
        ],
        'options' => ['data-interval' => '5000' /*можно указать класс*/],
        'controls' => [
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
        ]
    ]);
?>
