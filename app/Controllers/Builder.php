<?php

namespace App\Controllers;


use App\Models\BuilderModel;
use App\Models\Crud;
use App\Models\Main;

class Builder extends BaseController
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
        if ($data['page'] == 'add') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'update') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'hospital') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'images') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'banners') {
            $BuilderModel= new \App\Models\BuilderModel();
            $data['specialities'] = $BuilderModel->specialities();
            echo view('builder/banners', $data);

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

    public function fetch_banners()
    {
        $BuilderModel = new BuilderModel();
        $Data = $BuilderModel->get_datatables();
        $totalfilterrecords = $BuilderModel->count_datatables();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['UID']) ? htmlspecialchars($record['UID']) : '';
            $data[] = isset($record['FullName']) ? htmlspecialchars($record['FullName']) : '';
            $data[] = isset($record['City']) ? htmlspecialchars($record['City']) : '';
            $data[] = isset($record['ContactNo']) ? htmlspecialchars($record['ContactNo']) : '';
            $data[] = isset($record['Branch']) ? htmlspecialchars($record['Branch']) : '';
            $data[] = isset($record['Category']) ? htmlspecialchars($record['Category']) : '';
            $data[] = isset($record['Status']) ? htmlspecialchars($record['Status']) : '';
            $data[] = isset($count) ? htmlspecialchars($count) : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="DeleteBanner(' . htmlspecialchars($record['UID']) . ')">Delete</a>

            </div>
        </div>
    </td>';
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
    public function delete_banner()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
        $Crud->DeleteRecord("general_banners", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = ' Deleted Successfully...!';
        echo json_encode($response);
    }
}