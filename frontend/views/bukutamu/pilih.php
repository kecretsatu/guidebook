<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title='Pilih Tujuan';
?>

<div class="jumbotron masthead">
    <div class="container">
        <img src="images/logokemendagri.png">
	<h3><?php echo Yii::$app->params["deptname"]; ?></h3>
    </div>
    <div class="container">
        <?php ActiveForm::begin(); ?>
        <?= Html::hiddenInput("chip_id", NULL,['id'=>'chip_id']); ?>
        <?= Html::hiddenInput("nik", NULL,['id'=>'nik']); ?>
        <?= Html::hiddenInput("nama_lgkp", NULL,['id'=>'nama_lgkp']); ?>
        <?= Html::hiddenInput("tmpt_lhr", NULL,['id'=>'tmpt_lhr']); ?>
        <?= Html::hiddenInput("tgl_lhr", NULL,['id'=>'tgl_lhr']); ?>
        <?= Html::hiddenInput("jenis_klmin", NULL,['id'=>'jenis_klmin']); ?>
        <?= Html::hiddenInput("alamat", NULL,['id'=>'alamat']); ?>
        <?= Html::hiddenInput("rt", NULL,['id'=>'rt']); ?>
        <?= Html::hiddenInput("rw", NULL,['id'=>'rw']); ?>
        <?= Html::hiddenInput("kelurahan", NULL,['id'=>'kelurahan']); ?>
        <?= Html::hiddenInput("kecamatan", NULL,['id'=>'kecamatan']); ?>
        <?= Html::hiddenInput("kabupaten", NULL,['id'=>'kabupaten']); ?>
        <?= Html::hiddenInput("propinsi", NULL,['id'=>'propinsi']); ?>
        <?= Html::hiddenInput("agama", NULL,['id'=>'agama']); ?>
        <?= Html::hiddenInput("status_kawin",NULL,['id'=>'status_kawin']); ?>
        <?= Html::hiddenInput("pekerjaan",NULL,['id'=>'pekerjaan']); ?>
        <?= Html::hiddenInput("photo", NULL,['id'=>'photo']); ?>
        <h2>SILAHKAN PILIH</h2>
        <button type="submit" name="pilih" value="masuk" class="btn btn-success btn-xl">
            <i class="fa fa-sign-in fa-lg"></i>
            Tamu Masuk
        </button>
        <button type="submit" name="pilih" value="keluar" class="btn btn-info btn-xl">
            Tamu Keluar
			<i class="fa fa-sign-out fa-lg"></i>
        </button>
        <?php ActiveForm::end(); ?>
    </div>
<div class="container-fluid">
<br/><br/><br/> 
    <?= Html::a('<i class="fa fa-chevron-circle-left fa-lg"></i> Batal', Url::to(['/bukutamu/index']),['class'=>'btn btn-warning btn-lg pull-left']); ?>
</div>
	</div>