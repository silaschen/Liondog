<?php 

use yii\helpers\Url;
 ?>
<div class="games-grids">
					 <div class="game-grid-left">

					 <?php foreach($list as $vo){ ?>

						 <div class="grid1" style="margin-bottom: 15px;">
							 <h5 class="act"><a href="<?=url::to(['posts/index','cate'=>$vo['cate']['cat_name']])?>"><?=$vo['cate']['cat_name']?></a></h5>
							 <a href="single.html"><img src="<?=$vo['label_img']?>" class="img-responsive" alt=""/></a>
							 <div class="grid1-info">
								 <h4><a href="single.html"><?=$vo['title']?></a></h4>
								 <p><?=$vo['summary']?></p>								 
							 </div>
							 <div class="more">
							 <a href="<?=url::to(['posts/view','id'=>$vo['id']])?>">Read more</a>
							 </div>
						 </div>

						 <?php }?>
					
					 </div>
					 
					 <div class="game-grid-right">

					  <?php foreach($list2 as $vo){?>

						 <div class="grid3">
							 <h5 class="sport"><a href="<?=url::to(['posts/index','cate'=>$vo['cate']['cat_name']])?>"><?=$vo['cate']['cat_name']?></a></h5>
							 <a href="single.html"><img src="<?=$vo['label_img']?>" class="img-responsive" alt=""/></a>
							 <div class="grid1-info">
								 <h4><a href="<?=url::to(['posts/view','id'=>$vo['id']])?>"><?=$vo['title']?></a></h4>
								 <p><?=$vo['summary']?></p>								 
							 </div>
							 <div class="more">
							 <a href="<?=url::to(['posts/view','id'=>$vo['id']])?>">Read more</a>
							 </div>
						 </div>

						 <?php }?>
				
					 </div>
					 <div class="clearfix"></div>
				 </div>