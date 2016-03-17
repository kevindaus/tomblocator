<?php 

/**
* SlotController
*/
class SlotController extends Controller
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', 
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('available','search','availableJson'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('allTombsJson','revoke'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('register','location','relocate','addAvailable','move','deleteAvailable'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionDeleteAvailable($tombName)
	{
		$criteria = new CDbCriteria;
		$criteria->compare("tomb_name",$tombName);
		$mdl = TombLocations::model()->find($criteria);
		if ($mdl) {
			if ($mdl->delete()) {
				Yii::app()->user->setFlash("success","Tomb location deleted");
			}else{
				$name = sprintf("%s %s %s",$mdl->tombInformations[0]->person->firstname,$mdl->tombInformations[0]->person->middlename,$mdl->tombInformations[0]->person->lastname);
				$errorMessage = sprintf("Sorry we cant delete this tomb record. %s is occupying the tomb." ,CHtml::link($name, array('person/view','id'=>$mdl->tombInformations[0]->person->id)  ) );
				Yii::app()->user->setFlash("error",$errorMessage);
			}
		}else{
			throw new CHttpException(404,"Either the tomb location is deleted or it doesn't exists in the database");
		}
		$this->redirect(array('slot/addAvailable'));
	}
	public function actionAvailableJson()
	{
		header("Content-Type: application/json");
		/*get all available tombs*/
		$criteria = new CDbCriteria;
		$criteria->compare("status",TombLocations::AVAILABLE);
		$allModels  = TombLocations::model()->findAll($criteria);
		echo CJSON::encode($allModels);
	}
    public function actionAllTombsJson(){
        header("Content-Type: application/json");
        $allTombs = TombLocations::model()->findAll();
        echo CJSON::encode($allTombs);
    }

	public function actionAvailable()
	{
		/*show available tombs*/
		$this->render('available');
	}
	public function actionAddAvailable()
	{
        $formModel = new TombLocRegisterForm();
        if(isset($_POST['TombLocRegisterForm'])) {
            $formModel->setAttributes($_POST['TombLocRegisterForm']);
            if (isset($_POST['region_name'])) {
            	$formModel->tombName = $_POST['region_name'].' '.$formModel->tombName;
            }
            if ($formModel->validate()) {
                $retMessage = $formModel->save();
                if ($retMessage['success']) {
                	Yii::app()->user->setFlash("success",$retMessage['message']);
                	$this->redirect(array('slot/addAvailable'));
                }else{
                	Yii::app()->user->setFlash("error",$retMessage['message']);
                	$this->redirect(array('slot/addAvailable'));
                }
            }
        }
		$this->render('addAvailable',compact('formModel'));
	}
	public function actionSearch()
	{
		$tombResidents = TombInformation::getAllTombResidents();
		$personModelArr = array();
		$locationLongitude = null;
		$locationLatitude = null;
		$fullName = @$_POST['person'];
		$tombName = null;

		if (isset($_POST['person'])) {

			$model = Person::model()->findByPk($_POST['selectedPersonId']);
			if ($model) {
				/*check if in TombLocationLog*/
				$tombLogs = TombInformationLogs::model()->findByAttributes(array("person_id"=>$model->id));
				if ($tombLogs) {
					Yii::app()->user->setFlash("error",sprintf("<strong>%s</strong> has been moved to bone box. Please contact us for further assistance.",$_POST['person']));
				}else{
					$locationLongitude = $model->tombInformations[0]->tombLocation->loc_longitude;
					$locationLatitude = $model->tombInformations[0]->tombLocation->loc_latitude;
					$tombName = $model->tombInformations[0]->tombLocation->tomb_name;

					/*select id of residents located at tomb $tombName*/
					$sqlQuery = '
						select tbl_person.id from tbl_tomb_information
						inner join tbl_person on tbl_person.id = tbl_tomb_information.person_id
						inner join tbl_tomb_locations on tbl_tomb_locations.id = tbl_tomb_information.tomb_location_id
						where tbl_tomb_locations.tomb_name = "'.$tombName.'"
					';
					$allIds = Yii::app()->db->createCommand($sqlQuery)->queryAll();
					foreach ($allIds as $key => $currentId) {
						$personModelArr[] = Person::model()->findByPk($currentId['id']);
					}
				}
			}else{
				Yii::app()->user->setFlash("error","Sorry we cant find that person in our database");
				$this->redirect(array('slot/search'));
			}
		}
		$this->render('search',compact('tombResidents','locationLongitude','locationLatitude','personModelArr','fullName','tombName'));

	}
	public function actionRegister()
	{
		/*allow user to register tomb information*/
        $modelForm = new RegisterTombInfoForm();
        if (isset($_POST['RegisterTombInfoForm'])) {
        	$modelForm->attributes = $_POST['RegisterTombInfoForm'];
        	if (isset($_POST['alternativeTitleField']) && !empty($_POST['alternativeTitleField'])) {
        		$modelForm->person_title = $_POST['alternativeTitleField'];
        	}
            if (
	            	isset($_POST['relativeFirstname']) &&
	            	isset($_POST['relativeLastname']) &&
	            	isset($_POST['relativeMiddlename']) &&
	            	isset($_POST['relativeRelationship']) 
            	){
            	$modelForm->setRelativeInformation( $_POST['relativeFirstname'], $_POST['relativeLastname'], $_POST['relativeMiddlename'],$_POST['relativeRelationship']);
            }
            
            if ($modelForm->validate()) {
                $modelForm->save();
                Yii::app()->user->setFlash('success', '<strong>Saved!</strong> The record has been saved.');
                // $this->redirect("/tomblocator/index.php/slot/register");
            }
        }
		$this->render(
			'register',
			array(
					"model"=>$modelForm
				)
			);
	}
	public function actionLocation()
	{
		$this->render('location');
	}
	public function actionRelocate()
	{
		$this->render('relocate');
	}
	public function actionMove()
	{
		/*show all person in the database*/
		$dataProvider = Person::model()->searchValid();
		/*allow searching*/
		if (isset($_POST['searchKey'])) {
			/*find all markers taken*/
			$criteria = new CDbCriteria;
			$newPerson = new Person();
			$newPerson->firstname = $_POST['searchKey'];
			$newPerson->middlename = $_POST['searchKey'];
			$newPerson->lastname = $_POST['searchKey'];
			$dataProvider = $newPerson->searchValid();
		}
		$dataProvider->pagination = false;
		$this->render('move',compact('dataProvider'));
	}
	public function actionRevoke($personId,$tombName,$notes)
	{
		/*get record by tomb name*/
		$criteria = new CDbCriteria;
		$criteria->compare("tomb_name",$tombName);
		$tombLocationObj = TombLocations::model()->find($criteria);
		$personObject = Person::model()->findByPk($personId);
		if ($tombLocationObj) {
			/*check if tomb resident date_of_death 10 years lapse*/
			$currentYear = date("Y");
			$currentYear = intval($currentYear);
			$dateCreation = date("Y", strtotime($personObject->date_of_death));
			$dateCreation = intval($dateCreation);
			if (  ( $currentYear - $dateCreation) > 10  ) {
				//create log
				$newTombInfoLog = new TombInformationLogs;
				$newTombInfoLog->person_id = $personObject->id;
				$newTombInfoLog->tomb_location_id   = $tombLocationObj->tombInformations[0]->tomb_location_id;
				$newTombInfoLog->notes   = $notes;
				$newTombInfoLog->save();

				/*update to availability*/
				if (count($tombLocationObj->tombInformations) == 0) {
					$tombLocationObj->status = TombLocations::AVAILABLE;
					$tombLocationObj->save();
				}else if (count($tombLocationObj->tombInformations) >= 1) {
					$tombLocationObj->status = TombLocations::TAKEN;
					$tombLocationObj->save();
				}

				/*remove tombinformation record - where id of person is */
				$deleteQueryStr = <<<EOL
delete tbl_tomb_information.* from 
tbl_tomb_information
inner join tbl_person on tbl_person.id = tbl_tomb_information.person_id
where 
tbl_person.id = :person_id and 
tbl_tomb_information.tomb_location_id = :tomb_location_id
EOL;
				$tempPersonIdContainer = $personObject->id;
				$tempTombIdContainer = $tombLocationObj->id;
				$deleteQueryCommand = Yii::app()->db->createCommand($deleteQueryStr);
				$deleteQueryCommand->bindParam(':person_id' , $tempPersonIdContainer,PDO::PARAM_INT);
				$deleteQueryCommand->bindParam(':tomb_location_id',$tempTombIdContainer,PDO::PARAM_INT);
				$deleteQueryCommand->execute();

				// $modelTombInfo = TombInformation::model()->findByPk($tombLocationObj->tombInformations[0]->id);
				// if (!$modelTombInfo->delete()) {
				// 	$newTombInfoLog->delete();
				// }
				//done
				Yii::app()->user->setFlash("success","Tomb resident invoked. Tomb is now available. ");
			}else{
				Yii::app()->user->setFlash("error","Sorry you cant invoke the tomb yet. 10 years hasn't passed yet. ");
			}
		}else{
			Yii::app()->user->setFlash("error","Sorry we cant find that tombname in our database");
		}
		$this->redirect(array('slot/move'));
	}

}