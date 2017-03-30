	<?php 
	use yii\helpers\Url;
	 ?>

	 <div class="category blog-ctgry">
					<h4>观看排行</h4>
					<div class="list-group">
					<?php foreach ($data as $key => $value) {?>
						<a href="<?=url::to(['site/play','id'=>$value['id']])?>" class="list-group-item"><?=$value['name']?></a>
						<?php } ?>
					</div>
			 </div>	