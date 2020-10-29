<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwWallskreepTags extends Migration
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
			'tag'				=> [
				'type'				=> 'CHAR',
				'constraint'		=> 50,
				'unique'         	=> true
			]
		]);

		$this->forge->addKey('ID', true);

		$this->forge->createTable('ww_wallskreep_tags');
	}

	public function down()
	{
		$this->forge->dropTable('ww_wallskreep_tags', true);
	}
}
