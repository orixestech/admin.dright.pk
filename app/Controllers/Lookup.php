<?php

namespace App\Controllers;


use App\Models\Crud;
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
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateLookup(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="DeleteLookup(' . htmlspecialchars($record['UID']) . ')">Delete</a>

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
    public function lookup_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Lookup = $this->request->getVar('Lookup');

//print_r($Lookup);exit();
        if ($id == 0) {
            foreach ($Lookup as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("lookups", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($Lookup as $key => $value) {
                $record[$key] = $value;
            }
            $Crud->UpdateRecord("lookups", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully...!';
        }

        echo json_encode($response);
    }
    public function delete_lookup()
    {
//        $Crud = new Crud();
//        $id = $_POST['id'];
//        $Crud->DeleteRecord("lookups", array("UID" => $id));
//        $response = array();
//        $response['status'] = 'success';
//        $response['message'] = 'Deleted Successfully...!';



        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $table = "lookups";
        $record['Archive'] = 1;
        $where = array('UID' => $UID);
        $Crud->UpdateRecord($table, $record, $where);
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';

        echo json_encode($response);
    }
    public function get_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("lookups", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }
}
