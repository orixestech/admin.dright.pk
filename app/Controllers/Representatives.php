<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\HealthcareModel;
use App\Models\Main;
use App\Models\SystemUser;

class Representatives extends BaseController
{
    var $data = array();

    public function __construct()
    {
        helper('main');
        $session = session();
        $session = $session->get();
//
        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
        $this->data['template'] = TEMPLATE;
        $this->data['path'] = PATH;
        $this->data[ 'session' ] = $session;
        CheckLogin( $this->data );
    }

    public function index()
    {
        $data = $this->data;
        $data['page'] = getSegment(2);

        echo view('header', $data);
        if ($data['page'] == 'add') {
            echo view('health_care/main_form', $data);

        } elseif ($data['page'] == 'update') {
            echo view('health_care/main_form', $data);

        } else {
            echo view('health_care/representative', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('health_care/representative', $data);
        echo view('footer', $data);
    }

    public function fetch_representative()
    {
        $Users = new HealthcareModel();
        $Data = $Users->get_representatives_datatables();
        $totalfilterrecords = $Users->count_representatives_datatables();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $count= count($Users->get_rcc_receipts_data_by_id($record['UID']));

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
                <a class="dropdown-item" onclick="Updaterepresentatives(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="Deleterepresentatives(' . htmlspecialchars($record['UID']) . ')">Delete</a>

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
    public function representatives_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $User = $this->request->getVar('representatives');


        if ($id == 0) {
            foreach ($User as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("representatives", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = ' Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($User as $key => $value) {
                $record[$key] = $value;
            }
            $Crud->UpdateRecord("representatives", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = ' Updated Successfully...!';
        }

        echo json_encode($response);
    }
    public function delete()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
        $Crud->DeleteRecord("representatives", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = ' Deleted Successfully...!';
        echo json_encode($response);
    }
    public function get_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("representatives", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }
}
