<?php

namespace App\Controllers;

class GptsControllers extends BaseController
{
    public function index(): string
    {
        return view('Gpts');
    }
}