<?php 
namespace frontend\widgets\Gallery;
use yii;
use common\models\GalleryModel;
use yii\base\Widget;
/**
* 
*/
class GalleryWidget extends Widget
{	
	public $limit = "20";
	
	public function run()
	{
		
		$list = GalleryModel::find()
		    ->limit($this->limit)
		    ->orderBy(["addtime"=>SORT_DESC])
		    ->asArray()->all();

		 return $this->render('index',['data'=>$list]);


	}
}

 ?>
