<?php

namespace App\Models;
use CodeIgniter\Model;

class TrackModel extends Model
{
    protected $table = 'tracks';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [ 'id', 'name', 'cover', 'artist_id', 'artist_name', 'album_id', 'album_name', 'duration', 'player_url', 'playlist_id', ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}