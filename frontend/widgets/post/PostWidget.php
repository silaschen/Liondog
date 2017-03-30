<?php 
namespace frontend\widgets\post;

use yii;
use yii\base\Widget;
use yii\data\Pagination;
use common\models\PostsModel;
use frontend\models\PostForm;
use yii\helpers\Url;
/**
* 
*/
class PostWidget extends Widget
{
	public $title = '';
	public $limit = '';
	public $more = true;
	public $page = true;
	public function run()
	{
		$map = [];
		$tag = yii::$app->request->get("tag");
		 $cate = yii::$app->request->get("cate");
		if ($tag) {
			$map['tags.tag_name'] = $tag;
		}
		if ($cate) {
			$map['cats.cat_name'] = $cate;
		}
		// $map['is_valid'] = PostsModel::VALID;
		$query = PostsModel::find()->joinWith('relate.tag','extend')->joinWith('cate')->where($map);
		// get the total number of articles (but do not fetch the article data yet)
		$count = PostsModel::find()->count();

		// create a pagination object with the total count
		$pagination = new Pagination(['totalCount' => $count,'pageSize'=>'10']);

		// limit the query using the pagination and retrieve the articles
		$list = $query->offset($pagination->offset)
		    ->limit($pagination->limit)
		    ->asArray()->all();
		    foreach ($list as $key => $value) {
		    		foreach ($value['relate'] as $tag) {
		    			$list[$key]['tags'][] = $tag['tag']['tag_name'];
		    		}
		    		unset($list[$key]['relate']);
		    }
		 return $this->render('index',['data'=>$list,'page'=>$pagination]);
	}

}


 ?>