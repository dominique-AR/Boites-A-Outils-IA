<?php

namespace App\Controllers;
use App\Models\PromptiaModel;

class PromptControllers extends BaseController
{
    public function index(): string
    {
        return view('Prompt');
    }
    public function create()
    {
        $model = new PromptiaModel();
        
        if ($this->request->getMethod() === 'post' && $this->validate([
            'activites' => 'required|string|max_length[255]',
            'taches' => 'required|string|max_length[255]',
            // Add other fields validation as required
        ])) {
            $model->save([
                'activites' => $this->request->getPost('activites'),
                // Add other fields as required
            ]);

            return redirect()->to('/prompts');
        }

        return view('promptia/create');
    }

    public function edit($id)
    {
        $model = new PromptiaModel();
        $data['promptia'] = $model->find($id);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'activites' => 'required|string|max_length[255]',
            // Add other fields validation as required
        ])) {
            $model->update($id, [
                'activites' => $this->request->getPost('activites'),
                // Add other fields as required
            ]);

            return redirect()->to('/prompts');
        }

        return view('promptia/edit', $data);
    }

    public function delete($id)
    {
        $model = new PromptiaModel();
        $model->delete($id);
        return redirect()->to('/prompts');
    }
}
