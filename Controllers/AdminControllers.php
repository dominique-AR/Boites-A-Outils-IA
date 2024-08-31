<?php

namespace App\Controllers;

class AdminControllers extends BaseController
{
    public function index(): string
    {
        return view('Admin');
    }
}
