<?php 
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<div class="page-header">
	<h1>Organizational Chart</h1>
</div>

<div class="row-fluid">
	<div class="span12" style="text-align: center;">
		<?php echo CHtml::image($baseUrl.'/images/org_chart.png', 'Organizational chart', array('style'=>"height: 350px;padding: 13px;")); ?>
	</div>
</div>

