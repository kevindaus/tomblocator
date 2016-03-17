<?php

class m151009_213128_create_person_relative_table extends CDbMigration
{
	public function up()
	{
        $this->createTable("tbl_person_relative", array(
            "id"=>"pk",
            "person_id"=>"integer",
            "relative_id"=>"integer",
            "date_record_created"=>"datetime",
            "date_record_updated"=>"datetime",
        ));
        $this->addForeignKey("person_relative_fk", "tbl_person_relative", "person_id", "tbl_person", "id","CASCADE","CASCADE");
	}

	public function down()
	{
        $this->dropForeignKey("person_relative_fk", "tbl_person_relative");
        $this->dropTable("tbl_person_relative");
	}

}