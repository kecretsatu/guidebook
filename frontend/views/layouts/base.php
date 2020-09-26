<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\assets\BukutamuBaseAsset;

AppAsset::register($this);
BukutamuBaseAsset::register($this);
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

<div class="wrap">
    <div class="container-fluid" style="text-align: center">
        <div class="col-md-2">
            <img src="images/logokemendagri.png">
        </div>
        <div class="col-md-10">
            <h1><?php echo Yii::$app->params["deptname"]; ?></h1>
        </div>
    </div>
    <div class="container-fluid" style="background-color: #f0f0f0">
        <?= $content ?>
    </div>
</div>

<?= $this->render('footer.php') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

