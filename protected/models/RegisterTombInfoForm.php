<?php

/**
 * Class RegisterTombInfoForm
 * @property int $person_id The id of person  , will only have only after saving the person information
 */
class RegisterTombInfoForm extends CFormModel
{
    public $person_id;
    public $person_title;
    public $person_firstname;
    public $person_middlename;
    public $person_lastname;
    public $gender;
    public $person_street;
    public $person_province = "Nueva Vizcaya";
    public $person_country = "Philippines";
    public $person_zipcode = "3709";
    public $person_occupation;
    public $person_employment_company;
    public $person_height;
    public $person_weight;
    public $person_cause_of_death;
    public $person_date_of_birth;
    public $person_date_of_death;
    public $relatives = [];
    public $tomb_location_latitude;
    public $tomb_location_longitude;


    public function rules()
    {
        return array(
            array('person_title,gender,person_firstname,person_lastname,person_street,person_province,person_country,person_zipcode,person_cause_of_death,person_date_of_birth,person_date_of_death,tomb_location_latitude,tomb_location_longitude', 'required'),
            array('person_title,gender,person_firstname,person_lastname', 'nonDigit'),
            array('person_middlename,person_employment_company,person_occupation,person_height,person_weight', 'safe'),
        );
    }
    public function attributeLabels()
    {
        return array(
            "person_firstname" => "Firstname",
            "person_middlename" => "Middlename",
            "person_lastname" => "Lastname",
            "person_street" => "Street name and number ",
            "person_province" => "Province",
            "person_country" => "Country",
            "person_zipcode" => "Zipcode",
            "person_occupation" => "Occupation",
            "person_employment_company" => "Company (employment)",
            "person_height" => "Height",
            "person_weight" => "Weight",
            "person_cause_of_death" => "Cause of death",
            "person_date_of_birth" => "Date of birth",
            "person_date_of_death" => "Date of death",
            "tomb_location_latitude" => "Location latitude",
            "tomb_location_longitude" => "Location longitude"
        );
    }
    public function nonDigit($attrib , $params)
    {
        $verdict = true;
        if (preg_match("/\d+/", $this->$attrib)) {
            //number detected
            $this->addError($attrib , "Invalid character detected. Please remove number character.");
            $verdict = false;
        }
        return $verdict;
    }
    public function savePersonInformation()
    {
        $newPerson = new Person();
        $newPerson->firstname = $this->person_firstname;
        $newPerson->middlename = $this->person_middlename;
        $newPerson->lastname = $this->person_lastname;
        $newPerson->gender = $this->gender;
        $newPerson->date_of_birth = $this->formatDate($this->person_date_of_birth);
        $newPerson->street = $this->person_street;
        $newPerson->province = $this->person_province;
        $newPerson->country = $this->person_country;
        $newPerson->zipcode = $this->person_zipcode;
        $newPerson->occupation = $this->person_occupation;
        $newPerson->employment_company = $this->person_employment_company;
        $newPerson->height = $this->person_height;
        $newPerson->weight = $this->person_weight;
        $newPerson->cause_of_death = $this->person_cause_of_death;
        $newPerson->date_of_death = $this->formatDate($this->person_date_of_death);
        if (!$newPerson->save()) {
            throw new Exception(CHtml::errorSummary($newPerson));
        } else {
            $this->person_id = $newPerson->id;
        }
    }

    private function formatDate($rawDate)
    {
        return date("Y-m-d H:i:s", strtotime($rawDate));
    }

    /**
     *
     * After saving Person
     */
    public function saveRelativesInformation()
    {
        if (count($this->relatives) !== 0) {
            $relativesObjCollection = [];
            /*iterate relatives*/
            foreach ($this->relatives as $currentRelative) {
                $curRelative = new Relatives();
                $curRelative->firstname = $currentRelative["relativeFirstName"];
                $curRelative->middlename = $currentRelative["relativeMiddleName"];
                $curRelative->lastname = $currentRelative["relativeLastname"];
                $curRelative->relationship =$currentRelative["relativeRelationship"];
                $curRelative->save();/*save relative*/
                /*create person_relative*/
                $personRelativeObj = new PersonRelative();
                $personRelativeObj->person_id = $this->person_id;
                $personRelativeObj->relative_id = $curRelative->id;
                $personRelativeObj->save();/*save person_relative*/
            }
        }
    }

    /**
     * After saving relatives and person
     */
    public function saveTombInformation()
    {
        /**
         * @var TombLocations $tombLocation
         */
        //find tomb location
        $criteria = new CDbCriteria();
        $criteria->compare("loc_longitude",$this->tomb_location_longitude);
        $criteria->compare("loc_latitude",$this->tomb_location_latitude);
        $tombLocation = TombLocations::model()->find($criteria);
        if ($tombLocation) {
            $tombLocation->status = TombLocations::TAKEN;
            $tombLocation->save();
            //create tomb information
            $tombInformation = new TombInformation();
            $tombInformation->person_id = $this->person_id;
            $tombInformation->tomb_location_id = $tombLocation->id;
            if (!$tombInformation->save()) {
                //save tomb information using person id and tomb location id
                throw new Exception("Cant find Location of the Tomb.".CHtml::errorSummary($tombInformation));
            }
        }else{
            throw new Exception("Cant find Location of the Tomb.");
        }
    }

    public function save()
    {
        $this->savePersonInformation();
        $this->saveRelativesInformation();
        $this->saveTombInformation();
    }

    /**
     * @param array $relativeFirstname
     * @param array $relativeLastname
     * @param array $relativeMiddlename
     * @param $relationshipToMain
     */
    public function setRelativeInformation($relativeFirstname, $relativeLastname, $relativeMiddlename,$relationshipToMain)
    {
        foreach ($relativeFirstname as $key => $value) {
            $this->relatives[] = array(
                "relativeFirstName"=>$relativeFirstname[$key],
                "relativeMiddleName"=>$relativeMiddlename[$key],
                "relativeLastname"=>$relativeLastname[$key],
                "relativeRelationship"=>$relationshipToMain[$key]
            );            
        }

    }

} 