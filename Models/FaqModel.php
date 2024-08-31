<?php
namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table = 'faqs';
    protected $primaryKey = 'faq_id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    // Désactivation des suppressions logiques et des timestamps automatiques
    protected $useSoftDeletes = false; // Désactiver si vous n'avez plus le champ `deleted_at`
    protected $useTimestamps = false;  // Désactiver si vous n'utilisez pas les champs `created_at` et `updated_at`

    protected $allowedFields = ['question', 'answer', 'project_id']; // Les champs que vous autorisez à être modifiés

    // Relation avec la table des projets
    public function project()
    {
        return $this->belongsTo('App\Models\ProjectModel', 'project_id', 'project_id');
    }
}

