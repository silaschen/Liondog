<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\Cate\CateWidget;


?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html>
<head>
<title><?= Html::encode($this->title) ?></title>
<meta property="wb:webmaster" content="32b0f33edd749e88" />
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/lightbox.css">
  <!-- Bootstrap Core CSS -->
<!-- jQuery (necessary JavaScript plugins) -->
<script type='text/javascript' src="js/jquery-1.11.1.min.js"></script>
<!-- Custom Theme files -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800|Titillium+Web:400,600,700,300' rel='stylesheet' type='text/css'>
<!-- Custom Theme files -->
<!--//theme-style-->
<!-- Custom Fonts -->

	
<!-- video end -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Game Spot Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?b3bd501c6ea391b0c0cd143f22b3c51d";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<style type="text/css">
	.rft-pic img{
		height: 150px;
		width: 200px;
	}
</style>

  <?php $this->head() ?>
</head>

<script src="https://use.fontawesome.com/d9c5e70b61.js"></script>
<body>

<?php $this->beginBody() ?>
<!-- header -->
<div class="banner banner2">
	 <div class="container">
		 <div class="headr-right">
				<div class="details">
					<ul>
						<li><a href="mailto:@example.com"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>info(at)chensiwei1@outlook.com</a></li>
						<li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>(+86)1881 117 4687</li>
					</ul>
			  </div>
		 </div>
		 <div class="banner_head_top">
			  <div class="logo">
					 <h1><a href="<?=url::to(['site/index'])?>">Lion<span class="glyphicon glyphicon-knight" aria-hidden="true"></span><span>Dog</span></a></h1>
			 </div>	
			 <div class="top-menu">	 
			     <div class="content white">
					 <nav class="navbar navbar-default">
						 <div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>				
						 </div>
						 <!--/navbar header-->		
						 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							 <ul class="nav navbar-nav">
								 <li class="active"><a href="<?=Url::to(['site/index'])?>">Home</a></li>
								 <li><a href="<?=url::to(['posts/index'])?>">博客</a></li>

								 <li><a href="<?=url::to(['video/index'])?>">小视频</a></li>
								<!--  <li class="dropdown">
									<a href="#" class="scroll dropdown-toggle" data-toggle="dropdown">Reviews<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="review.html">Review 1</a></li>
										<li><a href="review.html">Review 2</a></li>
										<li><a href="review.html">Review 3</a></li>
									</ul>
								 </li>	 -->				
								 <li><a href="<?=url::to(['posts/gallery'])?>">Gallery</a></li>
								 <li><a href="<?=url::to(['site/about'])?>">关于我</a></li>
								 <li><a href="<?=url::to(['site/contact'])?>">Contact</a></li>
								 	 <?php if (Yii::$app->user->isGuest) {?>

								 	 <li><a href="<?=url::to(['site/signup'])?>">注册</a></li>
								 	  <li><a href="<?=url::to(['site/login'])?>">登录</a></li>

								 	 <?php }else{ ?>

								 	  <li class="dropdown">
										<a href="#" class="scroll dropdown-toggle" data-toggle="dropdown"><?=yii::$app->user->identity->username?><b class="caret"></b></a>
										<ul class="dropdown-menu">
										<li><a href="<?=url::to(['posts/create'])?>">写博客</a></li>
										<li><a href="<?=url::to(['site/logout'])?>" data-method="POST">退出</a></li>
										<!-- <li><a href="review.html">Review 3</a></li> -->
											</ul>
								 	</li>	

								 	 <?php } ?>
							 </ul>
							</div>
						  <!--/navbar collapse-->
					 </nav>
					  <!--/navbar-->
				 </div>
					 <div class="clearfix"></div>
					<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
			  </div>
				 <div class="clearfix"></div>
		  </div>
		 
	 </div>	 
</div>
<div class="content">
 <?= Alert::widget() ?>
	<?=$content?>
</div>
<script src="js/lightbox-plus-jquery.min.js"></script>

<!-- footer -->
<div class="footer">
	 <div class="container">
		 <div class="footer-grids">
			 <div class="col-md-6 news-ltr">
				 <h4>Newsletter</h4>
				 <p>Enter ur mail,We will send u our best book and contact.</p>
					 
					   <div class="input-group">
      <input type="mail" name="mail" class="form-control" placeholder="Enter mail">
      <span class="input-group-btn">
        <button class="btn btn-default" onclick="send()" type="button">Subscribe</button>
      </span>
    </div><!-- /input-group -->
					 <div class="clearfix"></div>
					 
			 </div>
			<?=CateWidget::widget(['title'=>"分类"])?>
			 <div class="col-md-3 ftr-grid">
				 <h3>链接</h3>
				 <ul class="ftr-list">
					 <li><a href="http://www.manks.top/">白狼栈</a></li>
					 <li><a href="http://www.bootcss.com/">bootstrap</a></li>
					 <li><a href="https://luluqi.cn/">lulu学院</a></li>					 
					<!--  <li><a href="#">XBOX ONE</a></li>
					 <li><a href="#">PSP</a></li> -->
				 </ul>				 
			 </div>			 	
			 <div class="clearfix"></div>
		 </div>
	 </div>
</div>
<!---->
<div class="copywrite">
	 <div class="container">
		  <p>Copyright &copy; <?=date("Y",time())?>.LionDog All rights reserved.</p>
		  <p>联系QQ:43468436&nbspICP号：京ICP备17006705号</p>
	 </div>
</div>
<script type="text/javascript">
	
	function send(){
		var con = $("input[name='mail']").val();
		
		$.post("<?=url::to(['site/mail'])?>",{"con":con},function(data){
						alert(data.msg);
						
						$("input[name='mail']").val("");


		},'JSON');



	}
</script>
<!---->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
