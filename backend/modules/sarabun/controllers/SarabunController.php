<?php

namespace backend\modules\sarabun\controllers;

use Yii;
use backend\modules\sarabun\models\sarabun;
use backend\modules\sarabun\models\SarabunSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;


/**
 * SarabunController implements the CRUD actions for sarabun model.
 */
class SarabunController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all sarabun models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SarabunSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single sarabun model.
     * @param int $id เลขทะเบียน
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new sarabun model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new sarabun();
        $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
        if ($model->load(Yii::$app->request->post())) {
            $this->CreateDir($model->ref);

            $model->docurl = $this->uploadSingleFile($model);
            //$model->docs = $this->uploadMultipleFile($model);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing sarabun model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id เลขทะเบียน
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tempDocs     = $model->docurl;
        if ($model->load(Yii::$app->request->post())) {
            $model->docurl = $this->uploadSingleFile($model,$tempDocs);
           // $model->docs = $this->uploadMultipleFile($model,$tempDocs);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing sarabun model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id เลขทะเบียน
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->removeUploadDir($model->ref);
        $model->delete();


        return $this->redirect(['index']);
    }

    /**
     * Finds the sarabun model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id เลขทะเบียน
     * @return sarabun the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = sarabun::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function uploadSingleFile($model, $tempFile = null)
    {
        $file = [];

            $UploadedFile = UploadedFile::getInstance($model, 'docs');
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = md5($UploadedFile->basename . time()) . '.' . $UploadedFile->extension;
                $UploadedFile->saveAs(Sarabun::UPLOAD_FOLDER . '/' . $model->ref . '/' . $newFileName);
                $file[$newFileName] = $oldFileName;
                $json = Json::encode($file);
            } else {
                $json = $tempFile;
            }

        return $json;
    }

    private function CreateDir($folderName)
    {
        if ($folderName != NULL) {
            $basePath = Sarabun::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
    }
    public function actionDownload($id,$file)
    {
        $model = $this->findModel($id);

        $path=Yii::getAlias($model->getUploadPath().'/'.$model->ref.'/'.$file);
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        } else {
            throw new NotFoundHttpException("can't find {$model->ref} file");
        }
    }
    private function removeUploadDir($dir){
        BaseFileHelper::removeDirectory(Sarabun::getUploadPath().$dir);
    }

}
