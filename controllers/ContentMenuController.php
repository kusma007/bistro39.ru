<?php

namespace app\controllers;

use Yii;
use app\models\ContentMenu;
use app\models\ContentMenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ContentMenuController implements the CRUD actions for ContentMenu model.
 */
class ContentMenuController extends Controller
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
            'access' =>  [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
//                        'actions' => ['index','view'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all ContentMenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContentMenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContentMenu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ContentMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContentMenu();
        $model->status = 'on';
        $remove_model = ContentMenu::find()->where(['status' => 'on'])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($remove_model) {
                foreach($remove_model as $rem_model) {
                    $rem_model->status = 'off';
                    $rem_model->save();
                }
            }
            return $this->redirect('/content-menu');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ContentMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect('/content-menu');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ContentMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSwichStatus($id)
    {

//        $remove_model = ContentMenu::findOne(['status' => 'on']);
        $remove_model = ContentMenu::find()->where(['status' => 'on'])->all();

        if ($remove_model) {
            foreach($remove_model as $rem_model) {
                $rem_model->status = 'off';
            }
        }


        $model = $this->findModel($id);
        if($model->status == 'on') { $model->status = 'off';} else { $model->status = 'on'; $model->date_update = date('Y-m-d H:i:s'); }
//        var_dump($remove_model);
//        var_dump($model);
//        die;
        if ($model->save()) {
            if ($remove_model) {
                foreach($remove_model as $rem_model) {
                    $rem_model->save();
                }
            }
            return $model->status;
        } else {
            return 'Error';
        }
    }

    /**
     * Finds the ContentMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
