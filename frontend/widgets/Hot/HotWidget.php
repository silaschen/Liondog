<?php 
namespace frontend\widgets\Hot;

use yii;
use yii\base\Widget;
use yii\data\Pagination;
use common\models\TagModel;
use common\models\PostsModel;
use yii\helpers\Url;
/**
* 
*/
class HotWidget extends Widget
{

	public function run()
	{


		$info = PostsModel::find()->joinWith('extend')->where(['between','created_at',strtotime(date("Y-m-d")),strtotime(date("Y-m-d"))+60*60*24])->one();

		 return $this->render('index',['info'=>$info]);


	}


}



 ?>