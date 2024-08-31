<?php
namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects'; // Nom de la table
    protected $primaryKey = 'project_id'; // Clé primaire

    protected $useAutoIncrement = true; // Utiliser l'auto-incrémentation pour la clé primaire
    protected $returnType = 'array'; // Type de retour (array ou object)

    protected $allowedFields = ['project_name', 'description', 'domain_id']; // Champs modifiables

    protected $useSoftDeletes = false;
    protected $useTimestamps =false;

    // Définir la relation avec la table des domaines
    public function domain()
    {
        return $this->hasOne('App\Models\DomainModel', 'domain_id', 'domain_id');
    }
}
