<?php 
namespace frontend\widgets\Chat;

use yii;
use yii\base\Widget;
use yii\helpers\Url;
use common\models\Chat;
/**
* 
*/
class ChatWidget extends Widget
{
	public $limit =6;

	public function run()
	{
		$model = Chat::find()->with('user')->limit($this->limit)->asArray()->orderBy("id DESC")->all();

		 return $this->render('index',['model'=>$model]);

	}


}



 ?>
