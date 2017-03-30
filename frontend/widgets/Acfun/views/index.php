	<?php 
	use yii\helpers\Url;
	 ?>

	 <div class="category blog-ctgry">
					<h4>AcFun</h4>
					<div class="list-group">
					<?php foreach ($data as $key => $value) {?>
						<a href="<?=$value['url']?>" class="list-group-item"><?=$value['title']?></a>
						<?php } ?>
					</div>
			 </div>	