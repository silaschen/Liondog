<?php 

use yii\helpers\html;
use yii\helpers\Url;
$this->title=$model['title'];

 ?>

<div class="container">
				<div class="single">
					<div class="blog-to">		
					
						<img class="img-responsive sin-on img-rounded" src="<?=$model['label_img']?>" alt="" />
							<div class="blog-top">
							<div class="blog-left">
								<b><?=date("d",$model['created_at'])?></b>
								<span><?=date("M",$model['created_at'])?></span>
							</div>
							<div class="top-blog">
								<a class="fast" href="#">版权所有，不得转载 </a>
								<p>Posted by <a href="#"><?=$model['user_name']?></a> in <a ><?=date("Y-M-d H:i",$model['created_at'])?></a> | <a href="#">10 Comments</a></p> 
								<p class="sed"><?=$model['content']?></p>
								<p>tag:&nbsp
								<?php foreach ($model['tags'] as $key => $value) {
							
								 ?>
							 <span><a href="<?=url::to(['posts/index','tag'=>$value])?>"><?=$value?></a></span>
								<?php   } ?>

								</p>
						
						<div class="clearfix"> </div>
							</div>
							<div class="clearfix"> </div>
					</div>
					</div>
						
					
				
	

		<div class="single-bottom">
<!-- UY BEGIN -->
<!-- <div id="uyan_frame"></div>
<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2123586"></script> -->
<!-- UY END -->
		<!-- 多说评论框 start -->
	<div class="ds-thread" data-thread-key="<?=$model['id']?>" data-title="<?=$model['title']?>" data-url="http://www.liondog.cn/frontend/web/index.php?r=posts/view&id=<?=$model['id']?>"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
var duoshuoQuery = {short_name:"liondog"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0] 
		 || document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
	</script>
<!-- 多说公共JS代码 end -->
			</div>
		</div>
</div>