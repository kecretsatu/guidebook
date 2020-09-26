<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\assets\BukutamuIndexAsset;
use frontend\assets\FAAsset;

AppAsset::register($this);
BukutamuIndexAsset::register($this);
FAAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Pragma" content="no-cache">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div class="container">
        <?= $content ?>
    </div>

<?= $this->render('footer.php');
$this->registerJs('function blinker() {
	$(".blink").fadeOut(500);
	$(".blink").fadeIn(500);
}
setInterval(blinker, 1000);');

 ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

