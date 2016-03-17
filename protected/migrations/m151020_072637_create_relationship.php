<?php

class m151020_072637_create_relationship extends CDbMigration
{
    public function safeUp()
    {
        $this->addForeignKey("tombInfo_tombLoc_fk", "tbl_tomb_information", "tomb_location_id", "tbl_tomb_locations", "id", "CASCADE", "CASCADE");

        $this->addForeignKey("tombInfo_person_fk", "tbl_tomb_information", "person_id", "tbl_person", "id", "CASCADE", "CASCADE");

        $this->addForeignKey("tomb_info_logs_fk", "tbl_tomb_information_logs", "person_id", "tbl_person", "id", "CASCADE", "CASCADE");

        $this->addForeignKey("tomb_person_relative_person_fk","tbl_person_relative","person_id","tbl_person","id","CASCADE","CASCADE");

        $this->addForeignKey("tomb_person_relative_relative_fk","tbl_person_relative","relative_id","tbl_relatives","id","CASCADE","CASCADE");
    }


	public function safeDown()
	{
        $this->dropForeignKey("tombInfo_tombLoc_fk", "tbl_tomb_information");

        $this->dropForeignKey("tombInfo_person_fk", "tbl_tomb_information");

        $this->dropForeignKey("tomb_info_logs_fk", "tbl_tomb_information_logs");

        $this->dropForeignKey("tomb_person_relative_person_fk", "tbl_person_relative");

        $this->dropForeignKey("tomb_person_relative_relative_fk", "tbl_person_relative");
	}

};