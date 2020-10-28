<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table            = 'ww_users_session';
    protected $primaryKey       = 'ID';

    protected $allowedFields    = ['uniqueID', 'user_uniqueID', 'session_agent', 'device_os', 'device_name', 'device_uuid', 'session_unique_ID', 'session_type', 'signup_date', 'signout_date', 'time_wasting', 'session_active'];

    protected $beforeInsert     = ['beforeInsert'];

    protected function beforeInsert(array $data)
    {
        $data = $this->hashData($data);

        return $data;
    }

    protected function hashData(array $data)
    {
        if (!isset($data['data']['uniqueID']))
            $data['data']['uniqueID'] = MD5(date("Y-m-d H:i:s") . $data['data']['user_uniqueID']);

        return $data;
    }

    public function checkSession($uid)
    {
        $query = $this->table($this->table)->where('uniqueID', $uid)->where('session_active', 1)->countAllResults();

        if ($query > 0) {
            $result = $this->table($this->table)->where('uniqueID', $uid)->where('session_active', 1)->limit(1)->get()->getRowArray();
        } else {
            $result = array();
        }

        return $result;
    }

    public function checkSessionUser($uid)
    {
        $query = $this->table($this->table)->where(['user_uniqueID' => $uid, 'session_active' => 1])->countAllResults();

        if ($query > 0) {
            $result = $this->table($this->table)->where(['user_uniqueID' => $uid, 'session_active' => 1])->limit(1)->get()->getRowArray();
        } else {
            $result = array();
        }

        return $result;
    }
}
