<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WwStoriette extends Migration
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
				'type'				=> 'TEXT',
				'null'				=> true
			],
			'status'      => [
				'type'           => 'ENUM',
				'constraint'     => ['publish', 'pending', 'draft'],
				'default'        => 'pending',
			],
			'author_uniqueID'	=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 200,
			],
			'jump_scare_img'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 500,
				'default'        => '',
			],
			'jump_scare_sec'      => [
				'type'           => 'INT',
				'constraint'     => 11,
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

		$this->forge->addKey('ID');
		$this->forge->createTable('ww_storiette');
	}


	public function down()
	{
		$this->forge->dropTable('ww_storiette');
	}
}
