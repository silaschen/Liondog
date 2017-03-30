<?php 

$this->title ='tag yun';
 ?>
 <div class="container">
 <div class="col-lg-3 pull-right">
 	




 	<div class="panel">
 		
 			<div class="panel-title">
 				
 				<h2>The Tag</h2>
 			</div>
 			<div class="panel-body">
 				<?php foreach ($list as $key => $value) {
 					
 				?>


 				<span class="label label-info"><a href=""><?=$value['tag_name']?></a></span>


 				<?php } ?>


 			</div>

 	</div>

 </div>
 	





 </div>