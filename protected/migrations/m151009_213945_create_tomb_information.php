<?php

class m151009_213945_create_tomb_information extends CDbMigration
{
	public function up()
	{
        $this->createTable("tbl_tomb_information", array(
            "id"=>"pk",
            "person_id"=>"integer",
            "tomb_location_id"=>"integer",
            "date_record_created"=>"datetime",
            "date_record_updated"=>"datetime"
        ));
	}

	public function down()
	{
        $this->dropTable("tbl_tomb_information");
	}


}