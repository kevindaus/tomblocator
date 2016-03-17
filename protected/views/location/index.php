<?php
/* @var $this TombLocationAdminController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tomb Locations',
);

$this->menu=array(
	array('label'=>'Create locations', 'url'=>array('create')),
	array('label'=>'Manage locations', 'url'=>array('admin')),
);
?>

<h1>Tomb Locations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
