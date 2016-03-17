<?php 
$baseUrl = Yii::app()->theme->baseUrl; 
/*load font awesome */
Yii::app()->clientScript->registerCssFile($baseUrl.'/bower_components/font-awesome/css/font-awesome.css');
/*end of loading font awesome*/


/*leaflet libs*/
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/leaflet.css');
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/leaflet.js', CClientScript::POS_END);
/* end leaflet */


Yii::app()->clientScript->registerCss('availableMap', '
#availableMap { width:100%; height:100%; margin:0; padding:0; }
	');



Yii::app()->clientScript->registerCss('availableMap', '
#availableMap { width:100%; height:100%; margin:0; padding:0; }
	');
$mapInit = <<<EOL
var mapMinZoom = 0;
var mapMaxZoom = 4;
window.map = L.map('availableMap', {
  maxZoom: mapMaxZoom,
  minZoom: mapMinZoom,
  crs: L.CRS.Simple
});
window.map.setView([0, 0], mapMaxZoom);

var mapBounds = new L.LatLngBounds(
    window.map.unproject([0, 2816], mapMaxZoom),
    window.map.unproject([2048, 0], mapMaxZoom));
            
window.map.fitBounds(mapBounds);
L.tileLayer('/{z}/{x}/{y}.png', {
  minZoom: mapMinZoom, 
  maxZoom: mapMaxZoom,
  bounds: mapBounds,
  noWrap: true,
  tms: false
}).addTo(window.map);
EOL;
Yii::app()->clientScript->registerScript('mapInit', $mapInit, CClientScript::POS_READY);

if (!is_null($locationLongitude) && !is_null($locationLatitude)) {
  $addMapCode = <<<EOL
searchedItem = L.marker([parseFloat($locationLatitude), parseFloat($locationLongitude)]).addTo(window.map)
  .bindPopup(jQuery("#showMarkertemplate").html().replace("title","$tombName")).openPopup();

  setTimeout(function(){
    map.panTo(new L.LatLng($locationLatitude, $locationLongitude));
    window.map.setZoom(3)
  }, 800);

EOL;
  Yii::app()->clientScript->registerScript('addMap', $addMapCode, CClientScript::POS_READY);
}else{
  $defaultZoomCode = <<<EOL
  setTimeout(function(){
    map.panTo(new L.LatLng(-63.5, 83));
    window.map.setZoom(2)
  }, 800);
EOL;
   Yii::app()->clientScript->registerScript('defaultZoomCode', $defaultZoomCode, CClientScript::POS_READY);

}

?>
<?php if (count($personModelArr) > 0 && count($personModelArr) === 1): ?>
  <script type="text/template" id="showMarkertemplate">
    <h4 style='text-align: center'><strong>title</strong></h4>
    <hr style="margin: 8px 0px;">
    <?php  
      $personModel = $personModelArr[0];
      $this->widget('zii.widgets.CDetailView', array(
          'data'=>$personModel,
          'attributes'=>array(
              array(
                  'label'=>'Name',
                  'type'=>'raw',
                  'value'=>sprintf("%s %s %s", $personModel->firstname,$personModel->middlename, $personModel->lastname),
              ),
              array(
                  'label'=>'Gender',
                  'type'=>'raw',
                  'value'=>$personModel->gender,
              ),
              array(
                  'label'=>'Died',
                  'type'=>'raw',
                  'value'=>date("F d,Y",strtotime($personModel->date_of_death)),
              ),
          ),
          'htmlOptions'=>array('class'=>'table table-bordered')
      ));
    ?>
  </script>
<?php endif ?>

<?php if (count($personModelArr) > 0 && count($personModelArr) > 1): ?>
<!-- @TODO - list person here -->  
  <script type="text/template" id="showMarkertemplate">
    <h4 style='text-align: center'><strong>title</strong></h4>
    <hr style="margin: 8px 0px;">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Died</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($personModelArr as $key => $currentPersonModel): ?>
          <tr>
            <td><?php echo $currentPersonModel->firstname ?> <?php echo $currentPersonModel->middlename ?> <?php echo $currentPersonModel->lastname ?></td>
            <td><?php echo date("F d,Y",strtotime($currentPersonModel->date_of_death)) ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </script>
<?php endif ?>

<h1>
	Search Tomb
</h1>
<?php echo CHtml::beginForm(array('/slot/search'), 'post'); ?>
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'fade'=>true, // use transitions?
    'closeText'=>'×', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
      'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
    ),
)); ?>
<div class="input-append">
  <?php echo CHtml::hiddenField('selectedPersonId', '', array('id'=>'selectedPersonId')); ?>
  <?php 
      $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
      'name'=>'person',
      'source'=> $tombResidents,
      'options'=>array(
          'minLength'=>'2',
          'select'=>'js:function(event,ui){
            jQuery("#selectedPersonId").val(ui.item.id);
          }',
      ),
      'htmlOptions'=>array(
          'id'=>'appendedInputButton',
          'class'=>'span9',
          'placeholder'=>'Search relative',
      ),
    ));
  ?>  
  <button class="btn" type="submit">
    <i class="fa fa-search"></i>
    Search
  </button>
</div>
<?php echo CHtml::endForm(); ?>


<br>
<div id="availableMap" style="position: relative; height: 500px;"></div>	
