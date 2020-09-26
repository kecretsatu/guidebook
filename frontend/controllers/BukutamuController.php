<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Bukutamu;
use common\models\Subinstansi;

class BukutamuController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'pilih', 'api'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = '@app/views/layouts/index.php';
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = '@app/views/layouts/index.php';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out a user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest)
            Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionPilih($mode = 'ektp')
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $this->layout = '@app/views/layouts/pilih.php';
            return $this->render('pilih');
        case 'POST':
            $this->layout = '@app/views/layouts/base.php';

            $value = $_POST['pilih'];
            if (empty($value)) {
                //TODO: add error handling
                return $this->redirect(['/bukutamu/error']);
            }

            if ($value == 'simpan') {
                $model = new Bukutamu();
                if ($model->load(Yii::$app->request->post())) {

                    if ($mode != 'ektp') {
                        // avoid to access again without finish last access.
                        $non_nik = $model->NIK;
                        $non_model = new Bukutamu();
                        $non_model = BukuTamu::findOne(['NIK' => $non_nik, 'DATE_OUT' => null]);
                        if (isset($non_model)) {
                            return $this->render('unfinished');
                        }
                    }

                    if (empty($model->DATE_TAP))
                        $model->DATE_TAP = date('Y-m-d H:i:s');

                    if (isset($_POST['photo']))
                        $photo = $_POST['photo'];

                    // save base64 encoded photo if not in db
                    if (isset($photo) && !empty($photo)) {
                        $image = base64_decode($photo);

                        if (isset($image) && !empty($image) && $image != false) {
                            $image_file_path = Yii::getAlias("@webroot/images/".$model->NIK.".jpg");
                            if (!file_exists($image_file_path))
                                $image_fp = fopen($image_file_path, "w");

                            if (isset($image_fp) && $image_fp != false) {
                                $ret = fwrite($image_fp, $image);
                                fclose($image_fp);
                                if ($ret == false)
                                    unlink($image_file_path);
                            }
                        }
                    }

                    if ($model->save($runValidation=false))
                        return $this->redirect(['/bukutamu/index']);
                }

                // TODO: error handling in case db store
                return $this->redirect(['/bukutamu/dberror']);
            }


            $nik = $_POST['nik'];
            if ($mode == 'ektp') {
                $view = "viewektp";
            } else {
                if ($value == 'keluar' && empty($nik))
                    return $this->render('inputnik');
                $view = "view";
            }

            $model = BukuTamu::findOne(['NIK' => $nik, 'DATE_OUT' => null]);

            if (isset($model)) {
                $_POST['pilih'] = 'keluar';
                $model->DATE_OUT = date('Y-m-d H:i:s');
                $model->save();
                $_POST['chip_id'] = $model->CHIP_ID;
                $_POST['nik'] = $model->NIK;
                $_POST['nama_lgkp'] = $model->NAMA_LGKP;
                $_POST['tmpt_lhr'] = $model->TMPT_LHR;
                $_POST['tgl_lhr'] = $model->TGL_LHR;
                $_POST['jenis_klmin'] = $model->JENIS_KLMIN;
                $_POST['alamat'] = $model->ALAMAT;
                $_POST['rt'] = $model->RT;
                $_POST['rw'] = $model->RW;
                $_POST['kelurahan'] = $model->KELURAHAN;
                $_POST['kecamatan'] = $model->KECAMATAN;
                $_POST['kabupaten'] = $model->KABUPATEN;
                $_POST['propinsi'] = $model->PROPINSI;
                $_POST['agama'] = $model->AGAMA;
                $_POST['status_kawin'] = $model->STATUS_KAWIN;
                $_POST['pekerjaan'] = $model->PEKERJAAN;
            } else {
                if ($mode != 'ektp' && $_POST['pilih'] == 'keluar'){
                    // checkMsg in English: No related record for this input NIK
                    $_SERVER['checkMsg'] = ' * Tidak ada catatan terkait untuk masukan ini NIK: '.$nik;
                    return $this->render('inputnik');
                }

                $_POST['pilih'] = 'masuk';
                $model = new Bukutamu();
            }

            return $this->render($view, ['model'=>$model, 'chip_id'   => $_POST['chip_id'],
                                                          'nik'       => $_POST['nik'],
                                                          'nama_lgkp' => $_POST['nama_lgkp'],
                                                          'tmpt_lhr'  => $_POST['tmpt_lhr'],
                                                          'tgl_lhr'   => $_POST['tgl_lhr'],
                                                          'jenis_klmin' => $_POST['jenis_klmin'],
                                                          'alamat'    => $_POST['alamat'],
                                                          'rt'        => $_POST['rt'],
                                                          'rw'        => $_POST['rw'],
                                                          'kelurahan' => $_POST['kelurahan'],
                                                          'kecamatan' => $_POST['kecamatan'],
                                                          'kabupaten' => $_POST['kabupaten'],
                                                          'propinsi'  => $_POST['propinsi'],
                                                          'agama'     => $_POST['agama'],
                                                          'status_kawin' => $_POST['status_kawin'],
                                                          'pekerjaan' => $_POST['pekerjaan'],
                                                          'photo'     => $_POST['photo']]);
        }
        return $this->render('index');
    }

    public function actionApi($name, $id)
    {
        if (isset($name) && isset($id)) {
            switch ($name) {
            case 'subinstansi':
                $subinstansi = Subinstansi::find()->where(['ID_INSTANSI' => $id])->all();
                if (count($subinstansi) > 0) {
                    for ($i = 0; $i < count($subinstansi); $i++) {
                        echo '<option value="' . $subinstansi[$i]->ID . '">' . $subinstansi[$i]->NAMA_SUB_INSTANSI . '</option>';
                    }
                    return;
                }
                break;
            case 'instansi':
                break;
            }
        }

        echo '<option value="0">Tidak Ada</option>';
    }
}
