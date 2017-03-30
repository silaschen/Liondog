 <div class="photo-gallery">
				 <h4>Photo Gallery</h4>

				 
				 <div class="gallery-1">
				 <?php foreach ($data as $key => $value) {
				 	
				  ?>
					<div class="col-md-4 gallery-grid-pic">
						<a class="example-image-link" href="<?=$value['img']?>" data-lightbox="example-set"><img class="example-image" src="<?=$value['img']?>" alt=""/></a>
					</div>

					<?php } ?>
				<!-- 	<div class="col-md-4 gallery-grid-pic">
						<a class="example-image-link" href="images/p1.jpg" data-lightbox="example-set"><img class="example-image" src="images/p1.jpg" alt=""/></a>
					</div> -->
				<!-- 	<div class="col-md-4 gallery-grid-pic">
						<a class="example-image-link" href="images/p3.jpg" data-lightbox="example-set"><img class="example-image" src="images/p3.jpg" alt=""/></a>
					</div> -->
					<div class="clearfix"></div>
				 </div>
				
				
			 </div>