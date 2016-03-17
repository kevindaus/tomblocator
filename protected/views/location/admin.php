<?php
/* @var $this TombLocationAdminController */
/* @var $model TombLocations */

$this->breadcrumbs=array(
	'Tomb Locations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List locations', 'url'=>array('index')),
	array('label'=>'Create locations', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tomb-locations-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tomb Locations</h1>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tomb-locations-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		'tomb_name',
		// 'status',
		// 'loc_latitude',
		// 'loc_longitude',
		// 'date_record_created',
		/*
		'date_record_updated',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
