<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index() 
    {
        $db = \Config\Database::connect();
        // Ou en utilisant le Query Builder
        $builder = $db->table('faqs');
        $data["faqs"] = $builder->get()->getResult();
        return view('HOME', $data);
    }
}