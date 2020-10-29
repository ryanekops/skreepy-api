<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwWallskreepLikes extends Migration
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
			'userID'					=> [
				'type'				=> 'BIGINT',
				'constraint'		=> 21,
				'unsigned'       	=> true,
			],
			'wallskreepID'			=> [
				'type'				=> 'BIGINT',
				'constraint'		=> 21,
				'unsigned'       	=> true,
			],
			'status'				=> [
				'type'				=> 'TINYINT',
				'constraint'		=> 1,
				'default'       	=> 0,
			]
		]);

		$this->forge->addKey('ID', true);
		$this->forge->addKey('userID');
		$this->forge->addKey('wallskreepID');
		$this->forge->addKey('status');

		$this->forge->addForeignKey('userID', 'ww_users', 'ID', 'CASCADE');
		$this->forge->addForeignKey('wallskreepID', 'ww_wallskreep', 'ID', 'CASCADE');

		$this->forge->createTable('ww_wallskreep_likes');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('ww_wallskreep_likes', true);

		$this->db->enableForeignKeyChecks();
	}
}
