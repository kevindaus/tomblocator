<?php 
/**
 * @var TombLocRegisterForm formModel 
 * 
 */
$baseUrl = Yii::app()->theme->baseUrl; 

/*load font awesome */
Yii::app()->clientScript->registerCssFile($baseUrl.'/bower_components/font-awesome/css/font-awesome.css');
/*end of loading font awesome*/



/*leaflet libs*/
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/leaflet.css');
Yii::app()->clientScript->registerCssFile($baseUrl.'/css/leaflet.label.css');
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/leaflet.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/Label.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/BaseMarkerMethods.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/Marker.Label.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/CircleMarker.Label.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/Path.Label.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/Map.Label.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/FeatureGroup.Label.js', CClientScript::POS_END);

/* end leaflet */


Yii::app()->clientScript->registerCss('availableMap', '
#availableMap { width:100%; height:100%; margin:0; padding:0; }
');

Yii::app()->clientScript->registerCss('errorStyle', '
.errorSummary{
	color: white;
	background-color: red;
	padding: 10px;
}
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



gate_icon = L.icon({
	iconUrl: '/themes/hebo/img/gate-icon.png',
	iconSize: [36, 36],
	iconAnchor: [18, 18],
	popupAnchor: [0, -18],
	labelAnchor: [14, 0] 
});
L.marker([-53,99], {
		icon: gate_icon	
	})
	.bindPopup('Gate')
	.bindLabel('Gate')
	.addTo(window.map)
	.openPopup();


EOL;
Yii::app()->clientScript->registerScript('mapInit', $mapInit, CClientScript::POS_READY);


?>

<script type="text/template" id="markerTemplate">
	<b>Drag and drop the marker</b>
	<br />
	Find the location of the tomb 
</script>
<script type="text/template" id="showSingleMarkertemplate">
	<b>title</b> 
	content
</script>
<script type="text/javascript">
	window.markerCollection = [];
	window.currentAddedMarker = null;

	function addMarker(){
		/*hide all markers in the map */
		hideAllMarkers ();
		/*put marker at the middle */
		window.currentAddedMarker = L.marker([map.getCenter().lat, map.getCenter().lng]).addTo(window.map)
			.bindPopup(jQuery("#markerTemplate").html()).openPopup();
		window.currentAddedMarker.dragging.disable(); 
		window.currentAddedMarker.dragging.enable();

		window.currentAddedMarker.on('dragend',function(evt){
			$("#curLongFld").val(window.currentAddedMarker.getLatLng().lng);
			$("#curLatFld").val(window.currentAddedMarker.getLatLng().lat);
			console.log("long : "+window.currentAddedMarker.getLatLng().lng);
			console.log("lat : "+window.currentAddedMarker.getLatLng().lat);
		});

		window.markerCollection.push(window.currentAddedMarker);
	}
	function showAllTombs(){
		hideAllMarkers();
		jQuery.ajax({
		  url: '/slot/allTombsJson',
		  type: 'GET',
		  dataType: 'json',
		  complete:function(xhr){
		  	$("#showAllTombsLoading").hide();
		  },
		  beforeSend:function(){
			$("#showAllTombsLoading").show();
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
						.replace("content","<small><a href='/slot/deleteAvailable?tombName="+val.tomb_name+"'>[delete]</a><small>")
					)
		        	window.markerCollection.push(tempmarkerContainer);
		    	});
		        
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    alert('Cant retrieve json data for Slot');
		  }
		});		
	}
	function showAllMarkers() {
		hideAllMarkers();
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
						.replace("content","<small><a href='/slot/deleteAvailable?tombName="+val.tomb_name+"'>[delete]</a><small>")
					)
		        	window.markerCollection.push(tempmarkerContainer);
		    	});
		        
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    alert('Cant retrieve json data for Slot');
		  }
		});
		
	}
	function hideAllMarkers() {
		jQuery.each(window.markerCollection, function(index, val) {
			window.map.removeLayer(val);
		});
		window.markerCollection = [];
	}

</script>
<h1>
	Register Available Lots
</h1>
<hr>
<div class="span6" id="mapContainer">
	<div class="btn-group">
		<button type="button" class="btn btn-default" onclick="showAllTombs()">
			<i class="fa fa-list"></i>
			All Tombs
			<i id='showAllTombsLoading' class="fa fa-spinner fa-spin" style="display: none"></i>
		</button>
		<button type="button" class="btn btn-default" onclick="showAllMarkers()">
			<i class="fa fa-eye"></i>
			Show Available Tombs
			<i id='showAllTombLoading' class="fa fa-spinner fa-spin" style="display: none"></i>
		</button>
		<button type="button" class="btn btn-default" onclick="hideAllMarkers()">
			<i class="fa fa-eye-slash"></i>
			Hide Available Tombs
		</button>
	</div>
	<br>
	<div id="availableMap" style="position: relative; height: 500px;"></div>	
</div>
<div class="span3" id='lotInformationPanel'>
	<h3>
		<span class="header-line"></span> 
		Lot Information
	</h3>
	<?php
	$this->widget('bootstrap.widgets.TbAlert', array(
	    'fade'=>true,
	    'closeText'=>'×',
	    'alerts'=>array(
		    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), 
		    'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), 
		    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), 
	    ),
	)); ?>
	<?php echo CHtml::beginForm(array('/slot/addAvailable'), 'post', array('id'=>"registerAvailableTombForm")); ?>
		<?php echo CHtml::errorSummary($formModel); ?>
		<br>
		<?php echo CHtml::label('Region : ', 'for'); ?>
		<?php 
			echo CHtml::dropDownList(
				'region_name', 
				null, 
				array(
					"Block A"=>"Block A",
					"Block B"=>"Block B",
					"Block C"=>"Block C",
					"Block D"=>"Block D",
					"Block E"=>"Block E",
					"Block F"=>"Block F",
					"Block G"=>"Block G"
				),
				array(
					'prompt'=>'Select Region'
				)
			); 
		?>
		<?php echo CHtml::activeLabel($formModel, 'tombName'); ?>
		<?php echo CHtml::activeTextField($formModel, 'tombName', array('class'=>'e.g BS2')); ?>
		<?php echo CHtml::error($formModel, 'tombName'); ?>
		<button type="button" class="btn btn-default" onclick="addMarker()">
			<i class="fa fa-map-marker"></i>
			Add Marker
		</button>
		<hr>
		<?php echo CHtml::activeHiddenField($formModel, 'tombLong',array('id'=>'curLongFld')); ?>
		<?php echo CHtml::activeHiddenField($formModel, 'tombLat',array('id'=>"curLatFld")); ?>
		<button type="submit" class="btn btn-primary"> 
			<i class="fa fa-save"></i>
			Save
		</button>
	<?php echo CHtml::endForm(); ?>	

</div>
