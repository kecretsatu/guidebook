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
        <span class="box-title">SUBINSTANSI BARU</span>
        <span class="box-tools">
            <button type="submit" name="subinstansiform" value="simpan" class="btn btn-warning btn-flat">
                <i class="fa fa-check"></i>
                <span class="hidden-x">Simpan</span>
            </button>
            <a href="<?= Url::to(['/bukutamu/subinstansi']); ?>" class="btn btn-danger btn-flat" type="button">
                <i class="fa fa-close"></i>
                <span class="hidden-x">Batal</span>
            </a>
        </span>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-5">
                <?= $form->field($model, 'ID')->hiddenInput(['value' => $model->ID])->label("") ?>

                <?= $form->field($model, 'ID_INSTANSI')->dropDownList(
                        ArrayHelper::map(Instansi::find()->all(), 'ID', 'NAMA_INSTANSI'),
                            ['prompt' => '-- PILIH INSTANSI --', 'id' => 'id_propinsi']);
                ?>

                <?= $form->field($model, 'NAMA_SUB_INSTANSI')->textInput(['value' => $model->NAMA_SUB_INSTANSI]) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
