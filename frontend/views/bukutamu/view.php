<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\Bukutamu;
use common\models\Instansi;
use common\models\Subinstansi;

use frontend\assets\FAAsset;
FAAsset::register($this);

$this->title='Entry';
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
  <style>
  label {
    display: inline-block;
    width: 5em;
  }
  </style>
<?php $disabled = $_POST['pilih'] == 'keluar' ? true : false; ?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'CHIP_ID',['template'=>'{input}'])->hiddenInput(['value'=>'-']); ?>
<?= $form->field($model, 'RT',['template'=>'{input}'])->hiddenInput(['value'=>'-']); ?>
<?= $form->field($model, 'RW',['template'=>'{input}'])->hiddenInput(['value'=>'-']); ?>
<?= $form->field($model, 'KELURAHAN',['template'=>'{input}'])->hiddenInput(['value'=>'-']); ?>
<?= $form->field($model, 'KECAMATAN',['template'=>'{input}'])->hiddenInput(['value'=>'-']); ?>
<?= $form->field($model, 'KABUPATEN',['template'=>'{input}'])->hiddenInput(['value'=>'-']); ?>
<?= $form->field($model, 'PROPINSI',['template'=>'{input}'])->hiddenInput(['value'=>'-']); ?>
<?= $form->field($model, 'AGAMA',['template'=>'{input}'])->hiddenInput(['value'=>'-']); ?>
<?= $form->field($model, 'STATUS_KAWIN',['template'=>'{input}'])->hiddenInput(['value'=>'-']); ?>
<?= $form->field($model, 'PEKERJAAN',['template'=>'{input}'])->hiddenInput(['value'=>'-']); ?>

