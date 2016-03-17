<?php
/* @var $this BoneboxController */
/* @var $model TombInformationLogs */

$this->breadcrumbs=array(
	'Tomb Information Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TombInformationLogs', 'url'=>array('index')),
	array('label'=>'Create TombInformationLogs', 'url'=>array('create')),
	array('label'=>'Update TombInformationLogs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TombInformationLogs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TombInformationLogs', 'url'=>array('admin')),
);
?>

<h1>View TombInformationLogs #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'person_id',
		'tomb_location_id',
		'notes',
		'date_record_created',
		'date_record_updated',
	),
)); ?>
