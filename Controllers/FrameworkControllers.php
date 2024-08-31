<?php

namespace App\Controllers;

class FrameworkControllers extends BaseController
{
    public function index(): string
    {
        return view('Framework');
    }
}