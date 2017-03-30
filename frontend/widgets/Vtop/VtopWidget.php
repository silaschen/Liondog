<?php 
namespace frontend\widgets\Vtop;
use yii;
use yii\base\Widget;
use yii\data\Pagination;
use common\models\PostsModel;
use frontend\models\PostForm;
use yii\helpers\Url;
use common\models\Video;
/**
* 
*/
class VtopWidget extends Widget
{
	public $title = '';

	public $limit =5;


	public function run()
	{
		
		$list = Video::find()
		    ->limit($this->limit)
		    ->orderBy(['addtime'=>SORT_DESC])
		    ->asArray()->all();

		 return $this->render('index',['data'=>$list]);


	}


}



 ?>