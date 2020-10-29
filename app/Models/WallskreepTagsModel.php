<?php

namespace App\Models;

use CodeIgniter\Model;

class WallskreepTagsModel extends Model
{
    protected $table            = 'ww_wallskreep_tags';
    protected $primaryKey       = 'ID';

    protected $allowedFields    = ['tag'];
}
