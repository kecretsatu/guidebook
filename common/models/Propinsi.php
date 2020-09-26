<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "propinsi".
 *
 * @property integer $NO_PROP
 * @property string $NAMA_PROP
 * @property string $KET
 */
class Propinsi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propinsi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAMA_PROP'], 'required'],
            [['NAMA_PROP'], 'string', 'max' => 180],
            [['KET'], 'string', 'max' => 900],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NO_PROP' => 'Propinsi',
            'NAMA_PROP' => 'Nama Propinsi',
            'KET' => 'Ket',
        ];
    }
}
