<?php
/* @var $this TombLocationAdminController */
/* @var $data TombLocations */
?>

<div class="view well">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tomb_name')); ?>:</b>
	<?php echo CHtml::encode($data->tomb_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />



</div>