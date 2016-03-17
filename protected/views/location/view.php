<?php
/* @var $this TombLocationAdminController */
/* @var $model TombLocations */

$this->breadcrumbs=array(
	'Tomb Locations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List locations', 'url'=>array('index')),
	array('label'=>'Update location', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete location', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage locations', 'url'=>array('admin')),
);
?>

<h1>View location |  <small><?php echo $model->tomb_name; ?></small></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tomb_name',
		'status',
		'loc_latitude',
		'loc_longitude',
		'date_record_created',
		'date_record_updated',
	),
)); ?>
