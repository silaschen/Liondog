<?php 
namespace frontend\widgets\Cate;

use yii;
use yii\base\Widget;
use common\models\CatsModel;
use yii\helpers\Url;
/**
* 
*/
class CateWidget extends Widget
{
	public $limit =6;
	public $title;
	public function run()
	{
		$list = CatsModel::find()->limit($this->limit)->asArray()->all();

		 return $this->render('index',['data'=>$list,'title'=>$this->title]);


	}


}



 ?>