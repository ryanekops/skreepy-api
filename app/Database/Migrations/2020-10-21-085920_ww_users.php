<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwUsers extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ID'				=> [
				'type'				=> 'BIGINT',
				'constraint' 		=> 21,
				'unsigned'       	=> true,
				'auto_increment' 	=> true
			],
			'uniqueID'			=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200,
				'unique'         	=> true,
			],
			'user_name'			=> [
				'type'				=> 'CHAR',
				'constraint'		=> 50
			],
			'user_email'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 100,
				'unique'         	=> true,
			],
			'user_photo'		=> [
				'type'				=> 'TEXT',
				'null'           	=> true,
			],
			'user_registered'	=> [
				'type'				=> 'DATETIME'
			],
			'user_token'		=> [
				'type'				=> 'VARCHAR',
				'constraint' 		=> 1000,
				'unique'         	=> true,
			],
			'user_fcm'			=> [
				'type'				=> 'VARCHAR',
				'constraint' 		=> 1000,
				'null'           	=> true,
			],
			'email_verified'	=> [
				'type'				=> 'ENUM',
				'constraint' 		=> ['true', 'false'],
				'default'			=> 'false'
			],
			'display_name'		=> [
				'type'				=> 'CHAR',
				'constraint'		=> 50
			],
			'created_at'		=> [
				'type'				=> 'DATETIME',
			],
			'updated_at'		=> [
				'type'				=> 'DATETIME',
				'null'           	=> true,
			],
			'deleted_at'		=> [
				'type'				=> 'DATETIME',
				'null'           	=> true,
			],
		]);

		$this->forge->addKey('ID');
		$this->forge->createTable('ww_users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('ww_users');
	}
}
