<?php

namespace App\Controllers;
use App\Models\FaqModel;
use App\Models\DomainModel;
use App\Models\ProjectModel;

class ListeFaqsControllers extends BaseController
{
    public function index(): string
    {
        $model = new DomainModel();
        $data['domains'] = $model->findAll();
        $model = new ProjectModel();
        $data['projects'] = $model->findAll();
        $model = new FaqModel();
        $data['faqs'] = $model->findAll();
        return view('ListeFaqs', $data);
    }
}
