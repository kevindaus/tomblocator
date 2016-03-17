<?php

class m151009_214211_create_tomb_information_logs extends CDbMigration
{
	public function up()
	{
        $this->createTable("tbl_tomb_information_logs", array(
            "id"=>"pk",
            "person_id"=>"integer",
            "tomb_location_id"=>"integer",
            "notes"=>"string",
            "date_record_created"=>"datetime",
            "date_record_updated"=>"datetime"
        ));
	}

	public function down()
	{
        $this->dropTable("tbl_tomb_information_logs");
	}

}