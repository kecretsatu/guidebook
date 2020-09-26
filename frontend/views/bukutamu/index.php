<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Buku Tamu';
?>

<div class="jumbotron masthead">
    <div class="container">
        <img src=images/logokemendagri.png>
			<h3><?php echo Yii::$app->params["deptname"]; ?></h3>
        <h2>Selamat Datang</h2>
        <div class="blink"><h1>SILAHKAN TEMPELKAN KTP-el ANDA</h1></div>
    </div>
<div class="container-fluid">
<br/><br/><br/><br/>
    <a class="btn btn-info btn-lg pull-left" href="<?= Url::to(['/bukutamu/pilih', 'mode' => 'non']); ?>">
        <i class="fa fa-id-card fa-lg"></i> KTP Non Elektronik
    </a>
</div>
	</div>

