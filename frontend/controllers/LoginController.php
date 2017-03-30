<?php 
namespace frontend\controllers;
use Yii;
use frontend\controllers\BaseController;
use yii\web\SaeAuth;
use yii\web\SaeTClient;
use common\models\OpenInfo;
use common\models\CatsModel;
use common\models\User;
/**
* 
*/
class LoginController extends BaseController
{
	  public $layout = "blog"; //设置使用的布局文件
	
	public function actionIndex()
	{
		$sea = new SaeAuth(Yii::$app->params['weibo']['app_key'] , Yii::$app->params['weibo']['app_secret']);
		$weibo_url = $sea->getAuthorizeURL(Yii::$app->params['weibo']['back_url']);

		return $this->render('index',['code_url'=>$weibo_url]);
	}


	public function actionCall()
	{
		$code = Yii::$app->request->get('code');
		$sea = new SaeAuth(Yii::$app->params['weibo']['app_key'] ,Yii::$app->params['weibo']['app_secret']);
		if ($code)
		{
		    $keys = array();
		    $keys['code'] = $code;
		    $keys['redirect_uri'] = Yii::$app->params['weibo']['back_url'];
		 
		        $token = $sea->getAccessToken( 'code', $keys ) ;
		    
		}

		if ($token)
		{
		    $session = Yii::$app->session;
		            $session['token'] = [
		                'access_token'=>$token['access_token'],
		                'uid'=>$token['uid'],
		                'lifetime'=> 24*3600 // 这里我设置了一天，你们可以自己设置合适时间
		            ];
		    $this->redirect(['login/info']);
		}




	}

	public function actionInfo()
	{
		$token = Yii::$app->session->get("token");
		$c = new SaeTClient(Yii::$app->params['weibo']['app_key'] , Yii::$app->params['weibo']['app_secret'] , $token['access_token'] );
		$uid_get = $c->get_uid();
		$uid = $uid_get['uid'];

		$open_user = OpenInfo::findOne(['open_id'=>$uid , 'type'=>'1']); // 其中 type = 1 代表微博。

		if($open_user)
		{
		    $user = User::findOne($open_user->user_id); // 当open_info信息存在，则直接取其user_id去用户表查询用户信息
		    Yii::$app->user->login($user, 3600 * 24 * 30);
		    $this->goHome();
		}else{

			$user_message = $c->show_user_by_id($uid);//根据ID获取用户等基本信息
			//插入到用户表
			$user = new User();
			$user->setPassword("123456");
			$user->generateAuthKey();
			$user->username = $user_message['name'];
			$user->avatar = $user_message['profile_image_url'];
			$user->save();
			//信息入库，并自动存入用户表
			$model = new OpenInfo();
			$model->open_id = $user_message['idstr'];
			$model->user_id = $user->id;
			$model->nickname = $user_message['name'];
			$model->create_time = time();
			$model->save();

			$login = User::findOne($user->id);

			Yii::$app->user->login($user, 3600 * 24 * 30);




			return $this->render('info',['info'=>$user_message]);

		}




	}


}


 ?>