<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // Optional: Use users table here if needed
        // $result = $this->users->get()->getResult();

        return view('welcome_message');
    }
}
