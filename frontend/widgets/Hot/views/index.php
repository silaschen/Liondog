<?php 
use yii\helpers\Url;
 ?>

 	<div class="information">
				 <h4>今日头条</h4>
				 <div class="information_grids">
					 <div class="info">					 
						 <p><?=$info['title']?></p>
						 <a href="<?=url::to(['posts/view','id'=>$info['id']])?>">read info</a>
					 </div>
					 <div class="info-pic">	
						 <a href="<?=url::to(['posts/view','id'=>$info['id']])?>"><img src="<?=$info['label_img']?>" class="img-responsive" alt=""/></a>
					 </div>
					 <div class="clearfix"></div>
				 </div>				 
	</div>

	