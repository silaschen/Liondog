<?php 
namespace frontend\widgets\Trend;

use yii;
use yii\base\Widget;
use yii\data\Pagination;
use common\models\PostsModel;
use frontend\models\PostForm;
use yii\helpers\Url;
/**
* 
*/
class TrendWidget extends Widget
{
	public $title = '';

	public $limit =5;


	public function run()
	{
		
		$list = PostsModel::find()
		    ->limit($this->limit)
		    ->orderBy(["created_at"=>SORT_DESC])
		    ->asArray()->all();
		$lista = PostsModel::find()->joinWith('extend')->limit($this->limit)
		    ->orderBy(['post_extends.browser'=>SORT_DESC])->asArray()->all();

		 return $this->render('index',['data1'=>$list,'data2'=>$lista]);


	}


}



 ?>