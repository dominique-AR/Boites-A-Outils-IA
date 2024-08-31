<?php
namespace App\Controllers;

use App\Models\FaqModel;

class FaqController extends BaseController
{
    public function index()
    {
        $model = new FaqModel();
        $data['faqs'] = $model->findAll();
        return view('faqs/index', $data);
    }

    public function updateFaq($id)
    {
        $model = new FaqModel();
        $data = [
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'project_id' => $this->request->getPost('project_id'),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/faqs'); // Rediriger vers la liste des FAQ après la mise à jour
        } else {
            return redirect()->back()->with('error', 'Impossible de mettre à jour la FAQ');
        }
    }
    public function editFaq($id)
    {
        $faqModel = new \App\Models\FaqModel();
        $projectModel = new \App\Models\ProjectModel();
    
        $faq = $faqModel->find($id);
        $projects = $projectModel->findAll();  // Récupère tous les projets
    
        if (!$faq) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('FAQ non trouvée avec l\'id ' . $id);
        }
    
        $data = [
            'faq' => $faq,
            'projects' => $projects  // Passe les projets à la vue
        ];
    
        return view('faqs/update', $data);
    }
    public function showCreateForm()
{
    $projectModel = new \App\Models\ProjectModel();
    $data["projects"] = $projectModel->findAll(); 
    return view('faqs/create', $data);
}
public function deleteFaq($id)
{
    $model = new FaqModel();
    
    // Vérifie d'abord si l'entrée existe
    $faq = $model->find($id);
    if (!$faq) {
        return redirect()->to('/faqs')->with('error', 'FAQ non trouvée avec l\'ID ' . $id);
    }

    // Tente de supprimer la FAQ
    if ($model->delete($id)) {
        return redirect()->to('/faqs')->with('message', 'FAQ supprimée avec succès.');
    } else {
        return redirect()->to('/faqs')->with('error', 'Impossible de supprimer la FAQ.');
    }
}


     public function createFaq()
    {
    $model = new FaqModel();

    $data = [
        'question' => $this->request->getPost('question'),
        'answer' => $this->request->getPost('answer'),
        'project_id' => $this->request->getPost('project_id'),
    ];

    $validationRules = [
        'question' => 'required|min_length[3]',
        'answer' => 'required|min_length[3]',
        'project_id' => 'required|is_natural_no_zero',
    ];

    if (!$this->validate($validationRules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $model->save($data);

    return redirect()->to('/faqs');
}

}
