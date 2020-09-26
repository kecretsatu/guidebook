<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\SignupForm;
use common\models\LoginForm;
use common\models\User;
use common\models\Bukutamu;
use common\models\Instansi;
use common\models\Subinstansi;
use common\models\Kabupaten;
use common\models\Preference;
use backend\models\UploadForm;
use yii\web\UploadedFile;

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
                        'actions' => ['logout', 'index', 'instansi', 'instansiform', 'subinstansi', 'subinstansiform', 'datauser', 'signup', 'laporan', 'api','preference','uploadform'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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

    public function actionLogin()
    {
        $this->layout = '@app/views/layouts/login.php';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionIndex()
    {
        $this->layout = '@app/views/layouts/index.php';
        return $this->render('index');
    }

    public function actionInstansiform()
    {
        $this->layout = '@app/views/layouts/index.php';
        $model = new Instansi();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save())
                return $this->redirect(['bukutamu/instansi']);
        }
        return $this->render('instansiform', ['model' => $model]);
    }

    public function actionInstansi()
    {
        $this->layout = '@app/views/layouts/index.php';

        if (isset($_POST['id']))
            $id = $_POST['id'];

        if (isset($id))
            $model = Instansi::find()->where(['ID' => $id])->one();

        if (isset($_POST['instansi'])) {
            switch ($_POST['instansi']) {
            case 'simpan':
                $model = new Instansi();
                if ($model->load(Yii::$app->request->post())) {
                    // FIX ME $model->id is null, can't use it directly
                    $instansimodel = instansi::findOne(['id' => $_POST['Instansi']['ID']]);
                    if (!isset($instansimodel)){
                        return $this->redirect(['bukutamu/error']);
                    }
                    $instansimodel->NAMA_INSTANSI = $model->NAMA_INSTANSI;
                    $instansimodel->NO_PROP = $model->NO_PROP;
                    $instansimodel->NO_KAB = $model->NO_KAB;
                    if($instansimodel->save()){
                        return $this->redirect(['bukutamu/instansi']);
                    }
                }
                return $this->redirect(['bukutamu/error']);
            }
        }

        if (isset($_POST['method'])) {
            switch ($_POST['method']) {
            case 'modify':
                if (isset($model))
                    return $this->render('instansiform', ['model' => $model]);
                break;
            case 'delete':
                if (isset($model)) {
                    $model->delete();
                    return $this->redirect(['bukutamu/instansi']);
                }
                break;
            }
        }

        if (!isset($model))
            $model = Instansi::find()->joinwith(['propinsi', 'kabupaten'])->all();

        return $this->render('instansi', ['model' => $model]);
    }

    public function actionSubinstansiform()
    {
        $this->layout = '@app/views/layouts/index.php';
        $model = new Subinstansi();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save())
                return $this->redirect(['bukutamu/subinstansi']);
        }
        return $this->render('subinstansiform', ['model' => $model]);
    }

    public function actionSubinstansi()
    {
        $this->layout = '@app/views/layouts/index.php';

        if (isset($_POST['id']))
            $id = $_POST['id'];

        if (isset($id))
            $model = subinstansi::find()->where(['ID' => $id])->one();

        if (isset($_POST['subinstansiform'])) {
            switch ($_POST['subinstansiform']) {
            case 'simpan':
                $model = new subinstansi();
                if ($model->load(Yii::$app->request->post())) {
                    // FIX ME $model->id is null, can't use it directly
                    $subinstansimodel = subinstansi::findOne(['id' => $_POST['Subinstansi']['ID']]);
                    if (!isset($subinstansimodel)){
                        return $this->redirect(['bukutamu/error']);
                    }
                    $subinstansimodel->ID_INSTANSI = $model->ID_INSTANSI;
                    $subinstansimodel->NAMA_SUB_INSTANSI = $model->NAMA_SUB_INSTANSI;
                    if($subinstansimodel->save()){
                        return $this->redirect(['bukutamu/subinstansi']);
                    }
                }
                return $this->redirect(['bukutamu/error']);
            }
        }

        if (isset($_POST['method'])) {
            switch ($_POST['method']) {
            case 'modify':
                if (isset($model))
                    return $this->render('subinstansiform', ['model' => $model]);
                break;
            case 'delete':
                if (isset($model)) {
                    $model->delete();
                    return $this->redirect(['bukutamu/subinstansi']);
                }
                break;
            }
        }

        if (!isset($model))
            $model = Subinstansi::find()->joinwith(['instansi'])->all();

        return $this->render('subinstansi', ['model' => $model]);
    }

    public function actionSignup()
    {
        $this->layout = '@app/views/layouts/index.php';

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save())
                return $this->redirect(['bukutamu/datauser']);
        }
        return $this->render('signup', ['model' => $model]);
    }

    public function actionDatauser()
    {
        $this->layout = '@app/views/layouts/index.php';

        if (isset($_POST['id']))
            $id = $_POST['id'];

        if (isset($id))
            $model = User::findOne($id);

        if (isset($_POST['signup'])) {
            switch ($_POST['signup']) {
            case 'simpan':
                $model = new SignupForm();
                if ($model->load(Yii::$app->request->post())) {
                    $usermodel = new User();
                    // FIX ME $model->id is null, can't use it directly
                    $usermodel = User::findOne(['id' => $_POST['SignupForm']['id']]);
                    if (!isset($usermodel)){
                        return $this->redirect(['bukutamu/error']);
                    }
                    $usermodel->username = $model->username;
                    $usermodel->email = $model->email;
                    $usermodel->password = $model->password;
                    $usermodel->generateAuthKey();

                    if($usermodel->save()){
                        return $this->redirect(['bukutamu/datauser']);
                    }
                }
                return $this->redirect(['bukutamu/error']);
            }
        }

        if (!isset($model)) {
            $model = User::find()->all();
            return $this->render('datauser', ['model' => $model]);
        } else if (isset($_POST['method'])) {
            switch ($_POST['method']) {
            case 'modify':
                $signupModel = new SignupForm();
                return $this->render('signup', ['model' => $signupModel,
                                                'id' => $model->id,
                                                'username' => $model->username,
                                                'email' => $model->email]);
            case 'delete':
                $model->delete();
                return $this->redirect(['bukutamu/datauser']);
            }
        }

        // Logical error
        return $this->redirect(['bukutamu/error']);
    }

    public function actionUploadform()
    {
        $this->layout = '@app/views/layouts/index.php';
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // upload success
                return $this->redirect(['bukutamu/preference']);
            }
        }

        return $this->render('uploadform', ['model' => $model]);
    }

    public function actionPreference()
    {
        $this->layout = '@app/views/layouts/index.php';
        $model = new Preference();
        $model->loadfromfile();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()){
                return $this->redirect(['bukutamu/preference']);
            }
        }
        return $this->render('preference', ['model' => $model]);
    }

    public function actionLaporan()
    {
        $this->layout = '@app/views/layouts/index.php';
        $uid = isset($_POST['uid']) ? $_POST['uid'] : "";
        $nik = isset($_POST['nik']) ? $_POST['nik'] : "";
        $nama_lgkp = isset($_POST['nama_lgkp']) ? $_POST['nama_lgkp'] : "";
        $instansi = isset($_POST['instansi']) ? $_POST['instansi'] : "";
        $sub_instansi = isset($_POST['sub_instansi']) ? $_POST['sub_instansi'] : "";
        $date_tap = isset($_POST['date_tap']) ? $_POST['date_tap'] : "";
        $date_out = isset($_POST['date_out']) ? $_POST['date_out'] : "";

        $query = Bukutamu::find();
        if ($uid != "")
            $query = $query->where(['CHIP_ID' => $uid]);
        if ($nik != "")
            $query = $query->where(['NIK' => $nik]);
        if ($nama_lgkp != "")
            $query = $query->where(['NAMA_LGKP' => $nama_lgkp]);
        if ($instansi != "" && $instansi != "0")
            $query = $query->where(['ID_INSTANSI' => $instansi]);
        if ($sub_instansi != "" && $sub_instansi != "0")
            $query = $query->where(['TUJUAN' => $sub_instansi]);
        if ($date_tap != "")
            $date_tap = $query->where(['DATE(DATE_TAP)' => $date_tap]);
        if ($date_out != "")
            $date_out = $query->where(['DATE(DATE_OUT)' => $date_out]);

        $model = $query->joinWith(['instansi', 'subinstansi'])->all();

        return $this->render('laporan', ['model' => $model,
                                         'uid' => $uid,
                                         'nik' => $nik,
                                         'nama_lgkp' => $nama_lgkp,
                                         'instansi' => $instansi,
                                         'sub_instansi' => $sub_instansi,
                                         'date_out' => $date_out,
                                         'date_tap' => $date_tap]);
    }

    public function actionApi($name, $id)
    {
        if (isset($name) && isset($id)) {
            switch ($name) {
            case 'kabupaten':
                $kabupaten = Kabupaten::find()->where(['NO_PROP' => $id])->all();
                if (count($kabupaten) > 0) {
                    for ($i = 0; $i < count($kabupaten); $i++) {
                        echo '<option value="' . $kabupaten[$i]->NO_KAB . '">' . $kabupaten[$i]->NAMA_KAB . '</option>';
                    }
                    return;
                }
                break;
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
