 <?php 
use yii\helpers\Url;
use frontend\widgets\Tag\TagWidget;
use frontend\widgets\Trend\TrendWidget;
use frontend\widgets\Top\TopWidget;
use frontend\widgets\Gallery\GalleryWidget;
use frontend\widgets\Show\ShowWidget;
use frontend\widgets\Count\CountWidget;
use frontend\widgets\Acfun\AcfunWidget;
use frontend\widgets\Hot\HotWidget;
use frontend\widgets\Chat\ChatWidget;
  ?>
 <div class="container">
		  <div class="col-md-8 content-left">
			 <?=HotWidget::widget()?>
			 <?=ShowWidget::widget(['limit'=>6])?>
		  </div>
      
		  <div class="col-md-4 content-right">
			  <!-- Nav tabs -->
             <?=ChatWidget::widget(['limit'=>6])?>
               <!-- Tab panes -->
        	 <?=TrendWidget::widget(['limit'=>8])?>

			 <?=TopWidget::widget(['limit'=>6])?>	
			 <!-- GalleryWidget::widget() -->
			 <?=AcfunWidget::widget(['limit'=>8])?>
			 <!-- tag -->
			 <?=TagWidget::widget()?>
			 <!-- tag end -->

			 <?=CountWidget::widget()?>

			 
		  </div>
		  <div class="clearfix"></div>
	 </div>
