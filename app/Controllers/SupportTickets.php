<?php

namespace App\Controllers;

use App\Models\Main;

class SupportTickets extends BaseController
{
    var $data = array();

    public function __construct()
    {

        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
    }

    public function index()
    {
        $data = $this->data;
        $data['page'] = getSegment(2);

        echo view('header', $data);
        if ($data['page'] == 'pending') {
            echo view('support_ticket/pending', $data);
        }elseif ($data['page'] == 'add'){
            echo view('support_ticket/main_form', $data);

        }elseif ($data['page'] == 'update'){
            echo view('support_ticket/main_form', $data);

        } else {
            echo view('support_ticket/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('support_ticket/dashboard', $data);
        echo view('footer', $data);
    }


}
