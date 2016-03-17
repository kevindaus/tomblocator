<?php
/* @var $this BoneboxController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tomb Information Logs',
);

$this->menu=array(
	array('label'=>'Create TombInformationLogs', 'url'=>array('create')),
	array('label'=>'Manage TombInformationLogs', 'url'=>array('admin')),
);
?>

<h1>Tomb Information Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
