<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonneModel extends Model
{
    protected $table            = 'personne';
    protected $primaryKey       = 'idpersonne';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'date', 'idpersonnel', 'idnivo', 'mail', 'password', 'actif', 'pays'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = 'delete_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
}
