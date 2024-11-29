<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\HealthcareModel;
use App\Models\Main;
use App\Models\PharmacyModal;
use App\Models\SystemUser;

class Representatives extends BaseController
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
        $PharmacyModal = new PharmacyModal();
        $data['cities'] = $PharmacyModal->citites();
        $healthcare = new \App\Models\HealthcareModel();
        $data['branches'] = $healthcare->GenerateBranchesOptions();
        $data[ 'PAGE' ] = array ();

        echo view('header', $data);
        if ($data['page'] == 'add') {
            echo view('health_care/main_form', $data);

        } elseif ($data['page'] == 'update') {
            $UID = getSegment( 3 );
            $data[ 'UID' ] = $UID;
            $Crud = new Crud();
            $PAGE = $Crud->SingleRecord( 'representatives', array ( "UID" => $UID ) );
            $data[ 'PAGE' ] = $PAGE;
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
        $PharmacyModal = new PharmacyModal();

        $keyword = ( (isset($_POST['search']['value'])) ? $_POST['search']['value'] : '' );

        $Data = $Users->get_representatives_datatables($keyword);
        $totalfilterrecords = $Users->count_representatives_datatables($keyword);
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $count= count($Users->get_rcc_receipts_data_by_id($record['UID']));
            $city = $PharmacyModal->getcitybyid($record['City']);

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['UID']) ? htmlspecialchars($record['UID']) : '';
            $data[] = isset($record['FullName']) ? htmlspecialchars($record['FullName']) : '';
            $data[] = $city[0]['FullName'];
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
                <a class="dropdown-item" onclick="AlotReceiptNo(' . htmlspecialchars($record['UID']) . ')">Add Receipts</a>

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
        $RCC = $this->request->getVar('RCC'); // Get the array from the request
        $hasEmptyField = false; // Flag to track if any field is empty

        foreach ($RCC as $key => $value) {
            if (empty($value)) {
                $hasEmptyField = true;
                break; // Exit the loop if an empty field is found
            }
        }

        if ($hasEmptyField) {
            // Handle the case where a field is empty
            $response['message'] ="One or more fields are empty.";
        } else {


            $filename = "";
            $contactprofile = "";

            if ($_FILES['Image']['tmp_name']) {
                $ext = @end(@explode(".", basename($_FILES['Image']['name'])));
                $uploaddir = ROOT . "/upload/representative/";
                $uploadfile = strtolower($Main->RandFileName() . "." . $ext);

                if (move_uploaded_file($_FILES['Image']['tmp_name'], $uploaddir . $uploadfile)) {
                    $filename = $uploadfile;
                }
            }
            if ($_FILES['Profile']['tmp_name']) {
                $ext = @end(@explode(".", basename($_FILES['Profile']['name'])));
                $uploaddir = ROOT . "/upload/representative/";
                $uploadfile = strtolower($Main->RandFileName() . "." . $ext);

                if (move_uploaded_file($_FILES['Profile']['tmp_name'], $uploaddir . $uploadfile)) {
                    $contactprofile = $uploadfile;
                }
            }
            if ($id == 0) {
                foreach ($RCC as $key => $value) {
                    $record[$key] = ((isset($value)) ? $value : '');
                }
                if ($filename != "") {
                    $record['ConactPersonImage'] = $filename;
                }
                if ($contactprofile != "") {
                    $record['Profile'] = $contactprofile;
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
                foreach ($RCC as $key => $value) {
                    $record[$key] = $value;
                }
                if ($filename != "") {
                    $record['ConactPersonImage'] = $filename;
                }
                if ($contactprofile != "") {
                    $record['Profile'] = $contactprofile;
                }

                $Crud->UpdateRecord("representatives", $record, array("UID" => $id));
                $response['status'] = 'success';
                $response['message'] = ' Updated Successfully...!';
            }
        }
        echo json_encode($response);
    }
    public function RCCReceiptForm()
    {
        $Crud = new Crud();
        $response = [];
        $record = [];

        // Retrieve input values
        $RCCID = $this->request->getVar('RCCUID');
        $SerialPrefix = $this->request->getVar('serial_prefix');
        $StartSerial = (int)$this->request->getVar('start_serial');
        $EndSerial = (int)$this->request->getVar('end_serial');

        // Validate if StartSerial and EndSerial are integers
        if ($StartSerial > $EndSerial || $StartSerial < 0) {
            $response['status'] = 'fail';
            $response['message'] = 'Invalid serial range provided.';
            return $this->response->setJSON($response);
        }

        // Process each serial number within the range
        for ($i = $StartSerial; $i <= $EndSerial; $i++) {
            // Format the serial number with leading zeros
            $serialNumber = str_pad($i, 4, "0", STR_PAD_LEFT);

            $record['RepresentativeUID'] = $RCCID;
            $record['ReceiptNo'] = $SerialPrefix . "-" . $serialNumber;

            // Insert the record
            $RecordId = $Crud->AddRecord("representative_receipts", $record);

            // Check for insertion errors
            if (!isset($RecordId) || $RecordId <= 0) {
                $response['status'] = 'fail';
                $response['message'] = 'Error adding receipt: ' . $SerialPrefix . "-" . $serialNumber;
                return $this->response->setJSON($response);
            }
        }

        // Success response
        $response['status'] = 'success';
        $response['message'] = 'Receipts added successfully!';
        return $this->response->setJSON($response);
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
    public
    function rcc_receipt_html_list( ){

        $id = $this->request->getVar( 'id' );
        $HealthcareModel = new HealthcareModel();

        $Data = $HealthcareModel->get_rcc_receipts_data_by_id( $id );
        if( count( $Data ) > 0 ){

            $html = '';

            foreach( $Data as $D ){

                $html.='<span class="pull-left badge badge-pill badge-success" style="margin-right: 10px; margin-bottom: 5px; font-size:13px;">'.$D['ReceiptNo'].'</span>';

            }
        }
        echo $html;

    }
    public function rcc_search_filter()
    {
        $session = session();
//        $Key = $this->request->getVar( 'Key' );
        $city = $this->request->getVar( 'City' );
        $status = $this->request->getVar( 'Status' );
        $Name = $this->request->getVar( 'Name' );


        $AllFilter = array (
//            'Key' => $Key,
            'Status' => $status,
            'City' => $city,
            'Name' => $Name,

        );


//        print_r($AllFilter);exit();
        $session->set( 'RCCFilters', $AllFilter );

        $response[ 'status' ] = "success";
        $response[ 'message' ] = "Filters Updated Successfully";

        echo json_encode( $response );
    }

}
