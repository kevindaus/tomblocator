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


Yii::app()->clientScript->registerScript('callShowAllMarkers', '
showAllMarkers();
  ', CClientScript::POS_READY);

  $defaultZoomCode = <<<EOL
  setTimeout(function(){
    map.panTo(new L.LatLng(-63.5, 83));
    window.map.setZoom(2)
  }, 800);
EOL;
   Yii::app()->clientScript->registerScript('defaultZoomCode', $defaultZoomCode, CClientScript::POS_READY);




?>
<script type="text/template" id="showSingleMarkertemplate">
  <b>title</b> 
  <hr>
  <table class="table table-bordered table-hover">
    <tbody>
      <tr>
        <td colspan="2">
          <strong>Lot information</strong>
        </td>
      </tr>
      <tr>
        <td>Length</td>
        <td>2.5sqm</td>
      </tr>
      <tr>
        <td>Width</td>
        <td>1x2.5sqm</td>
      </tr>
    </tbody>
  </table>
</script>
<script type="text/javascript">
  window.markerCollection = [];
  function showAllMarkers() {
    jQuery.ajax({
      url: '/slot/availableJson',
      type: 'GET',
      dataType: 'json',
      complete:function(xhr){
        $("#showAllTombLoading").hide();
      },
      beforeSend:function(){
        $("#showAllTombLoading").show();
      },
      success: function(data, textStatus, xhr) {
        //called when successful
        jQuery.each(data, function(index, val) {
          
        tempmarkerContainer = L.marker([
            parseFloat(val.loc_latitude),
            parseFloat(val.loc_longitude)
          ]).addTo(window.map)
          .bindPopup(  
            jQuery("#showSingleMarkertemplate")
            .html()
            .replace("title",val.tomb_name)
          )
              window.markerCollection.push(tempmarkerContainer);
          });
            
      },
      error: function(xhr, textStatus, errorThrown) {
        alert('Cant retrieve json data for Slot');
      }
    });
    
  }

</script>


<h1>
	Available Tombs <br>
  <i id='showAllTombLoading' class="fa fa-spinner fa-spin" style="display: none"></i>
</h1>
<p>Available tombs at <strong>Rosa Flor Eternal Gardens</strong></p>

<hr>

<br>

<div id="availableMap" style="position: relative; height: 500px;"></div>	
