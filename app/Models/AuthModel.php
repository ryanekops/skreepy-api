<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table            = 'ww_users';
    protected $primaryKey       = 'ID';

    protected $allowedFields    = ['uniqueID', 'user_email', 'user_name', 'user_registered', 'user_fcm', 'user_token', 'email_verified', 'display_name', 'user_photo', 'created_at', 'updated_at', 'deleted_at'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    public function checkLogin($email)
    {
        $query = $this->table($this->table)->where('user_email', $email)->countAllResults();

        if ($query > 0) {
            $result = $this->table($this->table)->where('user_email', $email)->limit(1)->get()->getRowArray();
        } else {
            $result = array();
        }

        return $result;
    }

    public function checkToken($token)
    {
        $query = $this->table($this->table)->where('user_token', $token)->countAllResults();

        if ($query > 0) {
            $result = $this->table($this->table)->where('user_token', $token)->limit(1)->get()->getRowArray();
        } else {
            $result = array();
        }

        return $result;
    }
}
