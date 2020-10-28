<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewerModel extends Model
{
    protected $table            = 'ww_storiette_viewer';
    protected $primaryKey       = 'uniqueID';

    protected $allowedFields    = ['uniqueID', 'user_uniqueID', 'storiette_uniqueID', 'created_at', 'session_uniqueID'];

    protected $beforeInsert     = ['beforeInsert'];

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
}