<div class="col-md-10 col-md-offset-1">
    <div class="col-md-7">
        <div class="col-md-12 text-center">
            <h3>DATA TAMU</h3>
        </div>
        <div class="table-reponsive">
            <div class="form-group col-md-6">
                <?= $form->field($model, 'NIK',
                                    ['template' => '{input}'])->textInput(
                                        ['value' => $nik, 'disabled' => $disabled, 'onkeypress'=>'return isNumberKey(event)', 'maxlength'=>'16' ,'class' => 'form-control input-lg', 'title'=>'Masukkan NIK (hanya angka)', 'placeHolder' => 'NIK']); ?>
            </div>
            <div class="form-group col-md-6">
                <?= $form->field($model, 'NAMA_LGKP',
                                    ['template' => '{input}'])->textInput(
                                        ['value' => $nama_lgkp, 'disabled' => $disabled,
                                        'style' => 'text-transform:uppercase', 'class' => 'form-control input-lg', 'title'=>'Masukkan Nama lengkap', 'placeHolder' => 'NAMA LENGKAP']); ?>
            </div>

            <div class=" col-md-6">
                <?= $form->field($model, 'TMPT_LHR',
                                    ['template' => '{input}'])->textInput(
                                        ['value' => $tmpt_lhr, 'disabled' => $disabled,
                                         'style' => 'text-transform:uppercase', 'class' => 'form-control input-lg',
                                         'title'=>'Masukkan tempat lahir', 'placeholder'=>'Tempat Lahir']); ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'TGL_LHR',
                                    ['template'=>'{input}'])->textInput(
                                        ['value' => $tgl_lhr, 'disabled' => $disabled,
                                        'id' => 'tgl_lhr_datemask', 'class' => 'form-control input-lg',
                                        'title'=>'Masukkan tanggal lahir (tahun-bulan-tahun)', 'placeholder' => 'yyyy-mm-dd']);?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'JENIS_KLMIN',
                                    ['template'=>'{input}'])->dropDownList(
                                        ['LAKI-LAKI' => 'LAKI-LAKI', 'PEREMPUAN' => 'PEREMPUAN'],
                                        ['prompt' => '-- Jenis Kelamin --', 'disabled' => $disabled,
                                        'class' => 'form-control input-lg',]); ?>
            </div>

            <div class="col-md-9">
                <?= $form->field($model, 'ALAMAT',
                                    ['template' => '{input}'])->textInput(
                                        ['style' => 'text-transform:uppercase', 'disabled'=>$disabled,
										'title'=>'Masukkan alamat', 'class' => 'form-control input-lg', 'placeholder' => 'Alamat',]); ?>
            </div>

            <div class="col-md-6 form-group">
                <?= $form->field($model, 'NO_TELP',
                                    ['template'=>'{input}'])->textInput(
                                        ['disabled' => $disabled, 'placeHolder' => 'NOMOR TELEPHONE',
										'title'=>'Masukkan Nomor telepon',
                                        'class' => 'form-control input-lg', 'placeholder' => 'Telephone']);?>
            </div>
            <div class="col-md-6 form-group">
                <?= $form->field($model, 'INSTANSI',
                                    ['template' => '{input}{error}'])->dropDownList(
                                        ['D' => 'DINAS', 'P' => 'PRIBADI'],
                                        ['disabled' => $disabled, 'prompt' => '-- Instansi --',
                                        'class' => 'form-control input-lg',]); ?>
            </div>

            <div class="col-md-9">
                <?= $form->field($model, 'NAMA_INSTANSI',
                                    ['template' => '{input}'])->textInput(
                                        ['disabled' => $disabled, 'style'=>'text-transform:uppercase',
                                        'class' => 'form-control input-lg', 'placeholder' => 'Nama Instansi']); ?>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="col-md-12 text-center">
            <h3>TUJUAN</h3>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'ID_INSTANSI',
                                ['template' => '{input}'])->dropDownList(
                                    ArrayHelper::map(Instansi::find()->all(), 'ID', 'NAMA_INSTANSI'),
                                    ['prompt' => '-- PILIH --', 'disabled' => $disabled, 'id' => 'id_instansi',
                                     'onchange' => 'get_subinstansi($(this), "'.Url::to(['bukutamu/api', 'name' => 'subinstansi', 'id' => '']).'")',
                                     'class' => 'form-control input-lg',]);
            ?>
            <?php
                $tujuan = [];
                if (!empty($model->ID_INSTANSI)) {
                    $tujuan = ArrayHelper::map(Subinstansi::find()->where(
                                ['ID_INSTANSI' => $model->ID_INSTANSI])->all(), 'ID', 'NAMA_SUB_INSTANSI');
                }
            ?>
            <?= $form->field($model, 'TUJUAN',
                                ['template' => '{input}'])->dropDownList(
                                    $tujuan == NULL ? [] : $tujuan,
                                    ['id' => 'id_subinstansi', 'prompt'=>'-- PILIH --', 'disabled' => $disabled,
                                    'class' => 'form-control input-lg',]); ?>
           <p class="help-block text-danger"></p>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'KEPERLUAN',
                                ['template'=>'{input}'])->textArea(
                                    ['disabled' => $disabled, 'placeHolder'=>'Keperluan', 'title'=>'Masukkan keperluannya',
                                    'class' => 'form-control input-lg',]); ?>
            <p class="help-block text-danger"></p>
        </div>
        <div class="text-center">
            <?php
                if ($_POST['pilih'] == 'keluar') {
            ?>
                    <h1>TERIMA KASIH ATAS KUNJUNGAN ANDA</h1>
                    <a href="<?= Url::to(['/bukutamu/index']);?>" class="btn btn-lg btn-primary">LANJUT</a>
            <?php
                } else {
            ?>
                    <button type="submit" name="pilih" value="simpan" class="btn btn-lg btn-primary">
                        <i class="fa fa-check fa-lg"></i> Simpan
                    </button>
                    <a href="<?= Url::to(['/bukutamu/index']); ?>" class="btn btn-lg btn-danger"><i class="fa fa-close fa-lg"></i> Batal</a>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php
$this->registerJs('$(function() {
    $("#tgl_lhr_datemask").inputmask("yyyy-mm-dd");
	$(".input-lg").tooltip();
    })');
	

$this->registerJs('function get_subinstansi(self, url) {
        $("#id_subinstansi").html("<option value=0>Loading...</option>");
        $.get(url+self.val(), function(data) { $("#id_subinstansi").html(data); });
    }', View::POS_END);
?>
