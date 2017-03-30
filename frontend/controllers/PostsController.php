<?php 
namespace frontend\controllers;
use Yii;
use frontend\controllers\BaseController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use frontend\models\PostForm;
use common\models\PostsModel;
use common\models\CatsModel;
use common\widgets\tag;
use common\models\User;
use common\models\PostExtends;
use common\models\GalleryModel;

/**
* 
*/
class PostsController extends BaseController
{
    public $layout = "blog";

        public function behaviors()
        {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
	//the index of the posts
	public function actionIndex()
	{
        
        

		return $this->render("index");


	}	
    public function actionGallery()
    {
        
        return $this->render('gallery');
    }

	//create the posts
	public function actionCreate()
	{
        
		$model = new PostForm();
		$cates = CatsModel::getcates();
        if ($model->load(yii::$app->request->post())) {

             if (!$model->create()) {
                 yii::$app->session->setFlash("warning",$model->last_error);

             }else{
                return $this->redirect(['posts/view','id'=>$model->id]);

             }
            
        }
       

		return $this->render('create',['model'=>$model,'cates'=>$cates]);


	}

    //update




    #gallery add#
    public function actionAddimg()
    {
        $model = new GalleryModel();
        if ($model->load(yii::$app->request->post())) {
                
                $model->user_name= yii::$app->user->identity->username;
                $model->addtime = time();

                if ($model->save()) {
                    $this->redirect(['posts/gallery','user_name'=>yii::$app->user->identity->username]);
                }else{
                    var_dump($model->errors);
                }


        }

        return $this->render("addimg",['model'=>$model]);


    }

    #view#
    public function actionView($id)
    {
        
        $post = new PostForm;
        $data = $post->findPost($id);
        $extends = new PostExtends();
        $extends->updata(['post_id'=>$id],"browser",1 );

        return $this->render("view",['model'=>$data]);

    }

    //findmodel hello
       protected function findModel($id)
        {
            if (($model = PostsModel::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }


        public function actionProfile(){

            $model = User::findOne(yii::$app->user->identity->id);

            
            if ($model->load(yii::$app->request->post())){
             $post = yii::$app->request->post();
                $model->avatar = $post['User']['avatar'];
                $model->save();
                $this->redirect(['site/index']);
                
            }else{


                return $this->render('profile',['model'=>$model]);
            }



        }

  




}

 ?>