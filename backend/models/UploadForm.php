<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $dstfile = Yii::getAlias("@frontend/web/images/logokemendagri.png");
            $this->imageFile->saveAs($dstfile);
            return true;
        } else {
            return false;
        }
    }
}