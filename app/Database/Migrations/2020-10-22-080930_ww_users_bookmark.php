<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwUsersBookmark extends Migration
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
			'storietteID' => [
				'type'				=> 'BIGINT',
				'constraint'		=> 21,
				'unsigned'       	=> true,
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

		$this->forge->addKey('ID', true);
		$this->forge->addKey('userID');
		$this->forge->addKey('storietteID');
		$this->forge->addKey('deleted_at');

		$this->forge->addForeignKey('userID', 'ww_users', 'ID', 'CASCADE');
		$this->forge->addForeignKey('storietteID', 'ww_storiette', 'ID', 'CASCADE');

		$this->forge->createTable('ww_users_bookmark');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('ww_users_bookmark', true);

		$this->db->enableForeignKeyChecks();
	}
}
