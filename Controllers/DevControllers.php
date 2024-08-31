<?php

namespace App\Controllers;

class DevControllers extends BaseController
{
    public function index(): string
    {
        return view('Dev');
    }
}
