<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'uniqueID'          => '1gh6623gYhfauwyefgajkda',
                'user_name'         => 'unofficial',
                'user_email'        => 'unofficial@company.com',
                'user_photo'        => '',
                'user_registered'   => Time::now(),
                'user_token'        => 'unofficial_token',
                'user_fcm'          => 'unofficial_fcm',
                'display_name'      => 'unofficial',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now(),
                'email_verified'    => 'false'
            ]
        ];

        // Using Query Builder
        $this->db->table('ww_users')->insertBatch($data);
    }
}
