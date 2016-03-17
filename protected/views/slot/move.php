<?php 
$baseUrl = Yii::app()->theme->baseUrl; 
/*load font awesome */
Yii::app()->clientScript->registerCssFile($baseUrl.'/bower_components/font-awesome/css/font-awesome.css');
/*end of loading font awesome*/



?>

<h1>Move tomb resident to bone box</h1>
<hr>
<?php 
$this->widget('bootstrap.widgets.TbAlert', array(
    'fade'=>true,
    'closeText'=>'×',
    'alerts'=>array(
	    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
	    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
    ),
)); ?>


<?php echo CHtml::beginForm(array('slot/move'), 'post'); ?>
<div class="input-append">
  <input class="span8"  type="text" name="searchKey" placeholder="Search person name">
  <button class="btn " type="submit">
    Search
  </button>
</div>
<?php echo CHtml::endForm(); ?>

<!-- list all person -->
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'firstname',
        'lastname',
        'cause_of_death',
        array(
            'name'=>'date_of_death',
            'value'=>'date("M j, Y", strtotime($data->date_of_death))',
        ),
        array(
            "header"=>"Tombname",
            'type'=>'raw',
            'value'=>'$data->tombInformations[0]->tombLocation->tomb_name',
        ),
        array(
            'type'=>'raw',
            'value'=>'CHtml::link("Move to bone box", array("slot/Revoke","tombName"=>$data->tombInformations[0]->tombLocation->tomb_name,"notes"=>"revoked at ".date("Y-m-d H:i:s")))',
        ),

    ),    
));

  // $this->widget('zii.widgets.CListView', array(
  //     'dataProvider'=>$dataProvider,
  //     'itemView'=>'_move_view', 
  //     'template'=>"{summary}\n{sorter}\n{items}\n{pager}", 
  //     // 'sortableAttributes'=>array(
  //     //     'title',
  //     //     'create_time'=>'Post Time',
  //     // ),
  // ));

?>
<!-- end of listing all person -->