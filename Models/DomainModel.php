<?php
namespace App\Models;

use CodeIgniter\Model;

class DomainModel extends Model
{
    protected $table = 'domains'; // Définit le nom de la table à utiliser
    protected $primaryKey = 'domain_id'; // Définit la clé primaire

    protected $useAutoIncrement = true; // Utiliser l'auto-incrémentation pour la clé primaire
    protected $returnType = 'array'; // Définit le type de retour des résultats (array ou object)

    protected $allowedFields = ['domain_name', 'description']; // Définit les champs que vous autorisez à être modifiés

    protected $useSoftDeletes = false; // Désactive les suppressions logiques si vous n'avez pas de champ `deleted_at`
    protected $useTimestamps = false;  // Désactive les timestamps automatiques si vous n'utilisez pas `created_at` et `updated_at`

    // Configuration des règles de validation
    protected $validationRules = [
        'domain_name' => 'required|string|max_length[255]',
        'description' => 'required|string'
    ];

    protected $validationMessages = [
        'domain_name' => [
            'required' => 'Le nom du domaine est obligatoire',
            'max_length' => 'Le nom du domaine ne peut dépasser 255 caractères'
        ],
        'description' => [
            'required' => 'La description est obligatoire'
        ]
    ];

    // Si vous souhaitez activer la protection des champs, définissez ce paramètre à true
    protected $protectFields = true;
}
