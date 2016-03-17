<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<section class="main-body">
  <div class="container">
  <div class="row-fluid">
	

    <div class="span2">
      
      <?php $this->widget('zii.widgets.CMenu', array(
        'encodeLabel'=>false, 
        'items'=>$this->menu,
        'htmlOptions'=>array(
            'class'=>'nav nav-pills nav-stacked'
          )
      ));?>
    
    </div><!--/span-->


    <div class="span10">

		<?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
                'homeLink'=>CHtml::link('Home',Yii::app()->homeUrl),
                'htmlOptions'=>array('class'=>'breadcrumb')
            )); ?><!-- breadcrumbs -->
        <?php endif?>
        
        <!-- Include content pages -->
        <?php echo $content; ?>

	</div><!--/span-->
    



  </div><!--/row-->
</div>
</section>


<?php $this->endContent(); ?>