<?php

/**
 * This is the model class for table "tbl_tomb_locations".
 *
 * The followings are the available columns in table 'tbl_tomb_locations':
 * @property integer $id
 * @property string $tomb_name
 * @property string $status
 * @property string $loc_latitude
 * @property string $loc_longitude
 * @property string $date_record_created
 * @property string $date_record_updated
 *
 * The followings are the available model relations:
 * @property TombInformation[] $tombInformations
 */
class TombLocations extends CActiveRecord
{
    const AVAILABLE = "available";
    const TAKEN = "taken";

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_tomb_locations';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tomb_name, status, loc_latitude, loc_longitude', 'required'),
            array('tomb_name, status, loc_latitude, loc_longitude', 'length', 'max' => 255),
            array('date_record_created, date_record_updated', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tomb_name, status, loc_latitude, loc_longitude, date_record_created, date_record_updated', 'safe', 'on' => 'search'),
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
            'tombInformations' => array(self::HAS_MANY, 'TombInformation', 'tomb_location_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'tomb_name' => 'Tomb Name',
            'status' => 'Status',
            'loc_latitude' => 'Loc Latitude',
            'loc_longitude' => 'Loc Longitude',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('tomb_name', $this->tomb_name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('loc_latitude', $this->loc_latitude, true);
        $criteria->compare('loc_longitude', $this->loc_longitude, true);
        $criteria->compare('date_record_created', $this->date_record_created, true);
        $criteria->compare('date_record_updated', $this->date_record_updated, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TombLocations the static model class
     */
    public static function model($className = __CLASS__)
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
    public function beforeDelete()
    {
        /*check if someone is residing at the tomb*/
        if (isset($this->tombInformations) && isset($this->tombInformations[0]) && isset($this->tombInformations[0]->person) ) {
            return false;
        }

        return true;
    }


}
