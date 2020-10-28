<?php

namespace App\Models;

use CodeIgniter\Model;

class StorietteModel extends Model
{
    protected $table            = 'ww_storiette';
    protected $primaryKey       = 'uniqueID';

    protected $allowedFields    = ['uniqueID', 'story_slug', 'story_content', 'story_image', 'status', 'author_uniqueID', 'viewer', 'reader', 'created_at', 'updated_at', 'deleted_at', 'jump_scare_img', 'jump_scare_sec'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $tableJoinAuthor  = 'ww_users';

    public function viewStorietteCount($limit, $offset)
    {

        $queryCount = $this->select('ID')->where(['status' => 'publish', 'deleted_at' => NULL])->limit($limit, $offset)->orderBy('ID', 'DESC')->get()->getResult();

        return count($queryCount);
    }

    public function viewStoriette($limit, $offset)
    {

        $result = $this->select('ww_storiette.*, ww_users.display_name')->join($this->tableJoinAuthor, 'ww_users.uniqueID = ww_storiette.author_uniqueID')->where(['status' => 'publish', 'ww_storiette.deleted_at' => NULL])->limit($limit, $offset)->orderBy('ID', 'DESC')->get();

        return $result;
    }

    public function detailStoriette($id)
    {

        $result = $this->select('ww_storiette.*, ww_users.display_name')->join($this->tableJoinAuthor, 'ww_users.uniqueID = ww_storiette.author_uniqueID')->where(['ww_storiette.uniqueID' => $id, 'status' => 'publish', 'ww_storiette.deleted_at' => NULL])->first();

        return $result;
    }

    public function viewStorietteRelatedCount($limit, $id)
    {

        $queryCount = $this->select('ID')->where(['status' => 'publish', 'uniqueID !=' => $id, 'deleted_at' => NULL])->limit($limit)->orderBy('RAND()', 'DESC')->get()->getResult();

        return count($queryCount);
    }

    public function viewStorietteRelated($limit, $id)
    {

        $result = $this->select('ww_storiette.*, ww_users.display_name')->join($this->tableJoinAuthor, 'ww_users.uniqueID = ww_storiette.author_uniqueID')->where(['status' => 'publish', 'ww_storiette.uniqueID !=' => $id, 'ww_storiette.deleted_at' => NULL])->limit($limit)->orderBy('RAND()', 'DESC')->get();

        return $result;
    }

    public function searchStorietteCount($value)
    {

        $queryCount = $this->select('ID')->where(['status' => 'publish', 'deleted_at' => NULL])->like('story_title', $value)->limit(18)->orderBy('ID', 'DESC')->get()->getResult();

        return count($queryCount);
    }

    public function searchStoriette($value)
    {

        $result = $this->select('ww_storiette.*, ww_users.display_name')->join($this->tableJoinAuthor, 'ww_users.uniqueID = ww_storiette.author_uniqueID')->where(['status' => 'publish', 'ww_storiette.deleted_at' => NULL])->like('story_title', $value)->limit(18)->orderBy('ID', 'DESC')->get();

        return $result;
    }
}
