<?php
namespace App\Controllers;

use App\Models\ProjectModel;

class ProjectsController extends BaseController
{
    public function index()
    {
        $model = new ProjectModel();
        $data['projects'] = $model->findAll();
        return view('projects/index', $data);
    }

    public function create()
    {
        $domainModel = new \App\Models\DomainModel();
        $data['domains'] = $domainModel->findAll();
        return view('projects/create', $data);
    }

    public function store()
    {
        $model = new ProjectModel();
        $data = [
            'project_name' => $this->request->getPost('project_name'),
            'description' => $this->request->getPost('description'),
            'domain_id' => $this->request->getPost('domain_id'),
        ];

        $model->save($data);
        return redirect()->to('/projects');
    }

    public function delete($id)
    {
    $model = new ProjectModel();
    if ($model->delete($id)) {
        return redirect()->to('/projects')->with('message', 'Projet supprimé avec succès.');
    } else {
        return redirect()->to('/projects')->with('error', 'Impossible de supprimer le projet.');
    }
    }


    public function edit($id)
    {
        $projectModel = new \App\Models\ProjectModel();
        $domainModel = new \App\Models\DomainModel();
        $data['project'] = $projectModel->find($id);
        $data['domains'] = $domainModel->findAll();
        return view('projects/edit', $data);
    }

    public function update($id)
    {
        $model = new ProjectModel();
        $data = [
            'project_name' => $this->request->getPost('project_name'),
            'description' => $this->request->getPost('description'),
            'domain_id' => $this->request->getPost('domain_id'),
        ];

        $model->update($id, $data);
        return redirect()->to('/projects');
    }
}
