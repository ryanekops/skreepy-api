<?php

namespace App\Models;

use CodeIgniter\Model;

class BookmarkModel extends Model
{
    protected $table            = 'ww_users_bookmark';
    protected $primaryKey       = 'uniqueID';

    protected $allowedFields    = ['uniqueID', 'user_uniqueID', 'storiette_uniqueID', 'created_at', 'updated_at', 'deleted_at'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $beforeInsert     = ['beforeInsert'];

    protected $tableJoinAuthor  = 'ww_storiette';

    protected function beforeInsert(array $data)
    {
        $data = $this->hashData($data);

        return $data;
    }

    protected function hashData(array $data)
    {
        if (!isset($data['data']['uniqueID']))
            $data['data']['uniqueID'] = MD5(date("Y-m-d H:i:s") . $data['data']['user_uniqueID'] . $data['data']['storiette_uniqueID']);

        return $data;
    }

    public function checkBookmark($id)
    {

        $result = $this->table($this->table)->where(['uniqueID' => $id])->first();

        return $result;
    }

    public function checkUserBookmark($uid, $storyUid)
    {

        $result = $this->table($this->table)->where(['storiette_uniqueID' => $storyUid, 'user_uniqueID' => $uid])->first();

        return $result;
    }

    public function viewBookmarkCount($limit, $offset)
    {
        $queryCount = $this->select('ww_users_bookmark.ID AS bookmarkID, ww_storiette.*')->join($this->tableJoinAuthor, 'ww_users_bookmark.storiette_uniqueID = ww_storiette.uniqueID')->where(['status' => 'publish', 'ww_users_bookmark.deleted_at' => NULL])->limit($limit, $offset)->orderBy('ww_users_bookmark.ID', 'DESC')->get()->getResult();

        return count($queryCount);
    }

    public function viewBookmark($limit, $offset)
    {

        $result = $this->select('ww_users_bookmark.ID AS bookmarkID, ww_storiette.*')->join($this->tableJoinAuthor, 'ww_users_bookmark.storiette_uniqueID = ww_storiette.uniqueID')->where(['status' => 'publish', 'ww_users_bookmark.deleted_at' => NULL])->limit($limit, $offset)->orderBy('ww_users_bookmark.ID', 'DESC')->get();

        return $result;
    }
}
