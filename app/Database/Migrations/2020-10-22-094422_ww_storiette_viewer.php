<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwStorietteViewer extends Migration
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
			'sessionID' => [
				'type'				=> 'BIGINT',
				'constraint'		=> 21,
				'unsigned'       	=> true,
			],
			'created_at'		=> [
				'type'				=> 'DATETIME',
			]
		]);

		$this->forge->addKey('ID', true);
		$this->forge->addKey('userID');
		$this->forge->addKey('storietteID');
		$this->forge->addKey('sessionID');

		$this->forge->addForeignKey('userID', 'ww_users', 'ID', 'CASCADE');
		$this->forge->addForeignKey('storietteID', 'ww_storiette', 'ID', 'CASCADE');
		$this->forge->addForeignKey('sessionID', 'ww_users_session', 'ID', 'CASCADE');

		$this->forge->createTable('ww_storiette_viewer');

		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('ww_storiette_viewer', true);

		$this->db->enableForeignKeyChecks();
	}
}
