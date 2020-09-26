<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\Propinsi;
use common\models\Kabupaten;

/**
 * This is the model class for table "instansi".
 *
 * @property integer $ID
 * @property string $NAMA_INSTANSI
 * @property integer $NO_PROP
 * @property integer $NO_KAB
 */
class Instansi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instansi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAMA_INSTANSI', 'NO_PROP', 'NO_KAB'], 'required'],
            [['NO_PROP', 'NO_KAB'], 'integer'],
            [['NAMA_INSTANSI'], 'string', 'max' => 255],
            [['NAMA_INSTANSI'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NAMA_INSTANSI' => 'Nama Instansi',
            'NO_PROP' => 'Provinsi',
            'NO_KAB' => 'Kabupaten/Kota',
        ];
    }

    public function getBukutamu()
    {
        return $this->hasMany(Bukutamu::className(), ['ID_INSTANSI' => 'ID']);
    }

    public function getPropinsi()
    {
        return $this->hasOne(Propinsi::className(), ['NO_PROP' => 'NO_PROP']);
    }

    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['NO_PROP' => 'NO_PROP', 'NO_KAB' => 'NO_KAB']);
    }

}
