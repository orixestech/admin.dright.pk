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
        $CustomerModel = new CustomerModel();

        $data['Cities'] = $LookupOptionData->LookupsOption("city", 0);
        $data['category'] = $LookupOptionData->LookupsOption("category", 0);
        $data['Laboratory'] = $CustomerModel->LaboratoryDropDown();

        echo view('header', $data);
       if ($data['page'] == 'add-customer'){
           $data['PAGE'] = array();

           echo view('customers/main_form', $data);

        }
       elseif ($data['page'] == 'update-customer'){
           $UID = getSegment(3);
           $data['UID'] = $UID;
           $Crud = new Crud();
           $PAGE = $Crud->SingleRecord('customers', array("UID" => $UID));
           $data['lab']=$CustomerModel->get_customer_lab_data($UID);
           $data['PAGE'] = $PAGE;
            echo view('customers/main_form', $data);

        }
       elseif ($data['page'] == 'customer-profile'){
           $UID = getSegment(3);
           $data['UID'] = $UID;
           $Crud = new Crud();
           $data['Users']=$CustomerModel->GetUsersByCustID($UID);
           $data['Discounts']=$CustomerModel->GetCustomerDiscountDataByCustID($UID);

           $PAGE = $Crud->SingleRecord('customers', array("UID" => $UID));
           $data['Customer'] = $PAGE;
            echo view('customers/customer_profile', $data);

        }
       else {
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
                <a class="dropdown-item" onclick="CustomerProfile(' . htmlspecialchars($record['UID']) . ')">Profile</a>

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
    public function delete_user()
    {
        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $table = "customer_accounts";
        $record['Archive'] = 1;
        $where = array('UID' => $UID);
        $Crud->UpdateRecord($table, $record, $where);
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';

        echo json_encode($response);
    }
    public function form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Item = $this->request->getVar('Customer');

        $filename = "";

        if ($_FILES['Image']['tmp_name']) {
            $ext = @end(@explode(".", basename($_FILES['Image']['name'])));
            $uploaddir = ROOT . "/upload/customer/";
            $uploadfile = strtolower($Main->RandFileName() . "." . $ext);

            if (move_uploaded_file($_FILES['Image']['tmp_name'], $uploaddir . $uploadfile)) {
                $filename = $uploadfile;
            }
        }
        // Populate record with input values
        foreach ($Item as $key => $value) {
            $record[$key] = $value ?? '';
        }

        // Handle OwnPad logic
        if ($Item['OwnPad'] == 0) {
            $record['padTopMargin'] = null;
            $record['padBottomMargin'] = null;
        } else if ($Item['OwnPad'] == 1) {
            $record['padTopMargin'] = $Item['padTopMargin'] ?? null;
            $record['padBottomMargin'] = $Item['padBottomMargin'] ?? null;
        }

        // Handle RX Logo logic
        if ($Item['padRXLogo'] == 0) {
            $record['padLeftWidth'] = $Item['padLeftWidth'] ?? null;
        } else if ($Item['padRXLogo'] == 1) {
            $record['padLeftWidth'] = null;
        }

        // File addition to record
        if ($filename != "") {
            $record['Logo'] = $filename;
        }
        $Lab = $this->request->getVar('laboratory');

        if ($id == 0) {
            $KEY= $Main->GenAccessKey("+3 months");
            $record['SerialKey'] = $KEY['key'];

            $RecordId = $Crud->AddRecord("customers", $record);
            //print_r($Lab);
            if (isset($Lab) && $Lab != '') {
                $record2=array();
                foreach ($Lab as $L) {
                    $record2['LabID'] = $L;
                    $record2['CustomerID'] = $RecordId;
                  $Crud->AddRecord("customer_labs", $record2);


                }
            }
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Customer Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            $Crud->UpdateRecord("customers", $record, array("UID" => $id));
            $Crud->DeleteRecord("customer_labs", array("UID" => $id));

            if (isset($Lab) && $Lab != '') {
                $record2=array();
                foreach ($Lab as $L) {
                    $record2['CustomerID'] = $id;
                    $record2['LabID'] = $L;
                    $Crud->AddRecord("customer_labs", $record2);


                }
            }
            $response['status'] = 'success';
            $response['message'] = 'Item Updated Successfully...!';
        }

        echo json_encode($response);
    }
    public function user_form_submit()
    {
        $Crud = new Crud();
        $response = [];

        // Retrieve input variables
        $id = $this->request->getVar('uid');
        $Aqualification0 = $this->request->getVar('Aqualification0') ?? '';
        $Aqualification1 = $this->request->getVar('Aqualification1') ?? '';
        $Aqualifications = implode(', ', array_filter([$Aqualification0, $Aqualification1])); // Combine qualifications if not empty

        // Prepare the record array
        $record = [
            'CustomerID' => $this->request->getVar('CustomerID'),
            'UserType' => $this->request->getVar('UserType'),
            'FullName' => $this->request->getVar('FullName'),
            'Email' => $this->request->getVar('Email'),
            'Password' =>$this->request->getVar('Password'),
            'Contact' => $this->request->getVar('Contact'),
            'PrimaryQualification' => $this->request->getVar('Pqualification'),
            'AdvanceQualification' => $Aqualifications,
        ];

        // Perform Insert or Update operation
        if ($id > 0) {
            // Update existing record
            $updateResult = $Crud->UpdateRecord("customer_accounts", $record, ["UID" => $id]);
            if ($updateResult) {
                $response = [
                    'status' => 'success',
                    'message' => 'Customer updated successfully!',
                ];
            } else {
                $response = [
                    'status' => 'fail',
                    'message' => 'Failed to update customer.',
                ];
            }
        } else {
//            print_r($record);exit();
            $RecordId = $Crud->AddRecord("customer_accounts", $record);
            if ($RecordId > 0) {
                $response = [
                    'status' => 'success',
                    'message' => 'Customer added successfully!',
                ];
            } else {
                $response = [
                    'status' => 'fail',
                    'message' => 'Failed to add customer.',
                ];
            }
        }

        // Send response
        echo json_encode($response);
    }
    public function get_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("customer_accounts", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Item Record Get Successfully...!';
        echo json_encode($response);
    }

}
