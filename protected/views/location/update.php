<?php
/* @var $this TombLocationAdminController */
/* @var $model TombLocations */

$this->breadcrumbs=array(
	'Tomb Locations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List locations', 'url'=>array('index')),
	array('label'=>'Create location', 'url'=>array('create')),
	array('label'=>'View location', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage locations', 'url'=>array('admin')),
);
?>

<h2>
	Update location name - <small><?php echo $model->tomb_name; ?></small>
</h2>
<hr>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>