<?php 
namespace frontend\widgets\Tag;

use yii;
use yii\base\Widget;
use yii\data\Pagination;
use common\models\TagModel;
use frontend\models\PostForm;
use yii\helpers\Url;
/**
* 
*/
class TagWidget extends Widget
{
	public $title = '';

	public $limit =100;


	public function run()
	{
		if (!$this->title) {
			$this->title = "Tag os";
		}
		$list = TagModel::find()
		    ->limit($this->limit)
		    ->asArray()->all();

		 return $this->render('index',['data'=>$list]);


	}


}



 ?>
