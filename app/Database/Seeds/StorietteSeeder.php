<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class StorietteSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'uniqueID'          => md5(Time::now() . 'Tangan Takut Putus Asa'),
                'story_title'       => 'Tangan Takut Putus Asa',
                'story_slug'        => 'tangan_takut_putus_asa',
                'story_content'     => '<p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote><p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote>',
                'story_image'       => 'https://cdn.pixabay.com/photo/2017/08/06/16/09/hand-2593743_1280.jpg',
                'status'            => 'publish',
                'author_uniqueID'   => 'user_uid',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'uniqueID'          => md5(Time::now() . 'Aku Telah Diikuti'),
                'story_title'       => 'Aku Telah Diikuti',
                'story_slug'        => 'aku_telah_diikuti',
                'story_content'     => '<p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote><p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote>',
                'story_image'       => 'https://cdn.pixabay.com/photo/2017/11/10/01/59/ghost-2935132_1280.jpg',
                'status'            => 'publish',
                'author_uniqueID'   => 'user_uid',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'uniqueID'          => md5(Time::now() . 'Hantu Gespenter'),
                'story_title'       => 'Hantu Gespenter',
                'story_slug'        => 'hantu_gespenter',
                'story_content'     => '<p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote>',
                'story_image'       => 'https://cdn.pixabay.com/photo/2014/12/17/23/52/ghosts-572038_1280.jpg',
                'status'            => 'publish',
                'author_uniqueID'   => 'user_uid',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'uniqueID'          => md5(Time::now() . 'Reruntuhan Angker'),
                'story_title'       => 'Reruntuhan Angker',
                'story_slug'        => 'reruntuhan_angker',
                'story_content'     => '<p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote><p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote>',
                'story_image'       => 'https://cdn.pixabay.com/photo/2014/12/10/23/50/ruins-563629_1280.jpg',
                'status'            => 'publish',
                'author_uniqueID'   => 'user_uid',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'uniqueID'          => md5(Time::now() . 'Hidup Di Hutan Terlarang'),
                'story_title'       => 'Hidup Di Hutan Terlarang',
                'story_slug'        => 'hidup_di_hutan_terlarang',
                'story_content'     => '<p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote><p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote>',
                'story_image'       => 'https://cdn.pixabay.com/photo/2017/07/23/05/14/fantasy-2530602_1280.jpg',
                'status'            => 'publish',
                'author_uniqueID'   => 'user_uid',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'uniqueID'          => md5(Time::now() . 'Grip RIpper Horror'),
                'story_title'       => 'Grip Ripper Horror',
                'story_slug'        => 'grip_ripper_horror',
                'story_content'     => '<p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote><p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote>',
                'story_image'       => 'https://cdn.pixabay.com/photo/2015/03/02/15/53/grim-reaper-656083_1280.jpg',
                'status'            => 'publish',
                'author_uniqueID'   => 'user_uid',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'uniqueID'          => md5(Time::now() . 'Kamu Miliku'),
                'story_title'       => 'Kamu Miliku',
                'story_slug'        => 'kamu_miliku',
                'story_content'     => '<p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote><p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote>',
                'story_image'       => 'https://cdn.pixabay.com/photo/2016/05/07/22/33/gothic-1378352_1280.jpg',
                'status'            => 'publish',
                'author_uniqueID'   => 'user_uid',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'uniqueID'          => md5(Time::now() . 'Teror Tangan Pembunuh'),
                'story_title'       => 'Teror Tangan Pembunuh',
                'story_slug'        => 'teror_tangan_pembunuh',
                'story_content'     => '<p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote><p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote>',
                'story_image'       => 'https://cdn.pixabay.com/photo/2015/10/12/14/58/hands-984032_1280.jpg',
                'status'            => 'publish',
                'author_uniqueID'   => 'user_uid',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'uniqueID'          => md5(Time::now() . 'Satanisme'),
                'story_title'       => 'Satanisme',
                'story_slug'        => 'satanisme',
                'story_content'     => '<p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote><p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote>',
                'story_image'       => 'https://cdn.pixabay.com/photo/2015/08/05/17/09/heart-876746_1280.jpg',
                'status'            => 'publish',
                'author_uniqueID'   => 'user_uid',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'uniqueID'          => md5(Time::now() . 'Rumah Kosong'),
                'story_title'       => 'Rumah Kosong',
                'story_slug'        => 'rumah_kosong',
                'story_content'     => '<p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote><p>Ini adalah halaman contoh. Halaman ini berbeda dari artikel blog karena akan tetap di satu tempat dan akan muncul di navigasi situs Anda (di sebagian besar tema). Kebanyakan orang memulai dengan halaman "Tentang" yang bertujuan untuk mengenalkan mereka kepada pengunjung potensial situs. Biasanya berisi seperti ini:</p>   <blockquote class="wp-block-quote"><p>Hai yang disana! Saya seorang kurir bersepeda di siang hari, di malam hari bermimpi menjadi seorang aktor, dan ini adalah situs web saya. Saya tinggal di Los Angeles, punya anjing besar bernama Jack, dan saya suka pi&#241;a minuman Colada. (Dan terjebak dalam hujan.)</p></blockquote>',
                'story_image'       => 'https://cdn.pixabay.com/photo/2019/03/15/21/30/gang-4058036_1280.jpg',
                'status'            => 'publish',
                'author_uniqueID'   => 'user_uid',
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ]
        ];

        // Using Query Builder
        $this->db->table('ww_storiette')->insertBatch($data);
    }
}
