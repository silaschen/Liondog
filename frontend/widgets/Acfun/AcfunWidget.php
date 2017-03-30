<?php 
namespace frontend\widgets\Acfun;
use yii;
use yii\base\Widget;
use yii\data\Pagination;
use common\models\Acfun;
use yii\helpers\Url;
/**
* 
*/
class AcfunWidget extends Widget
{
	public $title = '';

	public $limit =8;


	public function run()
	{
		
		$list = Acfun::find()
		    ->limit($this->limit)
		    ->orderBy(['create_at'=>SORT_DESC])
		    ->asArray()->all();
		 return $this->render('index',['data'=>$list]);


	}


}

 ?>
