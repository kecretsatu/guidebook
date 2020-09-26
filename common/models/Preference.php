<?php
namespace common\models;

use yii\base\Model;
use common\models\User;
use yii;

/**
 * Signup form
 */
class Preference extends Model
{
    public $id;
    public $logopic;
    public $deptname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['logopic', 'filter', 'filter' => 'trim'],
            ['logopic', 'required'],
            ['logopic', 'string', 'min' => 2, 'max' => 255],

            ['deptname', 'filter', 'filter' => 'trim'],
            ['deptname', 'required'],
            ['deptname', 'string', 'max' => 255],
        ];
    }

     /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'logopic' => 'Logo Picture',
            'deptname' => 'Nama Instansi',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        // save into file
        $departNameFile = Yii::getAlias("@frontend/web/departName.txt");
        $fp = fopen($departNameFile,"w");
        if (isset($fp)){
            $departName = fwrite($fp, $this->deptname);
            fclose($fp);
            return $this;
        }

        return null;
    }

    public function loadfromfile()
    {
        $this->id = '11';
        $this->logopic = Yii::getAlias("@frontend/web/images/logokemendagri.png");
        $this->deptname = 'KEMENTERIAN DALAM NEGERI';
        try{
            $file = Yii::getAlias("@frontend/web/departName.txt");
            $fp = fopen($file,"r");
            if (isset($fp)){
                $this->deptname = file_get_contents($file);
                fclose($fp);
            }
        }
        catch (Exception $e){
            //echo $e->getMessage();
        }
    }

    public function getDisplayName()
    {
        return str_replace(array("\r\n","\n"),"<br/>",$this->deptname);
    }
}
