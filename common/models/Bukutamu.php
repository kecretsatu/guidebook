<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\Instansi;
use common\models\Subinstansi;
use common\models\Foto;

/**
 * This is the model class for table "bukutamu".
 *
 * @property integer $ID
 * @property string $CHIP_ID
 * @property string $NIK
 * @property string $NAMA_LGKP
 * @property string $TMPT_LHR
 * @property string $TGL_LHR
 * @property string $JENIS_KLMIN
 * @property string $ALAMAT
 * @property string $RT
 * @property string $RW
 * @property string $KELURAHAN
 * @property string $KECAMATAN
 * @property string $KABUPATEN
 * @property string $PROPINSI
 * @property string $AGAMA
 * @property string $STATUS_KAWIN
 * @property string $PEKERJAAN
 * @property string $NO_TELP
 * @property string $INSTANSI
 * @property integer $TUJUAN
 * @property string $KEPERLUAN
 * @property string $DATE_TAP
 * @property string $DATE_OUT
 * @property integer $ID_INSTANSI
 * @property string $NAMA_INSTANSI
 */
class Bukutamu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bukutamu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CHIP_ID', 'NIK', 'NAMA_LGKP', 'TMPT_LHR', 'TGL_LHR', 'JENIS_KLMIN', 'ALAMAT', 'RT', 'RW', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', 'PROPINSI', 'AGAMA', 'STATUS_KAWIN', 'PEKERJAAN', 'INSTANSI', 'TUJUAN', 'KEPERLUAN', 'DATE_TAP', 'ID_INSTANSI', 'NAMA_INSTANSI'], 'required'],
            [['TGL_LHR', 'DATE_TAP', 'DATE_OUT'], 'safe'],
            [['TUJUAN', 'ID_INSTANSI'], 'integer'],
            [['CHIP_ID', 'NIK', 'JENIS_KLMIN', 'AGAMA', 'STATUS_KAWIN', 'NO_TELP'], 'string', 'max' => 20],
            [['NAMA_LGKP', 'TMPT_LHR', 'KELURAHAN', 'KECAMATAN', 'KABUPATEN', 'PROPINSI', 'PEKERJAAN'], 'string', 'max' => 100],
            [['ALAMAT', 'KEPERLUAN', 'NAMA_INSTANSI'], 'string', 'max' => 200],
            [['RT', 'RW'], 'string', 'max' => 3],
            [['INSTANSI'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CHIP_ID' => 'UID',
            'NIK' => 'NIK',
            'NAMA_LGKP' => 'Nama Lengkap', // Full name
            'TMPT_LHR' => 'Tempat lahir', // Place of birth
            'TGL_LHR' => 'Tanggal lahir', // Data of birth
            'JENIS_KLMIN' => 'Jenis Klmin', // ?
            'ALAMAT' => 'Alamat',
            'RT' => 'RT',
            'RW' => 'RW',
            'KELURAHAN' => 'Kelurahan',
            'KECAMATAN' => 'Kecamatan',
            'KABUPATEN' => 'Kabupaten',
            'PROPINSI' => 'Propinsi',
            'AGAMA' => 'Agama',
            'STATUS_KAWIN' => 'Status Kawin',
            'PEKERJAAN' => 'Pekerjaan',
            'NO_TELP' => 'No  Telp',
            'INSTANSI' => 'Instansi',
            'TUJUAN' => 'Tujuan',
            'KEPERLUAN' => 'Keperluan',
            'DATE_TAP' => 'Date Tap',
            'DATE_OUT' => 'Date Out',
            'ID_INSTANSI' => 'Id Instansi',
            'NAMA_INSTANSI' => 'Nama Instansi',
        ];
    }

    public function getInstansi()
    {
        return $this->hasOne(Instansi::className(), ['ID' => 'ID_INSTANSI']);
    }

    public function getSubinstansi()
    {
        return $this->hasOne(Subinstansi::className(), ['ID' => 'TUJUAN']);
    }
}
