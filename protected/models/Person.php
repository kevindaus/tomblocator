<?php

/**
 * This is the model class for table "tbl_person".
 *
 * The followings are the available columns in table 'tbl_person':
 * @property integer $id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $gender
 * @property string $street
 * @property string $province
 * @property string $country
 * @property string $zipcode
 * @property string $occupation
 * @property string $employment_company
 * @property string $height
 * @property string $weight
 * @property string $cause_of_death
 * @property string $date_of_birth
 * @property string $date_of_death
 * @property string $date_record_created
 * @property string $date_record_updated
 *
 * The followings are the available model relations:
 * @property PersonRelative[] $personRelatives
 * @property TombInformation[] $tombInformations
 * @property TombInformationLogs[] $tombInformationLogs
 */
class Person extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, street, province, country, zipcode,gender ,cause_of_death', 'required'),
			array('firstname, middlename, lastname, street, province, country, zipcode, occupation, employment_company, height, weight, cause_of_death', 'length', 'max'=>255),
			array('height, weight,occupation, employment_company , date_of_birth, date_of_death, date_record_created, date_record_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, firstname, middlename, lastname, street, province, country, zipcode, occupation, employment_company, height, weight, cause_of_death, date_of_birth, date_of_death, date_record_created, date_record_updated', 'safe', 'on'=>'search'),
		);
	}
	public function nonDigit($attrib , $params)
	{
		$this->addError($attrib , "Invalid character detected. ");
		$verdict = false;
		// if (preg_match("/\d+/", $model->$attrib)) {
		// 	//number detected
		// 	$this->addError($attrib , "Invalid character detected. ");
		// 	$verdict = false;
		// }
		return $verdict;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'personRelatives' => array(self::HAS_MANY, 'PersonRelative', 'person_id'),
			'tombInformations' => array(self::HAS_MANY, 'TombInformation', 'person_id'),
			'tombInformationLogs' => array(self::HAS_MANY, 'TombInformationLogs', 'person_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstname' => 'Firstname',
			'middlename' => 'Middlename',
			'lastname' => 'Lastname',
			'gender' => 'Gender',
			'street' => 'Street',
			'province' => 'Province',
			'country' => 'Country',
			'zipcode' => 'Zipcode',
			'occupation' => 'Occupation',
			'employment_company' => 'Employment Company',
			'height' => 'Height',
			'weight' => 'Weight',
			'cause_of_death' => 'Cause Of Death',
			'date_of_birth' => 'Date Of Birth',
			'date_of_death' => 'Date Of Death',
			'date_record_created' => 'Date Record Created',
			'date_record_updated' => 'Date Record Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('middlename',$this->middlename,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('employment_company',$this->employment_company,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('weight',$this->weight,true);
		$criteria->compare('cause_of_death',$this->cause_of_death,true);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('date_of_death',$this->date_of_death,true);
		$criteria->compare('date_record_created',$this->date_record_created,true);
		$criteria->compare('date_record_updated',$this->date_record_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchValid()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('firstname',$this->firstname,true,'OR');
		$criteria->compare('middlename',$this->middlename,true,'OR');
		$criteria->compare('lastname',$this->lastname,true,'OR');
		$criteria->join = "INNER JOIN tbl_tomb_information ON (`tbl_tomb_information`.`person_id` = `t`.`id`)";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Person the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'date_record_created',
                'updateAttribute' => 'date_record_updated',
            )
        );
    }
    public function getRelatives()
    {
        /**
         * @var PersonRelative $currentPersonRelative
         */
        $relativesCollection = array();
        foreach ($this->personRelatives as $currentPersonRelative) {
            $relativesCollection = $currentPersonRelative->relative;
        }
        return $relativesCollection;
    }
}
