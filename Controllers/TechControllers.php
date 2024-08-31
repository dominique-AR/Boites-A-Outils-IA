<?php

namespace App\Controllers;

class TechControllers extends BaseController
{
    public function index(): string
    {
        return view('Tech');
    }
}
