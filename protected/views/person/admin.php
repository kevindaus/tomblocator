<?php
/* @var $this PersonController */
/* @var $model Person */

$baseUrl = Yii::app()->theme->baseUrl; 

/*load font awesome */
Yii::app()->clientScript->registerCssFile($baseUrl.'/bower_components/font-awesome/css/font-awesome.css');
/*end of loading font awesome*/



$this->breadcrumbs=array(
	'People'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Person', 'url'=>array('index')),
	array('label'=>'Create Person', 'url'=>array('create')),
);



Yii::app()->clientScript->registerCss('customCss', '

textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{
	font-size: 18px !important;
	padding: 0px !important;
}

	');
?>


<h1>Tomb Residents</h1>
<hr>
<?php 



?>
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'fade'=>true,
    'closeText'=>'×',
    'alerts'=>array(
	    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
	    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
    ),
)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'person-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		array(
			'type'=>"raw",
			'header'=>"Name",
			'value'=>'sprintf("%s %s %s",$data->firstname,$data->middlename,$data->lastname)',
		),		
		array(
			'type'=>"raw",
			'header'=>"Address",
			'value'=>'sprintf("%s %s",$data->street,$data->middlename,$data->province)',
		),		
		array(
			'class'=>'CButtonColumn',
			'header'=>'View/Update',
			'template'=>'{view}{update}',
		),
		array(
			'header'=>'Delete',
			'type'=>'raw',
			'value'=>'CHtml::link(\'<img src="/assets/5bcb07e1/gridview/delete.png">\', array(\'delete\',\'id\'=>$data->id), array(\'style\'=>\'color:red;text-align:center;display: block\'))',
		),

		// 'date_record_created',
		// '',
		/*
		array(
			'type'=>"raw",
			// 'name'=>"date_record_created",
			'header'=>"Date recorded",
			'value'=>'date("F d,Y",strtotime($data->date_record_created))',
		),
		'country',
		'zipcode',
		'occupation',
		'employment_company',
		'height',
		'weight',
		'cause_of_death',
		'date_of_birth',
		'date_of_death',
		'date_record_updated',
		'gender',
		*/
	),
)); ?>
