 <?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
  ?>
 <div class="review">
	 <div class="container">
		 <h2>文章列表</h2>
		 <div class="review-sec">
			
			 <?php foreach ($data as $key=>$vo) {
			 ?>
				 <div class="col-md-6 revw" style="margin-top: 15px;">
					 <div class="rft-grid">
						 <div class="col-md-5 rft-pic">
							 <a href="<?=url::to(['posts/view','id'=>$vo['id']])?>"><img src="<?=$vo['label_img']?>" class="img-responsive" alt=""/></a>
						 </div>
						 <div class="col-md-7 rft-pic-info">
							  <h4><a href="<?=url::to(['posts/view','id'=>$vo['id']])?>"><?=$vo['title']?></a></h4>
							 <p><?=$vo['summary']?></p>
						 </div>
						 <div class="clearfix"></div>
					 </div>
				 </div>
			<?php } ?>

				 <div class="clearfix"></div>
			 </div>
		 </div>

		<?=LinkPager::widget([
		    'pagination' => $page
		]);?>
	 </div>
</div>