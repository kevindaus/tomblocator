<?php

class m151022_151803_add_gender_column_person_table extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn("tbl_person", "gender", "string");
	}

	public function safeDown()
	{
        $this->dropColumn("tbl_person", "gender");
	}
}