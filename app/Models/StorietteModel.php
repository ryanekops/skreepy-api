<?php

namespace App\Models;

use CodeIgniter\Model;

class StorietteModel extends Model
{
    protected $table            = 'ww_storiette';
    protected $primaryKey       = 'ID';

    protected $allowedFields    = ['story_slug', 'story_content', 'story_image', 'status', 'userID', 'viewer', 'reader', 'created_at', 'updated_at', 'deleted_at', 'jump_scare_img', 'jump_scare_sec'];

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

        $result = $this->select('ww_storiette.*, ww_users.display_name')->join($this->tableJoinAuthor, 'ww_users.ID = ww_storiette.userID')->where(['status' => 'publish', 'ww_storiette.deleted_at' => NULL])->limit($limit, $offset)->orderBy('ID', 'DESC')->get();

        return $result;
    }

    public function detailStoriette($slug)
    {

        $result = $this->select('ww_storiette.*, ww_users.display_name')->join($this->tableJoinAuthor, 'ww_users.ID = ww_storiette.userID')->where(['ww_storiette.story_slug' => $slug, 'status' => 'publish', 'ww_storiette.deleted_at' => NULL])->first();

        return $result;
    }

    public function viewStorietteRelatedCount($limit, $slug)
    {

        $queryCount = $this->select('ID')->where(['status' => 'publish', 'story_slug !=' => $slug, 'deleted_at' => NULL])->limit($limit)->orderBy('RAND()', 'DESC')->get()->getResult();

        return count($queryCount);
    }

    public function viewStorietteRelated($limit, $slug)
    {

        $result = $this->select('ww_storiette.*, ww_users.display_name')->join($this->tableJoinAuthor, 'ww_users.ID = ww_storiette.userID')->where(['status' => 'publish', 'ww_storiette.story_slug !=' => $slug, 'ww_storiette.deleted_at' => NULL])->limit($limit)->orderBy('RAND()', 'DESC')->get();

        return $result;
    }

    public function searchStorietteCount($value)
    {

        $queryCount = $this->select('ID')->where(['status' => 'publish', 'deleted_at' => NULL])->like('story_title', $value)->limit(18)->orderBy('ID', 'DESC')->get()->getResult();

        return count($queryCount);
    }

    public function searchStoriette($value)
    {

        $result = $this->select('ww_storiette.*, ww_users.display_name')->join($this->tableJoinAuthor, 'ww_users.ID = ww_storiette.userID')->where(['status' => 'publish', 'ww_storiette.deleted_at' => NULL])->like('story_title', $value)->limit(18)->orderBy('ID', 'DESC')->get();

        return $result;
    }
}
