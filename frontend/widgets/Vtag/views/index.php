<?php 
use yii\helpers\Url;
$class = array(
	"label label-info","label label-warning","label label-success","label label-danger",

	);


 ?>
			 	 <div class="photo-gallery">
				 <h4><?=$this->title?></h4>
				 <div class="gallery-1">


				 <?php foreach ($data as $key => $value) {
				 	
				 ?>

					<!-- <div class="col-xs-3 col-md-2" style="margin-top: 10px;"> -->
						<span class="<?=$class[rand(0,3)]?>" style="margin-bottom: 7px;display: inline-block;"><a style="font-size: 15px;" href="<?=url::to(['posts/index','tag'=>$value['tag_name']])?>"><?=$value['tag_name']?></a></span>
				<!-- 	</div> -->
				
					<?php   }?>


					<div class="clearfix"></div>
				 </div>

			 </div>