<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwWallskreep extends Migration
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
			'wall_content'		=> [
				'type'				=> 'TEXT',
			],
			'wall_status'		=> [
				'type'				=> 'CHAR',
				'constraint'		=> 20,
				'default'			=> 'publish'
			],
			'wall_password'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 255,
				'default'			=> ''
			],
			'wall_parentID'	=> [
				'type'				=> 'BIGINT',
				'constraint'		=> 21,
				'default'			=> 0
			],
			'tagging'			=> [
				'type'				=> 'VARCHAR',
				'constraint' 		=> 500,
			],
			'comment_count'		=> [
				'type'				=> 'INT',
				'constraint' 		=> 11,
				'default'			=> 0
			],
			'like_count'		=> [
				'type'				=> 'INT',
				'constraint' 		=> 11,
				'default'			=> 0
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
		$this->forge->addKey('tagging');
		$this->forge->addKey('wall_parentID');
		$this->forge->addKey('userID');
		$this->forge->addKey('wall_status');
		$this->forge->addKey('deleted_at');

		$this->forge->addForeignKey('userID', 'ww_users', 'ID', 'CASCADE');

		$this->forge->createTable('ww_wallskreep');

		$this->db->enableForeignKeyChecks();
	}


	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('ww_wallskreep', true);

		$this->db->enableForeignKeyChecks();
	}
}
