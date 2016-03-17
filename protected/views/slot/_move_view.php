<?php
/* @var $this CustomerController */
/* @var $data PersonalInfo */
?>

<div class="span4 ">
    <?php  
      $this->widget('zii.widgets.CDetailView', array(
          'data'=>$data,
          'attributes'=>array(
              array(
                  'label'=>'Name',
                  'type'=>'raw',
                  'value'=>sprintf("%s %s %s", $data->firstname,$data->middlename, $data->lastname),
              ),
              array(
                  'label'=>'Gender',
                  'type'=>'raw',
                  'value'=>$data->gender,
              ),
              array(
                  'label'=>'Cause of death',
                  'type'=>'raw',
                  'value'=>$data->cause_of_death,
              ),
              array(
                  'label'=>'Died',
                  'type'=>'raw',
                  'value'=>date("F d,Y",strtotime($data->date_of_death)),
              ),
          ),
          'htmlOptions'=>array('class'=>'table table-bordered')
      ));
    ?>
	<button type="button" class="btn btn-warning">Revoke</button>


	<br />
</div>