<?php 
namespace frontend\widgets\Vtag;

use yii;
use yii\base\Widget;
use yii\data\Pagination;
use backend\models\TagVideo;
use yii\helpers\Url;
/**
* 
*/
class VtagWidget extends Widget
{
	public $title = '';

	public $limit =100;


	public function run()
	{
		if (!$this->title) {
			$this->title = "视频标签云";
		}
		$list = TagVideo::find()
		    ->limit($this->limit)
		    ->asArray()->all();

		 return $this->render('index',['data'=>$list]);


	}


}



 ?>
