<?php 
namespace frontend\controllers;
use yii;
use yii\web\Controller;
use common\models\Acfun;
/**
* 
*/
class FetchController extends Controller
{
	public function actionIndex(){
		//1get the code
		$this->GetCode("http://www.acfun.cn/v/list73/index.htm","news.txt");
		//2 regrex
		$this->GoCode();

	
		
	}

	public function actionZhai()
	{

		$this->GetCode("http://www.zhainanfulishe.net/zonghe","zhai.html");
		$this->DoCode();



	}
	

	public function GetCode($url,$file){
		 $ch = curl_init($url);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //返回数据不直接输出
		 $content = curl_exec($ch);          //执行并存储结果
		 curl_close($ch);
		$file = fopen($file,"w"); 
		fwrite($file,$content); 
		fclose($file); 

	}

	public function DoCode()
	{
		$content = file_get_contents("zhai.html");
		$pattern = '/<article class="home-blog-entry col span_1 clr"><a href="(.*?)" title="(.*?)" class="fancyimg home-blog-entry-thumb"><div class="thumb-img"><img src="(.*?)" alt="(.*?)"><span><i class="fa fa-expand"></i></span>			</div></a>
<div class="home-blog-entry-text clr">
<h3>
	<a href="(.*?)" title="(.*?)</a>
</h3>
<!-- Post meta -->
	<div class="meta">
				<span class="postlist-meta-time"><i class="fa fa-calendar"></i>(.*?)</span>
		<span class="postlist-meta-views"><i class="fa fa-fire"></i>浏览: (.*?)</span>
		<span class="postlist-meta-comments"><i class="fa fa-comments"></i><a href="(.*?)"><span>评论: </span>1</a></span>
	</div>
	<!-- /.Post meta -->
<p>
(.*?) <a rel="nofollow" class="more-link" style="text-decoration:none;" href="(.*?)"></a></p>
</div>
	<div class="clear"></div><\/article>/i';
		preg_match_all($pattern, $content, $m);

		print_r($m);






	}

	public function GoCode()
	{
		$content = file_get_contents("news.txt");
		$pattern = '/<a href="(.*?)" target="_blank" title="(.*?)" class="title">(.*?)<\/a>/i';
		preg_match_all($pattern, $content, $m);
		foreach ($m[0] as $key => $value) {
				preg_match('/<a href="(.*?)" target="_blank" title="(.*?)" class="title">(.*?)<\/a>/i', $value,$n[]);

		}
		//insert to database
		foreach ($n as $key => $value) {
			if ($key > 1) {
				
				$data = [
					'url'=>"http://www.acfun.cn".$value[1],
					'title'=>$value[3],
				];

				$model = new Acfun();
				$model->title = $data['title'];
				$model->url = $data['url'];
				$model->create_at = time();
				$count = Acfun::find()->where(['url'=>$data['url']])->count();
				if ($count <1) {
					$model->save();
				}

			}




		}
	}







}


 ?>