 <?php 
use yii\helpers\Url;
  ?>
 <div class="col-md-3 ftr-grid">
				 <h3><?=$title?></h3>
				 <ul class="ftr-list">
				 <?php foreach ($data as $key => $value) {
				 	
				 ?>
					 <li><a href="<?=url::to(['posts/index','cate'=>$value['cat_name']])?>"><?=$value['cat_name']?></a></li>
					
					 <?php } ?>
					 
				 </ul>							 
			 </div>	