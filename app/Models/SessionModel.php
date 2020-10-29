<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table            = 'ww_users_session';
    protected $primaryKey       = 'ID';

    protected $allowedFields    = ['userID', 'session_token', 'session_ip', 'session_agent', 'device_os', 'device_name', 'device_uuid', 'session_parentID', 'session_type', 'on_date', 'off_date', 'time_wasting', 'session_active'];

    public function checkSession($token)
    {
        $query = $this->table($this->table)->where('session_token', $token)->where('session_active', 1)->countAllResults();

        if ($query > 0) {
            $result = $this->table($this->table)->where('session_token', $token)->where('session_active', 1)->limit(1)->get()->getRowArray();
        } else {
            $result = array();
        }

        return $result;
    }

    public function checkSessionUser($id)
    {
        $query = $this->table($this->table)->where(['userID' => $id, 'session_active' => 1])->countAllResults();

        if ($query > 0) {
            $result = $this->table($this->table)->where(['userID' => $id, 'session_active' => 1])->limit(1)->get()->getRowArray();
        } else {
            $result = array();
        }

        return $result;
    }
}
