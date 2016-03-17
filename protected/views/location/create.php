<?php
/* @var $this TombLocationAdminController */
/* @var $model TombLocations */

$this->breadcrumbs=array(
	'Tomb Locations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List locations', 'url'=>array('index')),
	array('label'=>'Manage locations', 'url'=>array('admin')),
);
?>

<h1>Create locations</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>