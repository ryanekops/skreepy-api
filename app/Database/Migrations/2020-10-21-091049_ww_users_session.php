<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwUsersSession extends Migration
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
			'user_uniqueID'			=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200
			],
			'session_agent'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200,
			],
			'device_os'			=> [
				'type'				=> 'CHAR',
				'constraint'		=> 50,
			],
			'device_name'			=> [
				'type'				=> 'CHAR',
				'constraint'		=> 50,
			],
			'device_uuid'			=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200,
			],
			'session_unique_ID'	=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200,
				'null'           	=> true,
			],
			'session_type'		=> [
				'type'				=> 'TINYINT',
				'constraint' 		=> 1
			],
			'session_active'		=> [
				'type'				=> 'TINYINT',
				'constraint' 		=> 1,
				'default'			=> 1
			],
			'signup_date'		=> [
				'type'				=> 'DATETIME',
				'null'           	=> true,
			],
			'signout_date'		=> [
				'type'				=> 'DATETIME',
				'null'           	=> true,
			],
			'time_wasting'		=> [
				'type'				=> 'INT',
				'constraint'        => 11,
				'default'			=> 0
			],
		]);

		$this->forge->addKey('ID');
		$this->forge->createTable('ww_users_session');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('ww_users_session');
	}
}
