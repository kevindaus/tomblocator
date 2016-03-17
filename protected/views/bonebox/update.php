<?php
/* @var $this BoneboxController */
/* @var $model TombInformationLogs */

$this->breadcrumbs=array(
	'Tomb Information Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TombInformationLogs', 'url'=>array('index')),
	array('label'=>'Create TombInformationLogs', 'url'=>array('create')),
	array('label'=>'View TombInformationLogs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TombInformationLogs', 'url'=>array('admin')),
);
?>

<h1>Update TombInformationLogs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>