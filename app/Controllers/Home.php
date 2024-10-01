<?php

namespace App\Controllers;

use App\Models\Main;

class Home extends BaseController
{
//    public function index(): string
//    {
//        return view('welcome_message');
//    }
    public function index(){
        $UserData = new Main();
        $data['Med'] = $UserData->AllMED();
        echo view('home',$data);

    }
}
