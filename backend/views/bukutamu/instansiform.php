<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Instansi;
use common\models\Propinsi;
use common\models\Kabupaten;

$this->title = 'User';
?>
<?php $form = ActiveForm::begin(); ?>
<div class="box">
    <div class="box-header">
        <i class="fa fa-user"></i>
        <span class="box-title">INSTANSI BARU</span>
        <span class="box-tools">
            <button type="submit" name="signup" value="simpan" class="btn btn-warning btn-flat">
                <i class="fa fa-check"></i>
                <span class="hidden-x">Simpan</span>
            </button>
            <a href="<?= Url::to(['/bukutamu/instansi']); ?>" class="btn btn-danger btn-flat" type="button">
                <i class="fa fa-close"></i>
                <span class="hidden-x">Batal</span>
            </a>
        </span>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-5">
                <?= $form->field($model, 'ID')->hiddenInput(['value' => $model->ID])->label("") ?>
                <?= $form->field($model, 'NAMA_INSTANSI')->textInput(['value' => $model->NAMA_INSTANSI]) ?>

                <?= $form->field($model, 'NO_PROP')->dropDownList(
                        ArrayHelper::map(Propinsi::find()->all(), 'NO_PROP', 'NAMA_PROP'),
                            ['prompt' => '-- PILIH PROPINSI --', 'id' => 'id_propinsi',
                             'onchange' => 'get_kabupaten($(this), "'. Url::to(['/bukutamu/api', 'name' => 'kabupaten', 'id' => '']) . '")']);
                ?>

                <?php
                    $kabupaten = [];
                    if (!empty($model->NO_PROP)) {
                        $kabupaten = ArrayHelper::map(Kabupaten::find()->where(
                                        ['NO_PROP' => $model->NO_PROP])->all(), 'NO_KAB', 'NAMA_KAB');
                    }
                ?>

                <?= $form->field($model, 'NO_KAB')->dropDownList($kabupaten,
                            ['prompt' => '-- PILIH KABUPATEN --', 'id' => 'id_kabupaten'])
                ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$this->registerJs('function get_kabupaten(self, url) {
            $("#id_kabupaten").html("<option value=0>Loading...</option>");
            $.get(url+self.val(), function(data) { $("#id_kabupaten").html(data); });
        }', View::POS_END);

?>
