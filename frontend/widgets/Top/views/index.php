	<?php 
	use yii\helpers\Url;
	 ?>

	 <div class="category blog-ctgry">
					<h4>点击排行</h4>
					<div class="list-group">
					<?php foreach ($data as $key => $value) {?>
						<a href="<?=url::to(['posts/view','id'=>$value['id']])?>" class="list-group-item"><?=$value['title']?></a>
						<?php } ?>
					</div>
			 </div>	