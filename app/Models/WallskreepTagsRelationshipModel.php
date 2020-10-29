<?php

namespace App\Models;

use CodeIgniter\Model;

class WallskreepTagsRelationshipModel extends Model
{
    protected $table            = 'ww_wallskreep_tags_relationship';
    protected $primaryKey       = 'objectID';

    protected $allowedFields    = ['wallskreepID', 'tagID'];
}
