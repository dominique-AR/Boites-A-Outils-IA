<?php
namespace App\Controllers;

use App\Models\DomainModel;

class DomainsController extends BaseController
{
    public function index()
    {
        $model = new DomainModel();
        $data['domains'] = $model->findAll();
        return view('domains/index', $data);
    }

    public function create()
    {
        return view('domains/create');
    }

    public function store()
    {
        $model = new DomainModel();
        $data = [
            'domain_name' => $this->request->getPost('domain_name'),
            'description' => $this->request->getPost('description'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/domains')->with('message', 'Domaine ajouté avec succès.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function edit($id)
    {
        $model = new DomainModel();
        $data['domain'] = $model->find($id);
        return view('domains/edit', $data);
    }

    public function update($id)
    {
        $model = new DomainModel();
        $data = [
            'domain_name' => $this->request->getPost('domain_name'),
            'description' => $this->request->getPost('description'),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/domains')->with('message', 'Domaine mis à jour avec succès.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function delete($id)
    {
        $model = new DomainModel();
        if ($model->delete($id)) {
            return redirect()->to('/domains')->with('message', 'Domaine supprimé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Impossible de supprimer le domaine.');
        }
    }
}
