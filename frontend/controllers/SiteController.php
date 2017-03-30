<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\PostsModel;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\Pagination;
use frontend\models\TagForm;
use yii\web\SaeAuth;
use yii\web\SaeTClient;
use common\models\Chat;
use common\models\Video;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "blog"; //设置使用的布局文件
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                // 'actions' => [
                //     'logout' => ['post'],
                // ],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
		'maxLength' => 4,
		'minLength' => 4,
		'offset' => 4
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
        $this->layout = "blogindex";
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

        $model = new LoginForm();
        //WEIBOMLOGIN
        $sea = new SaeAuth(Yii::$app->params['weibo']['app_key'] , Yii::$app->params['weibo']['app_secret']);
        $weibo_url = $sea->getAuthorizeURL(Yii::$app->params['weibo']['back_url']);


        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
                'weibo'=>$weibo_url
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {

        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    #video play#
    public function actionPlay()
    {   
          $id = yii::$app->request->get("id",1);

          if ($id) {
               $models = Video::find()->where(['id'=>$id])->asArray()->one();
          }

      

     
      

        
        return $this->render("play",['model'=>$models]);
    }

    public function actionMail(){
        $mailto = yii::$app->request->post("con");

       $mail= Yii::$app->mailer->compose(); 
        $mail->setTo($mailto); //要发送给那个人的邮箱 
        $mail->setSubject("Welcom to Liondog"); //邮件主题 
        // $mail->setTextBody('afafa'); //发布纯文字文本 
        $mail->setHtmlBody("Dear liondog customer,We welcome u view our site.We will make u learn what u want."); //发送的消息内容 
       if ($mail->send()) {
           echo json_encode(array('ret'=>1,'msg'=>"success to send"));
       }
    }

    public function actionChat(){
            $model = new Chat();
            $model->content = $_POST['content'];
            $model->addtime = time();

            if (Yii::$app->user->isGuest) {
                          echo json_encode(['status'=>0,'msg'=>'你需要登录']);
                        }else{ 
            $model->uid = Yii::$app->user->identity->id;

            if(!$model->save()){

                echo json_encode(['status'=>0,'msg'=>'failed to post']);
            }else{
                $data = array('content'=>$model->content,'username'=>Yii::$app->user->identity->username,'addtime'=>date("Y-m-d H:i",time()),'avatar'=>Yii::$app->user->identity->avatar);
                echo json_encode(['status'=>'1','arr'=>$data]);
            }

    }
}
}
