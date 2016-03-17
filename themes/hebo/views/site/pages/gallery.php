<?php 
$baseUrl = Yii::app()->theme->baseUrl;  


Yii::app()->clientScript->registerScriptFile( $baseUrl.'/plugin/smooth_gallery/easing.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile( $baseUrl.'/plugin/smooth_gallery/smoothgallery.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerCssFile($baseUrl.'/plugin/smooth_gallery/smoothgallery.css');

Yii::app()->clientScript->registerScript('asd', '

    $(document).smoothGallery({
        animSpeed:300, 
        delaySpeed:50,
        visibleRows: 4,
        animEasing: "easeOutQuart"
    });
	jQuery(".sg").smoothGallery();
	setTimeout(function() {
		$(document).trigger("resize");
		$(window).trigger("resize");
	}, 500);
	', CClientScript::POS_READY);
?>


<h1>Rosa Flor Image Gallery</h1>

 <div class="sg">
<!--     <div class="sg-item">
        <a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"></a>
        <br>PHOTO TITLE
    </div>
    <div class="sg-item">
        <a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"></a>
        <br>PHOTO TITLE
    </div>
    <div class="sg-item">
        <a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"></a>
        <br>PHOTO TITLE
    </div>
    <div class="sg-item">
        <a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"></a>
        <br>PHOTO TITLE
    </div>
    <div class="sg-item">
        <a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"></a>
        <br>PHOTO TITLE
    </div>
    <div class="sg-item">
        <a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg"></a>
        <br>PHOTO TITLE
    </div>
 -->
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171641_867435906660091_124988672_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171872_867434673326881_946509394_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171872_867434673326881_946509394_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12169501_867435623326786_154390364_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12169501_867435623326786_154390364_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12169832_867434986660183_841254041_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12169832_867434986660183_841254041_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12169918_867435646660117_38680483_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12169918_867435646660117_38680483_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12170844_867435356660146_1748002506_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12170844_867435356660146_1748002506_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12170901_867435173326831_567892548_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12170901_867435173326831_567892548_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171477_867435639993451_1243946658_o (1).jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171477_867435639993451_1243946658_o (1).jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171500_867434789993536_4506670_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171500_867434789993536_4506670_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171537_867435613326787_1940312446_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171537_867435613326787_1940312446_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12171584_867435359993479_649471849_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12171584_867435359993479_649471849_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12177187_867434883326860_298719919_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12177187_867434883326860_298719919_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12177278_867435369993478_106113646_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12177278_867435369993478_106113646_o.jpg" width="1000" height="430" />
		</a>

	</div>
	<div class="sg-item">
		<a href="<?php echo Yii::app()->theme->baseUrl;?>/images/12177611_867435083326840_2006296092_o.jpg">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/12177611_867435083326840_2006296092_o.jpg" width="1000" height="430" />    
		</a>

	</div>

</div>
<br>
<div class="sg-paginate">
    <a href="#" class="sg-up">▲</a><a href="#" class="sg-down">▼</a>
</div>

