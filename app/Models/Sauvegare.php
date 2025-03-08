<?php

namespace App\Models;

use CodeIgniter\Model;

class Sauvegare extends Model
{
    protected $table      = 'save';
    protected $primaryKey = 'idsave';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

     protected $allowedFields    = [

        'heureD' , 'heureF' , 'idpersonnel', 'date'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'datetime';
    protected $updatedField  = 'update_at';
    protected $deletedField  = 'delete_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}