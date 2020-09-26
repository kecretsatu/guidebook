<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\FAAsset;
FAAsset::register($this);

/* @var $this yii\web\View */
$this->title = 'Entry NIK';
?>
	   <SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </SCRIPT>
<div class="jumbotron">
    <div class="container-fluid" style="text-align: left">
	<div class="col-md-4"></div>
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(); ?>
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
                <div class="form-group">
                    <label><h3>Masukkan NIK:</h3></label>
                    <input type="text" name="nik" id="nik" onkeypress="return isNumberKey(event)" maxlength="16" class="form-control input-lg"/>
                    <label id="errmsg" class = "not-set"><?= isset($_SERVER['checkMsg'])?$_SERVER['checkMsg']:''; ?></label>
                </div>
                <button type="submit" name="pilih" value="keluar" class="btn btn-primary">
                   <i class="fa fa-check fa-lg"></i> Submit
                </button>
                <a class="btn btn-danger" href="<?= Url::to(['/bukutamu/index']); ?>">
                  <i class="fa fa-close fa-lg"></i>  Batal
                </a>
            <?php ActiveForm::end(); ?>
        </div>
		<div class="col-md-4"></div>
    </div>
</div>