<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewerModel extends Model
{
    protected $table            = 'ww_storiette_viewer';
    protected $primaryKey       = 'ID';

    protected $allowedFields    = ['userID', 'storietteID', 'created_at', 'sessionID'];
}
