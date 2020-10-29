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
            ],
            [
                'uniqueID'          => 'Ui878egUiowe781jKlajduqdbf',
                'user_name'         => 'Ryan Eko Prabowo Saputro',
                'user_email'        => 'ryanekops@gmail.com',
                'user_photo'        => '',
                'user_registered'   => Time::now(),
                'user_token'        => MD5(Time::now()),
                'user_fcm'          => '',
                'display_name'      => 'Ryan Eko Prabowo Saputro',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now(),
                'email_verified'    => 'true'
            ]
        ];

        // Using Query Builder
        $this->db->table('ww_users')->insertBatch($data);
    }
}
