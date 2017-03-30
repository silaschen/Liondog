<?php 
namespace frontend\controllers;
use frontend\controllers\BaseController;
use common\models\Video;
use backend\models\TagVideo;
/**
* 
*/
class VideoController extends BaseController
{	

	public function actionIndex(){
		//main
		$query = Video::find()->joinWith('cate')->joinWith('user')->orderBy(['addtime'=>SORT_DESC]);

        $f1= $query->limit('1')->where(["in","cats.cat_name",["宅男福利"]])->asArray()->one();

        $f2 = $query->limit("1")->where(["in","cats.cat_name",["php","博客"]])->asArray()->one();
		$f3 = $query->limit("1")->where(["in","cats.cat_name",["体育"]])->asArray()->one();
		$f4 = $query->limit("1")->where(["in","cats.cat_name",["资讯"]])->asArray()->one();
		$f5 = $query->limit("1")->where(["in","cats.cat_name",["html"]])->asArray()->one();


		$list1 = $query->limit("3")->where(["in","cats.cat_name",['体育','宅男福利']])->asArray()->all();
		$list2 = $query->limit("3")->where(["in","cats.cat_name",['php','资讯']])->asArray()->all();

		$list3 = $query->limit("2")->where(["in","cats.cat_name",['宅男福利']])->asArray()->all();
		$list4 = $query->limit("2")->where(["in","cats.cat_name",['php']])->asArray()->all();
		$list5 = $query->limit("2")->where(["in","cats.cat_name",['html']])->asArray()->all();
		$list6 = $query->limit("4")->where(["in","cats.cat_name",['html','php','宅男福利','html']])->asArray()->all();
		$new = $query->limit("3")->asArray()->all();
	
		//tag
		$tag = TagVideo::find()->limit("20")->orderBy('video_num DESC')->asArray()->all();


		return $this->render('index',['f1'=>$f1,"f2"=>$f2,"f3"=>$f3,'f4'=>$f4,"f5"=>$f5,'list1'=>$list1,'list2'=>$list2,'list3'=>$list3,'list4'=>$list4,'list5'=>$list5,'list6'=>$list6,'new'=>$new,'tag'=>$tag]);
	}
	
	




}


 ?>