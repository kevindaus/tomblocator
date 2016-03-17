<?php

class m151009_212118_create_person_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("tbl_person",array(
				'id'=>'pk',
				'firstname'=>'string not null',
				'middlename'=>'string',
				'lastname'=>'string not null',
				'street'=>'string not null',
				'province'=>'string not null',
				'country'=>'string not null',
				'zipcode'=>'string not null',
				'occupation'=>'string not null',
				'employment_company'=>'string not null',
				'height'=>'string not null',
				'weight'=>'string not null',
				'cause_of_death'=>'string not null',
				'date_of_birth'=>'datetime',
				'date_of_death'=>'datetime',
				'date_record_created'=>'datetime',
				'date_record_updated'=>'datetime'
			));
	}
	public function down()
	{
		$this->dropTable("tbl_person");
	}
}