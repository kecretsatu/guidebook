<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'User';
if (!isset($id)) $id = '';
if (!isset($username)) $username = '';
if (!isset($email)) $email = '';

?>
<?php $form = ActiveForm::begin(); ?>
<div class="box">
    <div class="box-header">
        <i class="fa fa-user"></i>
        <span class="box-title">USER BARU</span>
        <span class="box-tools">
            <button type="submit" name="signup" value="simpan" class="btn btn-warning btn-flat">
                <i class="fa fa-check"></i>
                <span class="hidden-x">Simpan</span>
            </button>
            <a href="<?= Url::to(['/bukutamu/datauser']); ?>" class="btn btn-danger btn-flat" type="button">
                <i class="fa fa-close"></i>
                <span class="hidden-x">Batal</span>
            </a>
        </span>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-5">
                <?= $form->field($model, 'id')->hiddenInput(['value' => $id])->label("") ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'value' => $username])->label("Nama Login") ?>

                <?= $form->field($model, 'email')->textInput(['value' => $email]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
