<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonnelModel extends Model
{
    protected $table            = 'fiche_personnel';
    protected $primaryKey       = 'idfiche';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'date', 'nom', 'prenom', 'tel', 'fonction', 'num_compte', 'salaire_base', 'idpersonnel', 'pays',
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
