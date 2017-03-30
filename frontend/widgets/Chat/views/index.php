<?php 
use yii\helpers\Url;
 ?>
<div class="panel panel-default hidden-xs" style="height: 400px;overflow: auto;">
  <div class="panel-heading">
    <h3 class="panel-title">大家正在说...</h3>
  </div>
  <div class="panel-body">

    	<div class="input-group">
      <textarea style="height: 50px"  class="form-control bg-blue" placeholder="Search for..."></textarea>
      <span  class="input-group-btn input-group-lg">
        
        <button style="height: 50px" class="btn btn-feed btn-success chat" url="<?=url::to(['site/chat'])?>" data-href="<?=url::to(['site/login'])?>" type="button">发布!</button>
      </span>
    </div><!-- /input-group -->
    <div class="comment">

    <?php foreach ($model as $key => $value) {
    	
    ?>

		    <div class="media">
		  <div class="media-left">
		    <a href="#">
		      <img class="media-object" src="<?=$value['user']['avatar']?>" width="35" height="35" class="img-responsive" alt="...">
		    </a>
		  </div>
		  <div class="media-body">
		    <h5 class="media-heading"><span class="pull-left"><?=$value['user']['username']?></span> &nbsp发表于<?=date("Y-m-d H:i",$value['addtime'])?>	</h5>
		    <p><?=$value['content']?></p>
		  </div>
		</div>


<?php }?>
</div>

  </div>
</div>
