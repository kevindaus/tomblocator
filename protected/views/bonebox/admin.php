<?php
/* @var $this BoneboxController */
/* @var $model TombInformationLogs */

$this->breadcrumbs=array(
	'Tomb Information Logs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TombInformationLogs', 'url'=>array('index')),
	array('label'=>'Create TombInformationLogs', 'url'=>array('create')),
);


Yii::app()->clientScript->registerCss('main-body', '
.main-body {
	min-height: 300px;
}
');
?>

<h1>Bonebox Record</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tomb-information-logs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		array(
			'type'=>'raw',
			'value'=>'sprintf("%s %s %s",$data->person->firstname,$data->person->middlename,$data->person->lastname)',
			'header'=>'Name',
		),
		array(
			'type'=>'raw',
			'value'=>'date("F d,Y",strtotime($data->person->date_record_created))',
			'header'=>'Date moved',
		),
		array(
			'type'=>'raw',
			'value'=>'CHtml::link(\'View\', array(\'person/view\',\'id\'=>"$data->person_id"))',
			'header'=>'Action',
		),
		// 'person_id',
		// 'tomb_location_id',
		// 'notes',
		// 'date_record_created',
		// 'date_record_updated',
		// array(
		// 	'class'=>'CButtonColumn',
		// ),
	),
)); ?>
