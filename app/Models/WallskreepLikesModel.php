<?php

namespace App\Models;

use CodeIgniter\Model;

class WallskreepLikesModel extends Model
{
    protected $table            = 'ww_wallskreep_likes';
    protected $primaryKey       = 'ID';

    protected $allowedFields    = ['userID', 'wallskreepID', 'status'];
}
