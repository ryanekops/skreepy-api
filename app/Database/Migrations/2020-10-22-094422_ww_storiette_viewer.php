<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwStorietteViewer extends Migration
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
			'session_uniqueID' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200
			],
			'created_at'		=> [
				'type'				=> 'DATETIME',
			]
		]);

		$this->forge->addKey('ID');
		$this->forge->createTable('ww_storiette_viewer');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('ww_storiette_viewer');
	}
}
