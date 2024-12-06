<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\CustomerModel;
use App\Models\LookupModal;
use App\Models\Main;

class Customers extends BaseController
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
        $LookupOptionData = new Main();
        $data['Cities'] = $LookupOptionData->LookupsOption("city", 0);
        $data['category'] = $LookupOptionData->LookupsOption("category", 0);

        echo view('header', $data);
       if ($data['page'] == 'add-customer'){
           $data['PAGE'] = array();

           echo view('customers/main_form', $data);

        }elseif ($data['page'] == 'update-customer'){
           $UID = getSegment(3);
           $data['UID'] = $UID;
           $Crud = new Crud();
           $PAGE = $Crud->SingleRecord('customers', array("UID" => $UID));
           $data['PAGE'] = $PAGE;
            echo view('customers/main_form', $data);

        }else {
//
            echo view('customers/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('customers/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_customers()
    {
        $Lookup = new LookupModal();
        $Users= new CustomerModel();
        $Data = $Users->get_datatables();
        $totalfilterrecords = $Users->count_datatables();
//            print_r($Data);exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $City = $Lookup->LookupOptionBYID($record['City']);
//            $Speciality = $Lookup->LookupOptionBYID($record['Speciality']);
//            $Category = $Lookup->LookupOptionBYID($record['Category']);

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['SerialKey']) ? htmlspecialchars($record['SerialKey']) : '';
            $data[] = isset($record['Type']) ? htmlspecialchars($record['Type']) : '';
            $data[] = isset($City[0]['Name']) ? htmlspecialchars($City[0]['Name']) : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateCustomer(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="DeleteCustomer(' . htmlspecialchars($record['UID']) . ')">Delete</a>

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
    public function delete()
    {
        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $table = "customers";
        $record['Archive'] = 1;
        $where = array('UID' => $UID);
        $Crud->UpdateRecord($table, $record, $where);
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';

        echo json_encode($response);
    }
}
