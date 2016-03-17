<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);


Yii::app()->clientScript->registerCss('main-body', '
.main-body .container,.main-body {
	min-height: 300px;
}
.main-body .container {
	margin-bottom : 20px;
}
');
?>

<center>
<h1 style="margin-top: 104px;">Error <?php echo $code; ?></h1>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
</center>