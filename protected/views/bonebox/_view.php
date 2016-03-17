<?php
/* @var $this BoneboxController */
/* @var $data TombInformationLogs */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('person_id')); ?>:</b>
	<?php echo CHtml::encode($data->person_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tomb_location_id')); ?>:</b>
	<?php echo CHtml::encode($data->tomb_location_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_record_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_record_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_record_updated')); ?>:</b>
	<?php echo CHtml::encode($data->date_record_updated); ?>
	<br />


</div>