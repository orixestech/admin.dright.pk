<?php

namespace App\Controllers;


use App\Models\SystemUser;

class Users extends BaseController
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
        $Users= new SystemUser();

        echo view('header', $data);
        if ($data['page'] == 'access_level') {
            echo view('users/access_level', $data);
        }elseif ($data['page'] == 'add'){
            echo view('users/main_form', $data);

        }elseif ($data['page'] == 'update'){
            echo view('users/main_form', $data);

        }elseif ($data['page'] == 'admin-activites'){
            echo view('users/admin_activites', $data);

        } else {
//            $Data = $Users->systemusers();
//print_r($Data);exit();
            echo view('users/index', $data);

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

    public function fetch_users()
    {
//        echo 'hhhhhh';exit();
        $Users= new SystemUser();
        $Data = $Users->get_users_datatables();
        $totalfilterrecords = $Users->count_users_datatables();
//            print_r($Data);exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['FullName']) ? htmlspecialchars($record['FullName']) : '';
            $data[] = isset($record['Email']) ? htmlspecialchars($record['Email']) : '';
            $data[] = isset($record['AccessLevel']) ? htmlspecialchars($record['AccessLevel']) : '';
            $dataarr[] = $data;
        }

        $response = array(
            "draw" => intval($this->request->getPost('draw')),
            "recordsTotal" => count($Data),
            "recordsFiltered" => $totalfilterrecords,
            "data" => $dataarr
        );

        echo json_encode($response);
    }
}
