<?php
/* @var $this TombLocationAdminController */
/* @var $model TombLocations */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tomb_name'); ?>
		<?php echo $form->textField($model,'tomb_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'loc_latitude'); ?>
		<?php echo $form->textField($model,'loc_latitude',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'loc_longitude'); ?>
		<?php echo $form->textField($model,'loc_longitude',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_record_created'); ?>
		<?php echo $form->textField($model,'date_record_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_record_updated'); ?>
		<?php echo $form->textField($model,'date_record_updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->