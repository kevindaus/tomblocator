<?php 
?>
<?php echo CHtml::beginForm(Yii::app()->request->requestUri, 'post'); ?>
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true,
    'fade'=>true,
    'closeText'=>'×',
    'alerts'=>array(
	    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
	    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
    ),
)); ?>
<h1>Confirm password : <small>re-enter your password to continue record deletion</small></h1>
<hr>
<label>Confirm Password : </label>
<?php echo CHtml::textField('confirmation_password', null,array('placeholder'=>"Confirm password")); ?>
<br>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo CHtml::endForm(); ?>