<?php

namespace App\Models;

use CodeIgniter\Model;

class WallskreepModel extends Model
{
    protected $table            = 'ww_wallskreep';
    protected $primaryKey       = 'ID';

    protected $allowedFields    = ['userID', 'wall_content', 'wall_status', 'wall_password', 'wall_parentID', 'tagging', 'comment_count', 'like_count', 'created_at', 'updated_at', 'deleted_at'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $tableJoinAuthor   = 'ww_users';

    public function viewWallskreepCount($limit, $offset)
    {
        $queryCount = $this->select('ww_wallskreep.ID')->join($this->tableJoinAuthor, 'ww_wallskreep.userID = ww_users.ID')->where(['wall_status ' => 'publish', 'ww_wallskreep.deleted_at' => NULL])->limit($limit, $offset)->orderBy('ww_wallskreep.ID', 'DESC')->get()->getResult();

        return count($queryCount);
    }

    public function viewWallskreep($limit, $offset)
    {

        $result = $this->select('ww_wallskreep.*, ww_users.display_name, ww_users.user_photo')->join($this->tableJoinAuthor, 'ww_wallskreep.userID = ww_users.ID')->where(['wall_status' => 'publish', 'ww_wallskreep.deleted_at' => NULL])->limit($limit, $offset)->orderBy('ww_wallskreep.ID', 'DESC')->get();

        return $result;
    }

    public function detailWallskreep($id, $userID)
    {

        $result = $this->select('ID')->where(['ID' => $id, 'userID' => $userID, 'deleted_at' => NULL])->first();

        return $result;
    }
}
