<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwStoriette extends Migration
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
			'story_title'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200
			],
			'story_slug'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200,
				'unique'			=> true
			],
			'story_content'		=> [
				'type'				=> 'TEXT'
			],
			'story_image'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 500,
				'default'			=> ''
			],
			'status'      		=> [
				'type'           => 'ENUM',
				'constraint'     => ['publish', 'pending', 'draft'],
				'default'        => 'pending',
			],
			'userID'			=> [
				'type'				=> 'BIGINT',
				'constraint'		=> 21,
				'unsigned'       	=> true,
			],
			'jump_scare_img'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 500,
				'default'        => '',
			],
			'jump_scare_sec'      => [
				'type'           => 'INT',
				'constraint'     => 10,
				'default'        => 0,
			],
			'viewer'			=> [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'default'			=> 0
			],
			'reader'			=> [
				'type'				=> 'INT',
				'constraint'		=> 11,
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
		$this->forge->addKey('story_title');
		$this->forge->addKey('status');
		$this->forge->addKey('userID');
		$this->forge->addKey('deleted_at');
		$this->forge->addKey('jump_scare_sec');

		$this->forge->addForeignKey('userID', 'ww_users', 'ID', 'CASCADE', 'RESTRICT');

		$this->forge->createTable('ww_storiette');

		$this->db->enableForeignKeyChecks();
	}


	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('ww_storiette');

		$this->db->enableForeignKeyChecks();
	}
}
