<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Upload Logo';
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <button type="submit" name="uploadform" value="simpan" class="btn btn-warning btn-flat">
        <i class="fa fa-check"></i>
        <span class="hidden-x">Upload</span>
    </button>
<?php ActiveForm::end() ?>
