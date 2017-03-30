<?php 
use yii\helpers\Url;
use frontend\widgets\Vtag\VtagWidget;
use frontend\widgets\Vtop\VtopWidget;
$this->title = "视频云";
 ?>
 <style type="text/css">
 	.category {
    margin-top: 1em;
}
 </style>
 <div class="container" >
 		<!-- 视频播放器	 -->
 	<div class="col-md-9" style="margin-top: 15px;">

  		<div id="video_c" style="width:100%;height:500px;"></div><hr>
     


    <!-- UY BEGIN -->
<div id="uyan_frame"></div>
<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2123586"></script>
<!-- UY END -->
  </div>
  <div class="col-md-3">
  <?=VtopWidget::widget(['limit'=>6])?>
  	<?=VtagWidget::widget()?>

 </div>
<script type="text/javascript" src="res/ckplayer/ckplayer.js"></script>

<script type="text/javascript">
var flashvars={
	// f:'http://123.57.160.193/frontend/web/file/rain.mp4',
 // f:'http://movie.ks.js.cn/flv/2011/11/8-1.flv',
 f:"<?=$model['url']?>",
	// c:0,
 //    p:0
    };
var params={bgcolor:'#000000',allowFullScreen:true,allowScriptAccess:'always'};
var video=['<?=$model['url']?>->video/mp4'];
CKobject.embed('res/ckplayer/ckplayer.swf','video_c','ckplayer_a1','100%','100%',false,flashvars,video);
function ckmarqueeadv(){
	return "<a href='#'>生活中除了代码，还有爱。欢迎来到liondog,祝福你！</a>";
	};
  ckmarqueeadv();
</script>
<script type="text/javascript">
    $('body').on('click','.submit-videocomment',function(){
          var url=$(this).attr("action");
          var videoid=$(this).attr("videoid"); 
          var content=$(this).parent().prev().children("textarea").val();
          if(content == ""){
            alert("不能为空");
          }
          $.post(url,{content:content,videoid:videoid},function(data){

        var newli='<li class="media" comment_id="'+data.id+'"><div class="media-left">'+
        '<a href="#" rel="author"><img width="48" height="48" class="media-object" src="__ROOT__/'+data.head_pic+'" alt=""></a></div>'+'<div class="media-body"><div class="media-heading"><a href="/user/35157" rel="author">'+data.editor+'</a> 评论于'+data.time+'</div><div class="media-content"><p>'+data.content+'</p></div></div><div class="media-action">'+
      '<a><i class="icon-reply"></i> 回复</a></div></li><hr>';
      
      $(".lev1").prepend(newli);
          });


    });

</script>