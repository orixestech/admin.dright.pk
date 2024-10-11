<?php

namespace App\Controllers;


use App\Models\LookupModal;
use App\Models\Main;

class Lookup extends BaseController
{
    var $data = array();

    public function __construct()
    {
        helper('main');
//        $session = session();
//        $session = $session->get();
//
        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
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
       if ($data['page'] == 'add'){
            echo view('lookups/main_form', $data);

        }elseif ($data['page'] == 'update'){
            echo view('lookups/main_form', $data);

        }else {
//            $Data = $Users->systemusers();
//print_r($Data);exit();
            echo view('lookups/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('lookups/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_lookups()
    {
//        echo 'hhhhhh';exit();
        $Users= new LookupModal();
        $Data = $Users->get_datatables();
        $totalfilterrecords = $Users->count_datatables();
//            print_r($Data);exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['Key']) ? htmlspecialchars($record['Key']) : '';
            $data[] = isset($record['Description']) ? htmlspecialchars($record['Description']) : '';
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
