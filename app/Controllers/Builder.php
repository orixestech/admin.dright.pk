<?php

namespace App\Controllers;


class Builder extends BaseController
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
        if ($data['page'] == 'add') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'update') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'hospital') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'images') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'banners') {
            echo view('builder/main_form', $data);

        } else {
            echo view('builder/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('builder/dashboard', $data);
        echo view('footer', $data);
    }


}
