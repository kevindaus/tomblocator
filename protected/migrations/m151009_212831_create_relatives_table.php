<?php

class m151009_212831_create_relatives_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("tbl_relatives",array(
				"id"=>'pk',
				"firstname"=>'string not null',
				"middlename"=>'string',
				"lastname"=>'string not null',
				"relationship"=>'string not null',//["mother","brother"]
				"date_record_created"=>'datetime',
				"date_record_updated"=>'datetime'
			));
	}

	public function down()
	{
		$this->dropTable("tbl_relatives");
	}

}