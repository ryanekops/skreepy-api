<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwUsersBookmark extends Migration
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
			'storiette_uniqueID' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200
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
		$this->forge->createTable('ww_users_bookmark');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('ww_users_bookmark');
	}
}
