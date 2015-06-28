<?php

namespace johnitvn\settings\controllers;

use Yii;
use johnitvn\settings\models\Setting;
use johnitvn\settings\models\SettingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\grid\GridView;
use \yii\web\Response;

/**
 * ManagerController implements the CRUD actions for Setting model.
 */
class ManagerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Setting models.
     * @return mixed
     */
    public function actionIndex()
    {    
               $searchModel = new SettingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Setting model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($pk)
    {
        return $this->renderPartial('view', [
            'model' => $this->findModel($pk),
        ]);
    }

    /**
     * Creates a new Setting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Setting();  

        if($request->isPost){
            $model->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->validate()){
                if ($model->save()) {                   
                    return [
                        'message' => 'Create Setting success',
                        'code' => 100,
                    ];
                } else {
                    return [
                        'message' => 'Unknow error',
                        'code' => 200,
                    ];
                }
            }else{
                return [
                    'message' => 'Validator error',
                    'code' => 300,
                    'errors'=> $model->errors, 
                ];
            }
        }else{
            return $this->renderPartial('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Setting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($pk)
    {
        $model = $this->findModel($pk);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           //
        } else {
            return $this->renderPartial('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Setting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($pk)
    {
        $this->findModel($pk)->delete();
        return $this->redirect(['index']);
    }

     /**
     * Deletes an existing Setting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete($pks)
    {
        Setting::findAll(explode(",",$pks));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($pk)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
