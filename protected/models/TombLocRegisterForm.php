<?php


class TombLocRegisterForm extends CFormModel{
    public $tombName;
    public $tombLat;
    public $tombLong;


    public function rules()
    {
        return array(
            array('tombName', 'required'),
            array('tombLong,', 'hasLocation'),
            array('tombLat', 'safe'),
        );
    }
    public function hasLocation($attrib,$params)
    {
        $verdict = true;

        if (  empty($this->tombLat) || empty($this->tombLong)) {
            $verdict = false;
            $this->addError($attrib,"You forgot to add the location of the tomb.");
        }
        return $verdict;
    }
    public function attributeLabels()
    {
        return array(
            "tombName"=>"Tomb Name",
            "tombLat"=>"Latitude",
            "tombLong"=>"Longitude",
        );
    }

    public function save()
    {
        $resMessage = array("success"=>false,"message"=>"");
        $criteria = new CDbCriteria();
        $criteria->compare("tomb_name", $this->tombName);
        $model = TombLocations::model()->find($criteria);
        if ($model) {
            /*update the tombname and long lat*/
            $model->tomb_name = $this->tombName;
            $model->loc_latitude  = $this->tombLat;
            $model->loc_longitude = $this->tombLong;
            $model->status = TombLocations::AVAILABLE;
            if ($model->save()) {
                $resMessage = array("success"=>true,"message"=>"<strong>Success!</strong> Tomb information updated");
            }else{
                $resMessage = array("success"=>false,"message"=>"Cant update tomb information.");
            }
        }else{
            $model = new TombLocations();
            $model->tomb_name = $this->tombName;
            $model->loc_latitude  = $this->tombLat;
            $model->loc_longitude = $this->tombLong;
            $model->status = TombLocations::AVAILABLE;
            if ($model->save()) {
                $resMessage = array("success"=>true,"message"=>"<strong>Success!</strong> New Tomb saved");
            }else{
                $resMessage = array("success"=>false,"message"=>"Cant save new tomb.");
            }
        }
        return $resMessage;
    }


}