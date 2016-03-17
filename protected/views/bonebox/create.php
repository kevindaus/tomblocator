<?php
/* @var $this BoneboxController */
/* @var $model TombInformationLogs */

$this->breadcrumbs=array(
	'Tomb Information Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TombInformationLogs', 'url'=>array('index')),
	array('label'=>'Manage TombInformationLogs', 'url'=>array('admin')),
);
?>

<h1>Create TombInformationLogs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>