<?php 
namespace frontend\models;
use yii;
use yii\base\Model;
use common\models\TagModel;
/**
* 
*/
class TagForm extends Model
{
	
	public $id;
	public $tags;


	public function saveTag()
	{
		$ids = [];

		if (!empty($this->tags)) {
				
			foreach ($this->tags as $value) {
				$ids[] = $this->Tag($value);
			}

		}

		return $ids;

	}

	private function Tag($name)
	{
		$model = new TagModel();
		$re = $model->find()->where(["tag_name"=>$name])->one();
		if ($re) {
			$re->updateCounters(['post_num'=>1]);
		}else{

			$model->tag_name = $name;
			$model->post_num = 1;
			if (!$model->save()) {
				throw new Exception("tag add failed");
				
			}
			return $model->id;
			
		}


		return $re->id;

	}


	public function GetPost()
	{
		$model = new TagModel;

		$data = $model->find()->with('relatepost.post')->asArray()->all();
		// $data = $model->find()->asArray()->limit(20)->all();
		// var_dump($data);

		return $data;





	}
}

 ?>