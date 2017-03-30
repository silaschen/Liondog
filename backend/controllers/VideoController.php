<?php

namespace backend\controllers;

use Yii;
use common\models\Video;
use backend\models\VideoForm;
use common\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CatsModel;
/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller
{
    /**
     * @inheritdoc
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


      public function actions()
    {
        return [
            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/blog/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                    "imageCompressEnable"=> false, /* 是否压缩图片,默认是true */
                ]
            ],
             'ueditor'=>[
            'class' => 'common\widgets\ueditor\UeditorAction',
            'config'=>[
                //上传图片配置
                'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                'imagePathFormat' => "/blog/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
            ]
        ],
        
        ];
    }

    /**
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VideoForm();
        $cates = CatsModel::getcates();//分类
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->create()) {
                 yii::$app->session->setFlash("warning",$model->last_error);

             }else{
                return $this->redirect(['posts/view','id'=>$model->id]);

             }
        } else {
            return $this->render('create', [
                'model' => $model,
                'cates'=>$cates
            ]);
        }
    }
    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   
        $model= video::find()->where(['id'=>$id])->one();
        $cates = CatsModel::getcates();//分类
        if ($model->load(Yii::$app->request->post())) {
            
            if (!$model->create()) {
                 yii::$app->session->setFlash("warning",$model->last_error);

             }else{
                return $this->redirect(['posts/view','id'=>$model->id]);

             }
        } else {
            return $this->render('update', [
                'model' => $model,
                'cates'=>$cates
            ]);
        }
           return $this->render('update', [
                'model' => $model,
                'cates'=>$cates
            ]);
    }

    /**
     * Deletes an existing Video model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
