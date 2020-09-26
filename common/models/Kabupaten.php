<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kabupaten".
 *
 * @property integer $NO_PROP
 * @property integer $NO_KAB
 * @property string $NAMA_KAB
 * @property string $KET
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kabupaten';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAMA_KAB', 'NO_PROP', 'NO_KAB'], 'required'],
            [['NO_PROP', 'NO_KAB'], 'integer'],
            [['NAMA_KAB'], 'string', 'max' => 180],
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
            'NO_KAB' => 'Kabupaten/Kota',
            'NAMA_KAB' => 'Nama Kabupaten',
            'KET' => 'Ket',
        ];
    }
}
