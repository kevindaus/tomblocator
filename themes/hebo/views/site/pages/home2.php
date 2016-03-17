<?php $baseUrl = Yii::app()->theme->baseUrl;  ?>

    <div class="slider-bootstrap"><!-- start slider -->
   
    	<div id="myCarousel" class="carousel slide" style="min-height:430px;">
          <!-- Carousel items -->
          <div class="carousel-inner">
            <div class="active item" style="height:430px;">
       	    	<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg" width="1000" height="430" />
            </div>
            <div class="item" style=" height:430px;">
            	<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12177187_867434883326860_298719919_o.jpg" width="1000" height="430" />
            </div>
            <div class="item" style=" height:430px;">
            	<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12169501_867435623326786_154390364_o.jpg" width="1000" height="430" />
            </div>
          </div>
          <!-- Carousel nav -->
          <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
          <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>

    </div> <!-- /slider -->
    
  
    
       <h3 class="header">More About Us
          <span class="header-line"></span> 
        </h3>
        
 
      <div class="row-fluid">
            <ul class="thumbnails center">
              <li class="span4">
                <div class="thumbnail">
                <h3>History</h3>
                  
                    <div class="">
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/history.png" alt="" class="">
                     </div>
                  <p>
                    Know more about our history. <br>
                    <?php echo CHtml::link('Read more...', array('/history')); ?>
                  </p>
                </div>
              </li>
              <li class="span4">
                <div class="thumbnail">
                   <h3>Services</h3>
                     
                     <div class="">
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/services.png" alt="" class="">
                     </div>
                  <p>
                    Checkout our services.<br>
                    <?php echo CHtml::link('Read more...', array('/services')); ?>
                  </p>
                </div>
              </li>
              <li class="span4">
                <div class="thumbnail">
                  <h3>Organizational Chart</h3>
                    <div class="">
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/org-chart.png" alt="" class="">
                     </div>
                  <p>
                    Know who's in-charge
                    <br>
                    <?php echo CHtml::link('Read more...', array('/organizationalChart')); ?>
                  </p>
                </div>
              </li>

            </ul>
        </div>
 