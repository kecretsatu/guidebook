<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Buku Tamu';
?>

<div class="jumbotron masthead">
    <div class="container">
    <!-- English: Detect Unfinished visit.This NIK has an unfinished visit.  please check out firstly. -->
        <h1>Mendeteksi kunjungan Unfinished<br/><br/></h1>
        <h1>NIK ini memiliki kunjungan yang belum selesai. Silahkan periksa terlebih dahulu.</h1>
    </div>
</div>
<div class="container-fluid">
    <a class="btn btn-warning pull-right" href="<?= Url::to(['/bukutamu/pilih', 'mode' => 'non']); ?>">
    <!-- English: Confirm -->
        Memastikan
    </a>
</div>
