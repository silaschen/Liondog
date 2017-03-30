<?php 
namespace frontend\widgets\Count;

use yii;
use yii\base\Widget;
use yii\data\Pagination;
use common\models\TagModel;
use common\models\PostsModel;
use common\models\User;
use yii\helpers\Url;
/**
* 
*/
class CountWidget extends Widget
{

	public function run()
	{
		
		$info['posts'] = PostsModel::find()->count();
		$info['tag'] = TagModel::find()->count();
		$info['user'] = User::find()->count();

		 return $this->render('index',['info'=>$info]);


	}


}



 ?>