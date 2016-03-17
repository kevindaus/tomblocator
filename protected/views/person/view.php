<?php
/* @var $this PersonController */
/* @var $model Person */

$this->breadcrumbs=array(
	'People'=>array('index'),
	strtoupper(sprintf("%s %s %s",$model->firstname,$model->middlename,$model->lastname)),
);
$referrer = Yii::app()->request->getUrlReferrer();
if ( isset($referrer) && !empty($referrer) ) {
	$this->menu = array(
			array('label'=>'Back' , 'url'=>$referrer)
		);
}else{
	$this->menu=array(
		array('label'=>'List Person', 'url'=>array('index')),
		array('label'=>'Create Person', 'url'=>array('create')),
		array('label'=>'Update Person', 'url'=>array('update', 'id'=>$model->id)),
		// array('label'=>'Delete Person', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage Person', 'url'=>array('admin')),
	);
}

?>

<h1>
	<?=  strtoupper(sprintf("%s %s %s",$model->firstname,$model->middlename,$model->lastname)) ?>
</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		// 'id',
		'firstname',
		'middlename',
		'lastname',
		'gender',
		'street',
		'date_of_birth',
		array(
			'type'=>"raw",
			'label'=>'Birthday',
			'value'=>date("F d,Y",strtotime($model->date_of_birth)),
		),
		'province',
		'country',
		'zipcode',
		'occupation',
		'employment_company',
		'height',
		'weight',
		'cause_of_death',
		array(
			'type'=>"raw",
			'label'=>'Died',
			'value'=>date("F d,Y",strtotime($model->date_of_death)),
		),
		array(
			'type'=>"raw",
			'label'=>'Date of record',
			'value'=>date("F d,Y",strtotime($model->date_record_created)),
		),
		// 'date_record_created',
		// 'date_record_updated',
	),
)); ?>
