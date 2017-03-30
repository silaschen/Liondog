<?php 
namespace frontend\widgets\Show;

use yii;
use yii\base\Widget;
use common\models\PostsModel;
use frontend\models\PostForm;
use yii\helpers\Url;
/**
* 
*/
class ShowWidget extends Widget
{
	public $limit =6;

	public function run()
	{
		  // build a DB query to get all articles with status = 1
        $query = PostsModel::find()->joinWith('cate')->where(['is_valid' =>PostsModel::VALID])->orderBy(['created_at'=>SORT_DESC]);

        $left = $query->limit($this->limit)->where(["in","cats.cat_name",["宅男福利"]])->asArray()->all();

        $right = $query->limit($this->limit)->where(["in","cats.cat_name",["php","博客"]])->asArray()->all();

		 return $this->render('index',['list'=>$left,'list2'=>$right]);

	}


}



 ?>
