<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwWallskreepTagsRelationship extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'objectID'				=> [
				'type'				=> 'BIGINT',
				'constraint' 		=> 21,
				'unsigned'       	=> true,
				'auto_increment' 	=> true
			],
			'wallskreepID'			=> [
				'type'				=> 'BIGINT',
				'constraint'		=> 21,
				'unsigned'       	=> true,
			],
			'tagID'					=> [
				'type'				=> 'BIGINT',
				'constraint'		=> 21,
				'unsigned'       	=> true,
			]
		]);

		$this->forge->addKey('objectID', true);
		$this->forge->addKey('tagID');
		$this->forge->addKey('wallskreepID');

		$this->forge->addForeignKey('tagID', 'ww_wallskreep_tags', 'ID', 'CASCADE');
		$this->forge->addForeignKey('wallskreepID', 'ww_wallskreep', 'ID', 'CASCADE');

		$this->forge->createTable('ww_wallskreep_tags_relationship');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('ww_wallskreep_tags_relationship', true);

		$this->db->enableForeignKeyChecks();
	}
}
