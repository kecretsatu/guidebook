<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;
use common\models\Instansi;
use common\models\Subinstansi;

use frontend\assets\FAAsset;
FAAsset::register($this);

$this->title='Entry';
?>

<?php
    $disabled = $_POST['pilih'] == 'keluar' ? true : false;
    if (isset($photo)) $photo = str_replace(' ', '+', $photo);
    else $photo = "";
    $form = ActiveForm::begin();
?>
<?= $form->field($model, 'CHIP_ID',   ['template'=>'{input}'])->hiddenInput(['value' => $chip_id]); ?>
<?= $form->field($model, 'NIK',       ['template'=>'{input}'])->hiddenInput(['value' => $nik]); ?>
<?= $form->field($model, 'NAMA_LGKP', ['template'=>'{input}'])->hiddenInput(['value' => $nama_lgkp]); ?>
<?= $form->field($model, 'TMPT_LHR',  ['template'=>'{input}'])->hiddenInput(['value' => $tmpt_lhr]); ?>
<?= $form->field($model, 'TGL_LHR',   ['template'=>'{input}'])->hiddenInput(['value' => $tgl_lhr]); ?>
<?= $form->field($model, 'JENIS_KLMIN', ['template'=>'{input}'])->hiddenInput(['value' => $jenis_klmin]); ?>
<?= $form->field($model, 'ALAMAT',    ['template'=>'{input}'])->hiddenInput(['value' => $alamat]); ?>
<?= $form->field($model, 'RT',        ['template'=>'{input}'])->hiddenInput(['value' => $rt]); ?>
<?= $form->field($model, 'RW',        ['template'=>'{input}'])->hiddenInput(['value' => $rw]); ?>
<?= $form->field($model, 'KELURAHAN', ['template'=>'{input}'])->hiddenInput(['value' => $kelurahan]); ?>
<?= $form->field($model, 'KECAMATAN', ['template'=>'{input}'])->hiddenInput(['value' => $kecamatan]); ?>
<?= $form->field($model, 'KABUPATEN', ['template'=>'{input}'])->hiddenInput(['value' => $kabupaten]); ?>
<?= $form->field($model, 'PROPINSI',  ['template'=>'{input}'])->hiddenInput(['value' => $propinsi]); ?>
<?= $form->field($model, 'AGAMA',     ['template'=>'{input}'])->hiddenInput(['value' => $agama]); ?>
<?= $form->field($model, 'STATUS_KAWIN', ['template'=>'{input}'])->hiddenInput(['value' => $status_kawin]); ?>
<?= $form->field($model, 'PEKERJAAN', ['template'=>'{input}'])->hiddenInput(['value' => $pekerjaan]); ?>
<?= Html::hiddenInput("photo", $photo, ['id'=>'photo']); ?>

<div class="col-md-10 col-md-offset-1">
    <div class="col-md-2">
        <div class="team-member">
            <img src="data:image/jpeg;base64, <?= $photo ?>" class="img-responsive" alt="" width="150" height="180">
        </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-12 text-center">
            <h2>DATA TAMU</h2>
        </div>
        <div class="table-reponsive">
            <table style="font-size:22px;">
                <tr>
                    <td>NIK</td>
                    <td>&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                    <td><?=$nik?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>

                <tr>
                    <td>Nama</td>
                    <td>&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                    <td><?=$nama_lgkp?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>

                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <?= $tmpt_lhr.', '.$tgl_lhr; ?> </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>

                <tr>
                    <td>Jenis Kelamin</td>
                    <td>&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                    <td><?= $jenis_klmin; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>

                <tr>
                    <td valign="top">Alamat</td>
                    <td>&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <?php
                           $fullAlamat=$alamat.' RT/RW '.$rt.'/'.$rw.', '.$kelurahan.', '.$kecamatan.', '.$kabupaten.', '.$propinsi;
                        ?>
                        <?= $fullAlamat; ?>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>

                <tr>
                    <td>Telephone</td>
                    <td>&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <br>
                        <?= $form->field($model, 'NO_TELP',
                                            ['template' => '{input}'])->textInput(
                                                ['disabled' => $disabled,
                                                 'placeHolder' => 'NOMOR TELEPHONE',
                                                 'class' => 'form-control input-lg']); ?>
                    </td>
                </tr>

                <tr>
                    <td>Instansi</td>
                    <td>&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <br>
                        <?= $form->field($model, 'INSTANSI',
                                            ['template' => '{input}{error}'])->dropDownList(
                                                ['D' => 'DINAS', 'P' => 'PRIBADI'],
                                                ['disabled' => $disabled,
                                                 'prompt'=>'-- INSTANSI --','class' => 'form-control input-lg']); ?>
                    </td>
                </tr>

                <tr>
                    <td>Nama Instansi</td>
                    <td>&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <br>
                        <?= $form->field($model, 'NAMA_INSTANSI',
                                            ['template' => '{input}'])->textInput(
                                                ['disabled' => $disabled,
                                                 'style'=>'text-transform:uppercase', 'class' => 'form-control input-lg']); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="col-md-12 text-center">
            <h2>TUJUAN</h2>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'ID_INSTANSI',
                                ['template'=>'{input}'])->dropDownList(
                                    ArrayHelper::map(Instansi::find()->all(), 'ID', 'NAMA_INSTANSI'),
                                        ['prompt' => '-- PILIH --', 'disabled' => $disabled, 'id' => 'id_instansi',
                                         'onchange' => 'get_subinstansi($(this), "'.Url::to(['bukutamu/api', 'name' => 'subinstansi', 'id' => '']).'")',
                                         'class' => 'form-control input-lg',]);
            ?>
            <?php
                $tujuan = [];
                if (!empty($model->id_instansi))
                    $tujuan = ArrayHelper::map(Subinstansi::find()->where(
                                                ['ID_INSTANSI' => $model->id_instansi])->all(),
                                                'ID', 'NAMA_SUB_INSTANSI');
            ?>
            <?= $form->field($model, 'TUJUAN',
                                ['template'=>'{input}'])->dropDownList($tujuan,
                                    ['id'=> 'id_subinstansi', 'prompt' => '-- PILIH --', 'disabled' => $disabled,'class' => 'form-control input-lg',]); ?>
            <p class="help-block text-danger"></p>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'KEPERLUAN',
                                ['template'=>'{input}'])->textArea(
                                    ['disabled' => $disabled, 'placeHolder'=>'Keperluan','class' => 'form-control input-lg']); ?>
            <p class="help-block text-danger"></p>
        </div>
        <hr>
        <div class="text-center">
            <?php
                if (!$disabled) {
            ?>
                    <button type="submit" name="pilih" value="simpan" class="btn btn-lg btn-primary">
                      <i class="fa fa-check fa-lg"></i> Simpan
                    </button>
                    <a href="<?= Url::to(['/bukutamu/index']); ?>" class="btn btn-lg btn-danger">
                     <i class="fa fa-close fa-lg"></i> Batal
                    </a>
            <?php
                } else {
            ?>
                    <h1 class="text-center">TERIMA KASIH</h1>
                    <h1 class="text-center">ATAS KUNJUNGAN ANDA</h1>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<!-- page script -->
<?php
$this->registerJs('function get_subinstansi(self, url) {
        $("#id_subinstansi").html("<option value=0>Loading...</option>");
        $.get(url+self.val(), function(data) { $("#id_subinstansi").html(data); });
    }', View::POS_END);

if ($disabled) {
    $this->registerJs("$(function () {
            setTimeout(function () {
                window.location.href='" . Url::to(['/bukutamu/index']) . "';
            }, 3000);
        })");
}
?>
