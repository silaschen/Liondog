 <?php 

use yii\helpers\Url;
  ?>
 <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav2" role="tablist">
                    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">前线资讯</a></li>
                    <li role="presentation" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab">点击排行</a></li>
                    </ul>
               <!-- Tab panes -->
              <div class="tab-content">
              	<!-- 	recently -->
              			<div role="tabpanel" class="tab-pane active re-pad2" id="profile">

						<?php   foreach ($data1 as $key => $value) {  ?>
						
						
							<div class="game-post">
								<div class="col-md-3 tab-pic">
									<a href="<?=url::to(['posts/view','id'=>$value['id']])?>"><img src="<?=$value['label_img']?>" alt="/" class="img-responsive"></a>
								</div>
								<div class="col-md-9 tab-post-info">
								<h4><a href="<?=url::to(['posts/view','id'=>$value['id']])?>"><?=$value['title']?></a></h4>
								<p>Posted By <a href="#"><?=$value['user_name']?></a> &nbsp;&nbsp; on <?=date("M",$value['created_at'])?> <?=date("d",$value['created_at'])?>, <?=date("Y",$value['created_at'])?> &nbsp;&nbsp; <a href="#">Comments (10)</a></p>
								</div>
								<div class="clearfix"></div>
							</div>
							
							<?php } ?>
						</div> 

					<!-- 	recently -->
						<div role="tabpanel" class="tab-pane re-pad2" id="home">
						<?php foreach ($data2 as $key => $value) {?>
						   <div class="game1">
								<div class="col-md-3 tab-pic">
									<a href="single.html"><img src="<?=$value['label_img']?>" alt="/" class="img-responsive"></a>
								</div>
								<div class="col-md-9 tab-pic-info">
								<h4><a href="<?=url::to(['posts/view','id'=>$value['id']])?>"><?=$value['title']?></a></h4>
								<p><?=$value['summary']?>.</p>
								</div>
								<div class="clearfix"></div>
							</div>
						<?php } ?>
						</div>
					                  
			 </div>