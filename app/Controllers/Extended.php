<?php

namespace App\Controllers;

use App\Models\Crud;
use App\Models\ExtendedModel;
use App\Models\Main;
use App\Models\PharmacyModal;

class Extended extends BaseController
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
        $data['PAGE'] = array();

        $data['page'] = getSegment(2);
        $PharmacyModal = new \App\Models\PharmacyModal();
        $ExtendedModel = new \App\Models\ExtendedModel();
        $data['Cities'] = $PharmacyModal->citites();
        echo view('header', $data);
        if ($data['page'] == 'add-profile') {
            echo view('extended/main_form', $data);

        } elseif ($data['page'] == 'update-profile') {
            $UID = getSegment(3);
            $data['UID'] = $UID;
            $Crud = new Crud();
            $PAGE = $Crud->SingleRecord('extended_profiles', array("UID" => $UID));
            $data['PAGE'] = $PAGE;
            echo view('extended/main_form', $data);

        } elseif ($data['page'] == 'extended_default_lookup') {
            echo view('extended/extended_default_lookup', $data);

        } elseif ($data['page'] == 'extended_profile_detail') {
            $UID = getSegment(3);
            $data['UID'] = $UID;
            $Crud = new Crud();
            $data['HospitalData'] = $ExtendedModel->GetExtendedProfielDataByID($UID);
            $data['HospitalAdminUsers'] = $ExtendedModel->GetAdminUsersByHospitalDB($data['HospitalData'][0]['DatabaseName']);



            $data['HospitalAdminSettings'] = $ExtendedModel->GetAdminSettingsByHospitalDB($data['HospitalData'][0]['DatabaseName']);
//            echo '<pre>'; print_r($data['HospitalAdminSettings']);exit();

            echo view('extended/extended_profile_detail', $data);

        }  elseif ($data['page'] == 'extended_default_config') {
            echo view('extended/extended_default_config', $data);

        } else {
            echo view('extended/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('extended/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_profiles()
    {
        $Users = new ExtendedModel();
        $PharmacyModal = new PharmacyModal();
        $Data = $Users->get_datatables();
        $totalfilterrecords = $Users->count_datatables();
//        print_r($totalfilterrecords);exit();
//      echo '<pre>';
//      print_r($Data);exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $city = $PharmacyModal->getcitybyid($record['City']);
//            $StatusUrl = SeoUrl('module/extended_profiles/status/'.$record['UID']);
            if ($_SERVER['HTTP_HOST'] != 'localhost') {
//                $InvoiceDateTime = $this->Modules->GetExtendedLastInvoiceDateTime( $EP['DatabaseName'] );
//                $PharmacyInvoiceDateTime = $this->Modules->GetExtendedLastPharmacyInvoiceDateTime( $EP['DatabaseName'] );

//                $PharmacyInvoiceDateTime = '';
//                $InvoiceDateTime = '';
            }
//

            $cnt++;
            $data = array();
            $data[] = $cnt;

            $data[] = isset($record['FullName']) ? htmlspecialchars($record['FullName']) : '';
            $data[] = isset($city[0]['FullName']) ? htmlspecialchars($city[0]['FullName']) : '';
            $data[] = isset($record['DatabaseName']) ? htmlspecialchars($record['DatabaseName']) : '';
//            $data[] = isset($InvoiceDateTime) ? date("d M, Y h:i A", strtotime($InvoiceDateTime)) : '';
//            $data[] = isset($PharmacyInvoiceDateTime) ? date("d M, Y h:i A", strtotime($PharmacyInvoiceDateTime)) : '';
            $data[] = isset($record['SubDomainUrl']) ? htmlspecialchars($record['SubDomainUrl']) : '';
            $data[] = isset($record['Status']) ? htmlspecialchars($record['Status']) : '';
            $data[] = isset($record['ExpireDate']) ? htmlspecialchars($record['ExpireDate']) : '';

            $smsCredits = isset($record['SMSCredits']) && $record['SMSCredits'] != ''
                ? '<strong>' . $record['SMSCredits'] . '</strong> SMS Credits<br>
                <button  class="btn btn-gradient-warning" onclick="AddSmsCredits(' . $record['UID'] . ', 250);"><strong>250</strong></button>
                <button  class="btn btn-gradient-warning" onclick="AddSmsCredits(' . $record['UID'] . ', 500);"><strong>500</strong></button>'
                : '<button  class="btn btn-gradient-warning" onclick="AddSmsCredits(' . $record['UID'] . ', 100);"><strong>Free Credits</strong></button>';
            $data[] = $smsCredits;

            $data[] = '
<td class="text-end">
    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Actions
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" onclick="UpdateProfile(' . $record['UID'] . ');">Edit</a>
            <a class="dropdown-item" onclick="ProfileDetail(' . $record['UID'] . ');">Detail</a>
            <a class="dropdown-item" onclick="DeleteProfile(' . htmlspecialchars($record['UID']) . ')">Delete</a>';

            $data[] .= '
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

    public function fetch_default_lookup()
    {
        $Users = new ExtendedModel();
        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');

        $Data = $Users->get_default_extended_lookup_datatables($keyword);
        $totalfilterrecords = $Users->count_default_extended_lookup_datatables($keyword);

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {

            $cnt++;
            $data = array();
            $data[] = $cnt;

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['Key']) ? htmlspecialchars($record['Key']) : '';


            $data[] = '
<td class="text-end">
    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Actions
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" onclick="UpdateDefaultLookup(' . $record['UID'] . ');">Edit</a>
            <a class="dropdown-item" onclick="DeleteDefaultLookup(' . htmlspecialchars($record['UID']) . ')">Delete</a>';

            $data[] .= '
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

    public function fetch_default_config()
    {
        $Users = new ExtendedModel();
        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');

        $Data = $Users->get_default_extended_config_datatables($keyword);
        $totalfilterrecords = $Users->count_default_extended_config_datatables($keyword);

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {

            $cnt++;
            $data = array();
            $data[] = $cnt;

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['Key']) ? htmlspecialchars($record['Key']) : '';


            $data[] = '
<td class="text-end">
    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Actions
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" onclick="UpdateDefaultConfig(' . $record['UID'] . ');">Edit</a>
            <a class="dropdown-item" onclick="DeleteDefaultconfig(' . htmlspecialchars($record['UID']) . ')">Delete</a>';

            $data[] .= '
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

    public function submit_default_lookup()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Item = $this->request->getVar('DefaultLookup');


        if ($id == 0) {
            foreach ($Item as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("extended_lookups", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Item Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($Item as $key => $value) {
                $record[$key] = $value;
            }


            $Crud->UpdateRecord("extended_lookups", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully...!';
        }

        echo json_encode($response);
    }

    public function submit_default_config()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Item = $this->request->getVar('DefaultConfig');


        if ($id == 0) {
            foreach ($Item as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("extended_admin_setings", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Item Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($Item as $key => $value) {
                $record[$key] = $value;
            }


            $Crud->UpdateRecord("extended_admin_setings", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully...!';
        }

        echo json_encode($response);
    }
    public function submit_profile()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Profile = $this->request->getVar('Profile');

        if (!empty($Profile['FullName']) && !empty($Profile['Email']) && !empty($Profile['ContactNo']) && !empty($Profile['City'])) {

        if ($id == 0) {
            foreach ($Profile as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("extended_profiles", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Profile Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        }
        else {
            foreach ($Profile as $key => $value) {
                $record[$key] = $value;
            }


            $Crud->UpdateRecord("extended_profiles", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully...!';
        }
        }
        else{
            $response['status'] = 'fail';
            $response['message'] = 'Fields Cant Be Empty...!';
        }
        echo json_encode($response);
    }

    public function delete_default_lookup()
    {
        $Crud = new Crud();
        $id = $this->request->getVar('id');
        $Crud->DeleteRecord('extended_lookups', array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = ' Deleted Successfully...!';
        echo json_encode($response);
    }

    public function get_default_lookup_record()
    {
        $Crud = new Crud();
        $id = $this->request->getVar('id');

        $record = $Crud->SingleRecord("extended_lookups", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }

    public function delete_default_config()
    {
        $Crud = new Crud();
        $id = $this->request->getVar('id');
        $Crud->DeleteRecord('extended_admin_setings', array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = ' Deleted Successfully...!';
        echo json_encode($response);
    }  public function delete_profile()
    {
        $Crud = new Crud();
        $id = $this->request->getVar('id');
        $Crud->DeleteRecord('extended_profiles', array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = ' Deleted Successfully...!';
        echo json_encode($response);
    }

    public function get_default_config_record()
    {
        $Crud = new Crud();
        $id = $this->request->getVar('id');

        $record = $Crud->SingleRecord("extended_admin_setings", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }
}
