<?php

namespace App\Models;

use CodeIgniter\Model;

class BookmarkModel extends Model
{
    protected $table            = 'ww_users_bookmark';
    protected $primaryKey       = 'ID';

    protected $allowedFields    = ['userID', 'storietteID', 'created_at', 'updated_at', 'deleted_at'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $tableJoinAuthor  = 'ww_storiette';

    public function checkBookmark($id)
    {

        $result = $this->table($this->table)->where(['ID' => $id])->first();

        return $result;
    }

    public function checkUserBookmark($id, $storyid)
    {

        $result = $this->table($this->table)->where(['storietteID' => $storyid, 'userID' => $id])->first();

        return $result;
    }

    public function viewBookmarkCount($limit, $offset)
    {
        $queryCount = $this->select('ww_users_bookmark.ID AS bookmarkID, ww_storiette.*')->join($this->tableJoinAuthor, 'ww_users_bookmark.storietteID = ww_storiette.ID')->where(['status' => 'publish', 'ww_users_bookmark.deleted_at' => NULL])->limit($limit, $offset)->orderBy('ww_users_bookmark.ID', 'DESC')->get()->getResult();

        return count($queryCount);
    }

    public function viewBookmark($limit, $offset)
    {

        $result = $this->select('ww_users_bookmark.ID AS bookmarkID, ww_storiette.*')->join($this->tableJoinAuthor, 'ww_users_bookmark.storietteID = ww_storiette.ID')->where(['status' => 'publish', 'ww_users_bookmark.deleted_at' => NULL])->limit($limit, $offset)->orderBy('ww_users_bookmark.ID', 'DESC')->get();

        return $result;
    }
}
