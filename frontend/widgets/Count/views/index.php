	<?php 
	use yii\helpers\Url;
	 ?>

	<div class="panel panel-info" style="margin-top: 20px;">
		

		<div class="panel-heading">
    <h3 class="panel-title">统计</h3>
  </div>
  <div class="panel-body">
  <div class="row">
  		<div class="col-md-6 col-xs-6">
  			
  		<h4>文章:&nbsp&nbsp<?=$info['posts']?></h4><hr>
		<h4>标签:&nbsp&nbsp<?=$info['tag']?></h4><hr>
		<h4>posts:&nbsp&nbsp<?=$info['posts']?></h4><hr>
		<h4>会员:&nbsp&nbsp<?=$info['user']+20?></h4><hr>
  		</div>

  		<div class="col-md-6 col-xs-6">
  			<h4>文章:&nbsp&nbsp<?=$info['posts']?></h4><hr>
		<h4>标签:&nbsp&nbsp<?=$info['tag']?></h4><hr>
		<h4>posts:&nbsp&nbsp<?=$info['posts']?></h4><hr>
		<h4>会员:&nbsp&nbsp<?=$info['user']+20?></h4><hr>

  		</div>


  </div>
    	
  </div>



	</div>
