<?php

/**
 * This is the model class for table "tbl_tomb_information_logs".
 *
 * The followings are the available columns in table 'tbl_tomb_information_logs':
 * @property integer $id
 * @property integer $person_id
 * @property integer $tomb_location_id
 * @property string $notes
 * @property string $date_record_created
 * @property string $date_record_updated
 *
 * The followings are the available model relations:
 * @property Person $person
 */
class TombInformationLogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_tomb_information_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('person_id, tomb_location_id', 'numerical', 'integerOnly'=>true),
			array('notes', 'length', 'max'=>255),
			array('date_record_created, date_record_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, person_id, tomb_location_id, notes, date_record_created, date_record_updated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'person' => array(self::BELONGS_TO, 'Person', 'person_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'person_id' => 'Person',
			'tomb_location_id' => 'Tomb Location',
			'notes' => 'Notes',
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
		$criteria->compare('person_id',$this->person_id);
		$criteria->compare('tomb_location_id',$this->tomb_location_id);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('date_record_created',$this->date_record_created,true);
		$criteria->compare('date_record_updated',$this->date_record_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TombInformationLogs the static model class
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
}
