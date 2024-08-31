<?php

namespace App\Models;

use CodeIgniter\Model;

class PromptiaModel extends Model
{
    protected $table = 'promptia'; // Nom de la table
    protected $primaryKey = 'id'; // Clé primaire

    // Sécurité : n'autorisez que les champs qui doivent être modifiables
    protected $allowedFields = [
        'activites', 'taches', 'outils', 'framework',
        'prompt', 'actions', 'resultats', 'cible'
    ];

    // Définir les règles de validation ici si nécessaire
    protected $validationRules = [
        'activites' => 'required|string|max_length[255]',
        'taches' => 'required|string|max_length[255]',
        'outils' => 'required|string|max_length[255]',
        'framework' => 'required|string|max_length[255]',
        'prompt' => 'required|string',
        'actions' => 'required|string',
        'resultats' => 'required|string',
        'cible' => 'required|string|max_length[255]'
    ];

    // Configurations optionnelles
    protected $useTimestamps = true; // Si votre table inclut des champs created_at et updated_at
    protected $returnType = 'array'; // Type de retour (array ou object)
    protected $useSoftDeletes = false; // Si vous souhaitez utiliser la suppression logique
}