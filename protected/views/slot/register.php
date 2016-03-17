<?php 
/* @var $this SlotController */
/* @var $model RegisterTombInfoForm */
$baseUrl = Yii::app()->theme->baseUrl; 
$bowerComponentUrl  = $baseUrl.'/bower_components/';
Yii::app()->clientScript->registerScriptFile($bowerComponentUrl.'angular/angular.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/registerApp.js', CClientScript::POS_END);



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


$initialrelatives = json_encode($model->relatives);
Yii::app()->clientScript->registerScript('initialrelatives', 'window.initialrelatives = 	'.$initialrelatives
	, CClientScript::POS_HEAD);



/*show all tomb*/

?>



<script type="text/template" id="markerTemplate">
	<b>Drag and drop the marker</b>
	<br />
	Find the location of the tomb 
</script>
<script type="text/template" id="showSingleMarkertemplate">
	<center><strong><b>title</b></strong></center>
	<hr style="margin: 0px">
	<button type="submit" class="btn btn-primary"><i class="fa fa-map-marker"></i> Select</button>
</script>
<script type="text/javascript">
  window.markerCollection = [];

  function showAvailableMarkers(){
  	hideAllMarkers();
    jQuery.ajax({
      url: '/slot/availableJson',
      type: 'GET',
      dataType: 'json',
      complete:function(xhr){
        $("#showAvailableTombLoading").hide();
      },
      beforeSend:function(){
        $("#showAvailableTombLoading").show();
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
	          );
	          tempmarkerContainer.on('click',function(evt){
				$("#RegisterTombInfoForm_tomb_location_longitude").val(val.loc_longitude);
				$("#RegisterTombInfoForm_tomb_location_latitude").val(val.loc_latitude);
			  })
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
		  url: '/slot/allTombsJson',
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
		          );
		          tempmarkerContainer.on('click',function(evt){
					$("#RegisterTombInfoForm_tomb_location_longitude").val(val.loc_longitude);
					$("#RegisterTombInfoForm_tomb_location_latitude").val(val.loc_latitude);
				  })
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
	function person_title_changed(currentElement){
		console.log(currentElement.value);
		if (currentElement.value == 'Other') {
			// currentElement.style.display = "none";
			jQuery("#alternativeTitleField").css({"display":"block"});
		}else{
			jQuery("#alternativeTitleField").css({"display":"none"});
			// currentElement.style.display = "block";
		}
	}


</script>



<div ng-app="registerRelatives">
	<div ng-controller="RegisterCtrl as regCtrl">
		<?php 
		$this->widget('bootstrap.widgets.TbAlert', array(
		    'fade'=>true, 
		    'closeText'=>'×', 
		    'alerts'=>array( 
			    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), 
		    ),
		)); ?>
		<h1 class="header">Register Tomb Information
		<span class="header-line"></span> 
		</h1>
		<?php
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'horizontalForm',
		)); ?>
		<fieldset>
			<div class="row">
				<div class="span9">
				    <legend>Personal Information</legend>
				    <?php echo $form->labelEx($model,'person_title')?>
				    <?php echo CHtml::activeDropDownList($model, 'person_title', array("Mr"=>"Mr","Ms"=>"Ms","Mrs"=>"Mrs","Other"=>"Other *specify below"),array('prompt'=>"Select title",'onchange'=>"person_title_changed(this)")); ?>
				    <?php echo CHtml::textField('alternativeTitleField', null, array('placeholder'=>'Other title','id'=>'alternativeTitleField','style'=>"display:none")); ?>
				    <?php echo $form->error($model,'person_title'); ?>

				    <?php echo $form->labelEx($model,'person_firstname')?>
				    <?php echo $form->textField($model, 'person_firstname'); ?>
				    <?php echo $form->error($model,'person_firstname'); ?>
				    <?php echo $form->labelEx($model,'person_middlename')?>
				    <?php echo $form->textField($model, 'person_middlename'); ?>
				    <?php echo $form->error($model,'person_middlename'); ?>
				    <?php echo $form->labelEx($model,'person_lastname')?>
				    <?php echo $form->textField($model, 'person_lastname'); ?>
				    <?php echo $form->error($model,'person_lastname'); ?>
				    <?php echo $form->labelEx($model,'gender')?>
				    <?php echo CHtml::activeDropDownList($model, 'gender', array('male'=>'Male','female'=>'Female'),array('prompt'=>'Gender')); ?>
				    <?php echo $form->error($model,'gender'); ?>
				    <?php echo $form->labelEx($model,'person_date_of_birth')?>
					<?php 
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
							'model'=>$model,
							'attribute'=>'person_date_of_birth',
							'options'=>array(
							  'showAnim'=>'fold',
							  'changeMonth'=>true,
							  'changeYear'=>true,
							  'yearRange'=>'-150:+0',
							),
							'htmlOptions'=>array(
								'placeholder'=>"mm/dd/yyyy"
							)
						));
					?>

				    <?php echo $form->error($model,'person_date_of_birth'); ?>
			    </div>
		    </div>
		    <div class="row">
		    	<div class="span9">
				    <legend>Address Information</legend>
				    <?php echo $form->labelEx($model,'person_street')?>
				    <?php echo $form->textField($model, 'person_street'); ?>
				    <?php echo $form->error($model,'person_street'); ?>
				    <?php echo $form->labelEx($model,'person_province')?>
				    <?php echo $form->textField($model, 'person_province'); ?>
				    <?php echo $form->error($model,'person_province'); ?>
				    <?php echo $form->labelEx($model,'person_country')?>
				    <?php echo $form->textField($model, 'person_country'); ?>
				    <?php echo $form->error($model,'person_country'); ?>
				    <?php echo $form->labelEx($model,'person_zipcode')?>
				    <?php echo $form->textField($model, 'person_zipcode'); ?>
				    <?php echo $form->error($model,'person_zipcode'); ?>
		    	</div>
		    </div>
		    <div class="row">
		    	<div class="span9">
				    <legend>Employment Information</legend>
				    <?php echo $form->labelEx($model,'person_occupation')?>
				    <?php echo $form->textField($model, 'person_occupation'); ?>
				    <?php echo $form->error($model,'person_occupation'); ?>
				    <?php echo $form->labelEx($model,'person_employment_company')?>
				    <?php echo $form->textField($model, 'person_employment_company'); ?>
				    <?php echo $form->error($model,'person_employment_company'); ?>
		    	</div>
		    </div>
		    <div class="row">
		    	<div class="span9">
				    <legend>Other Information</legend>
				    <?php echo $form->labelEx($model,'person_height')?>
				    <?php echo $form->textField($model, 'person_height',array('placeholder'=>'cm')); ?>
				    <?php echo $form->error($model,'person_height'); ?>
				    <?php echo $form->labelEx($model,'person_weight')?>
				    <?php echo $form->textField($model, 'person_weight',array('placeholder'=>'kg')); ?>
				    <?php echo $form->error($model,'person_weight'); ?>
		    	</div>	
		    </div>
		    <div class="row">
		    	<div class="span9">
				    <legend>Death Information</legend>
				    <?php echo $form->labelEx($model,'person_cause_of_death')?>
				    <?php echo $form->textField($model, 'person_cause_of_death'); ?>
				    <?php echo $form->error($model,'person_cause_of_death'); ?>
				    <?php echo $form->labelEx($model,'person_date_of_death')?>
					<?php 
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
							'model'=>$model,
							'attribute'=>'person_date_of_death',
							'options'=>array(
							  'showAnim'=>'fold',
							  'changeMonth'=>true,
							  'changeYear'=>true,
							  'yearRange'=>'-150:+0',
							),
							'htmlOptions'=>array(
								'placeholder'=>"mm/dd/yyyy"
							)
						));
					?>
				    <?php echo $form->error($model,'person_date_of_death'); ?>
		    	</div>
		    </div>
			<div class="row" ng-show="false" ng-cloak>
				<div class="span9">
					<legend>Relatives</legend>
					<ul style='list-style: none'>
						<li ng-repeat="(key, value) in relatives">
							<input type="text" ng-model="value.relativeFirstName" name="relativeFirstname[]"  placeholder='Firstname' style="width: 180px;">
							<input type="text" ng-model="value.relativeMiddleName" name="relativeMiddlename[]" placeholder='Middlename' style="width: 180px;">
							<input type="text" ng-model="value.relativeLastname" name="relativeLastname[]"  placeholder='Lastname' style="width: 180px;">
							<input type="text" ng-model="value.relativeRelationship" name="relativeRelationship[]"  placeholder='Relationship' style="width: 180px;">
							<a href="" ng-click="regCtrl.removeRelative(key)">remove</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row" ng-show="false" ng-cloak>
				<div class="span9">
					<button type="button" class="btn btn-info" style="margin-left: 20px" ng-click="regCtrl.addRelative()">
						<i class="fa fa-plus-circle"></i>
						Add relative
					</button>
				</div>
			</div>
			<div class="row">
				<div class="span9">
			      	<h3 class="header">Select Tomb
			        	<span class="header-line"></span> 
			        </h3>
			        <div class="btn-group">
			        	<button type="button" class="btn btn-default" onclick="showAllMarkers()">
				        	<span class=' icon-th-list'></span>
							Show All Tombs
							<i id='showAllTombLoading' class="fa fa-spinner fa-spin" style="display: none"></i>
			        	</button>			        	
			        	<button type="button" class="btn btn-default" onclick="showAvailableMarkers()">
				        	<i class="fa fa-eye"></i>
							Show Available Tombs
							<i id='showAvailableTombLoading' class="fa fa-spinner fa-spin" style="display: none"></i>
			        	</button>
			        	<button type="button" class="btn btn-default"   onclick="hideAllMarkers()">
				        	<i class="fa fa-eye-slash"></i>
							Hide Available Tombs
			        	</button>
			        </div>
					<br>
		        	<div id="availableMap" style="position: relative; height: 500px;"></div>
					<!-- @TODO - load leaflet  -->
					<?php echo $form->hiddenField($model, 'tomb_location_latitude'); ?>
					<?php echo $form->hiddenField($model, 'tomb_location_longitude'); ?>
				</div>
			</div>	    
		</fieldset>

		
		 
		<?php $this->endWidget(); ?>
	</div>
</div>