<?php

namespace App\Controllers;

use App\Models\HealthcareModel;


class HealthCare extends BaseController
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
        $fruits = new \App\Models\HealthcareModel();

        echo view('header', $data);
        if ($data['page'] == 'pending') {
            echo view('health_care/pending', $data);
        } elseif ($data['page'] == 'add') {
            echo view('health_care/main_form', $data);

        } elseif ($data['page'] == 'fruit') {
//            $item='fruits';

//            $data['fruit'] = $fruits->Diet($item);
            echo view('health_care/fruit', $data);

        } elseif ($data['page'] == 'vegetable') {
            echo view('health_care/vegetable', $data);

        } elseif ($data['page'] == 'miscellaneous') {
            echo view('health_care/miscellaneous', $data);

        }  elseif ($data['page'] == 'pulses-grains') {
            echo view('health_care/pulses-grains', $data);

        } elseif ($data['page'] == 'dry-fruites') {
            echo view('health_care/dry-fruites', $data);

        } elseif ($data['page'] == 'update') {
            echo view('health_care/main_form', $data);

        } else {
            echo view('health_care/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('healthcare/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_fruit()
    {
        $Healthcare = new HealthcareModel();
        $item='fruits';
        $Data = $Healthcare->get_diet_datatables($item);
        $totalfilterrecords = $Healthcare->count_diet_datatables($item);
//        print_r($Data);
//        exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Nitems=$Healthcare->GetNutritionalCountByItem($record['UID']);
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="'. PATH .'upload/diet/'.$record['Image'].'" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="'. PATH .'upload/diet/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['UrduName']) ? htmlspecialchars($record['UrduName']) : '';
            $data[] = isset($Nitems) ? $Nitems: '';
           $dataarr[] = $data;
        }

        $response = array(
            "draw" => intval($this->request->getPost('draw')),
            "recordsTotal" => count($Data),
            "recordsFiltered" => $totalfilterrecords,
            "data" => $dataarr
        );

        echo json_encode($response);
    }     public function fetch_dry_fruit()
    {
        $Healthcare = new HealthcareModel();
        $item='fruits';
        $Data = $Healthcare->get_diet_datatables($item);
        $totalfilterrecords = $Healthcare->count_diet_datatables($item);
//        print_r($Data);
//        exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Nitems=$Healthcare->GetNutritionalCountByItem($record['UID']);
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="'. PATH .'upload/diet/'.$record['Image'].'" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="'. PATH .'upload/diet/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['UrduName']) ? htmlspecialchars($record['UrduName']) : '';
            $data[] = isset($Nitems) ? $Nitems: '';
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
    public function fetch_grains()
    {
        $Healthcare = new HealthcareModel();
        $item='pulses-grains';
        $Data = $Healthcare->get_diet_datatables($item);
        $totalfilterrecords = $Healthcare->count_diet_datatables($item);
//        print_r($Data);
//        exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Nitems=$Healthcare->GetNutritionalCountByItem($record['UID']);
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="'. PATH .'upload/diet/'.$record['Image'].'" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="'. PATH .'upload/diet/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['UrduName']) ? htmlspecialchars($record['UrduName']) : '';
            $data[] = isset($Nitems) ? $Nitems: '';
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
    public function fetch_vegetable()
    {
        $Healthcare = new HealthcareModel();
        $Data = $Healthcare->get_vegetable_datatables();
        $totalfilterrecords = $Healthcare->count_vegetable_datatables();


        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Nitems=$Healthcare->GetNutritionalCountByItem($record['UID']);

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="'. PATH .'upload/diet/'.$record['Image'].'" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="'. PATH .'upload/diet/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['UrduName']) ? htmlspecialchars($record['UrduName']) : '';
            $data[] = isset($Nitems) ? $Nitems: '';
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
    public function fetch_miscellaneous()
    {
        $Healthcare = new HealthcareModel();
        $Data = $Healthcare->get_miscellaneous_datatables();
        $totalfilterrecords = $Healthcare->count_miscellaneous_datatables();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Nitems=$Healthcare->GetNutritionalCountByItem($record['UID']);

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="'. PATH .'upload/diet/'.$record['Image'].'" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="'. PATH .'upload/diet/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['UrduName']) ? htmlspecialchars($record['UrduName']) : '';
            $data[] = isset($Nitems) ? $Nitems: '';
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
