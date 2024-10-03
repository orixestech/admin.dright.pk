<?php

namespace App\Controllers;

use App\Models\Main;

class Home extends BaseController
{
    var $data = array();

    public function __construct()
    {
        $this->data['template'] = TEMPLATE;
        $this->data['path'] = PATH;
    }

    public function testing()
    {
        $data = $this->data;

        $UserData = new Main();
        $data['Med'] = $UserData->AllMED();
//        echo view('header');

    }

    public function index()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('home', $data);
        echo view('footer', $data);

    }

    public function login()
    {
        $data = $this->data;
        echo view('login', $data);
    }

    public function table()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('table', $data);
        echo view('footer', $data);

    }
}
