<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\Instansi;

/**
 * This is the model class for table "subinstansi".
 *
 * @property integer $ID_INSTANSI
 * @property string $NAMA_SUB_INSTANSI
 * @property integer $ID
 */
class Subinstansi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subinstansi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_INSTANSI', 'NAMA_SUB_INSTANSI'], 'required'],
            [['ID_INSTANSI'], 'integer'],
            [['NAMA_SUB_INSTANSI'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_INSTANSI' => 'Instansi',
            'NAMA_SUB_INSTANSI' => 'Nama Sub Instansi',
            'ID' => 'ID',
        ];
    }

    public function getInstansi()
    {
        return $this->hasOne(Instansi::className(), ['ID' => 'ID_INSTANSI']);
    }

    public function getBukutamu()
    {
        return $this->hasMany(Bukutamu::className(), ['TUJUAN' => 'ID']);
    }
}
