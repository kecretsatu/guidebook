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

$this->title = 'Pengaturan';
?>
<?php $form = ActiveForm::begin(); ?>
<div class="box">
    <div class="box-header">
        <i class="fa fa-user"></i>
        <span class="box-title">Pengaturan</span>
        <span class="box-tools">
            <button type="submit" name="preferenceform" value="simpan" class="btn btn-warning btn-flat">
                <i class="fa fa-check"></i>
                <span class="hidden-x">Simpan</span>
            </button>
        </span>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-5">
                <!--?= $form->field($model, 'logopic')->textInput(['value' => $model->logopic])   ?-->
                <img src = "../../frontend/web/images/logokemendagri.png" class="img-responsive" alt="" width="146" height="165">
                <a href="<?= Url::to(['/bukutamu/uploadform']); ?>" class="btn btn-primary" type="button">
                    <i class="fa fa-upload"></i>
                    <span class="hidden-x">Upload Logo</span>
                </a>
                <br/><br/>
                <?= $form->field($model, 'deptname')->textArea(['value' => $model->deptname]) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>