<?php

namespace App\Controllers;


class Pharmacy extends BaseController
{
    var $data = array();

    public function __construct()
    {
        helper('main');
//        $session = session();
//        $session = $session->get();
//
//        $this->MainModel = new Main();
//        $this->data = $this->MainModel->DefaultVariable();
        $this->data['template'] = TEMPLATE;
        $this->data['path'] = PATH;
//        $this->data[ 'session' ] = $session;
//        CheckLogin( $this->data );
    }

    public function index()
    {
        $data = $this->data;
        $data['page'] = getSegment(2);

        echo view('header', $data);
        if ($data['page'] == 'pending') {
            echo view('pharmacy/pending', $data);
        }elseif ($data['page'] == 'add'){
            echo view('pharmacy/main_form', $data);

        }elseif ($data['page'] == 'update'){
            echo view('pharmacy/main_form', $data);

        } else {
            echo view('pharmacy/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('pharmacy/dashboard', $data);
        echo view('footer', $data);
    }


}
