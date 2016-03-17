<?php

class m151009_213802_create_tomb_locations_table extends CDbMigration
{
	public function up()
	{
        $this->createTable("tbl_tomb_locations", array(
            "id"=>"pk",
            "tomb_name"=>"string not null",
            "status"=>"string not null default 'available' ",
            "loc_latitude"=>"string not null",
            "loc_longitude"=>"string not null",
            "date_record_created"=>"datetime",
            "date_record_updated"=>"datetime",
        ));
	}

	public function down()
	{
        $this->dropTable("tbl_tomb_locations");
	}

}