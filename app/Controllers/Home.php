<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    { 
        echo view('templates/header');
        echo view('login');
        echo view('templates/footer');
        echo view('templates/footer_js');
    }

    public function attemptLogin(){
        echo view('templates/header');
        echo view('login');
        echo view('templates/footer');
        echo view('templates/footer_js');
    }

    public function register(){
        echo view('templates/header');
        echo view('register');
        echo view('templates/footer');
        echo view('templates/footer_js');
    }
}
