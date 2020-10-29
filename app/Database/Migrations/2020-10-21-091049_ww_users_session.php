<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwUsersSession extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'ID'				=> [
				'type'				=> 'BIGINT',
				'constraint' 		=> 21,
				'unsigned'       	=> true,
				'auto_increment' 	=> true
			],
			'userID'			=> [
				'type'				=> 'BIGINT',
				'constraint'		=> 21,
				'unsigned'       	=> true,
			],
			'session_agent'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200,
			],
			'session_ip'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200,
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
			'session_parentID'	=> [
				'type'				=> 'BIGINT',
				'constraint'		=> 21,
				'default'			=> 0
			],
			'session_token'		=> [
				'type'				=> 'VARCHAR',
				'constraint' 		=> 200
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
			'on_date'		=> [
				'type'				=> 'DATETIME',
				'null'           	=> true,
			],
			'off_date'		=> [
				'type'				=> 'DATETIME',
				'null'           	=> true,
			],
			'time_wasting'		=> [
				'type'				=> 'INT',
				'constraint'        => 11,
				'default'			=> 0
			],
		]);

		$this->forge->addKey('ID', true);
		$this->forge->addKey('user_ID');
		$this->forge->addKey('session_parentID');
		$this->forge->addKey('on_date');
		$this->forge->addKey('off_date');
		$this->forge->addKey('session_active');
		$this->forge->addKey('session_type');
		$this->forge->addKey('session_token');

		$this->forge->addForeignKey('userID', 'ww_users', 'ID', 'CASCADE');

		$this->forge->createTable('ww_users_session');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('ww_users_session');

		$this->db->enableForeignKeyChecks();
	}
}
