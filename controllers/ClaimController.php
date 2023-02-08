<?php

namespace app\controllers;

use app\models\Claim;
use app\models\ClaimSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * ClaimController implements the CRUD actions for Claim model.
 */
class ClaimController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Claim models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClaimSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Claim model.
     * @param int $id_claim Id Claim
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_claim)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_claim),
        ]);
    }

    /**
     * Creates a new Claim model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Claim();
        if (Yii::$app->user->isGuest){$this->redirect(['site/login']);}
        else{$model->id_user = Yii::$app->user->identity->id_user;}
        
       
        if ($this->request->isPost) {
            $model->load($this->request->post());

            $model->photo_before=UploadedFile::getInstance($model,'photo_before');
            $file_name='/Images/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->photo_before->extension;
            $model->photo_before->saveAs(\Yii::$app->basePath . $file_name);
            $model->photo_before=$file_name;

            if ($model->save(false)) {
                return $this->redirect(['view', 'id_claim' => $model->id_claim]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Claim model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_claim Id Claim
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_claim)
    {
        $model = $this->findModel($id_claim);

        if ($this->request->isPost) {
            $model->load($this->request->post());

            $model->photo_before= UploadedFile::getInstance($model,'photo_before');
            $file_name='/Images/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->photo_before->extension;
            $model->photo_before->saveAs(\Yii::$app->basePath . $file_name);
            $model->photo_before=$file_name;

            $model->photo_after= UploadedFile::getInstance($model,'photo_after');
            $file_name='/Images/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->photo_after->extension;
            $model->photo_after->saveAs(\Yii::$app->basePath . $file_name);
            $model->photo_after=$file_name;

            if ($model->save(false)) {
                return $this->redirect(['view', 'id_claim' => $model->id_claim]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    

    /**
     * Deletes an existing Claim model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_claim Id Claim
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_claim)
    {
        $this->findModel($id_claim)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Claim model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_claim Id Claim
     * @return Claim the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_claim)
    {
        if (($model = Claim::findOne(['id_claim' => $id_claim])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
