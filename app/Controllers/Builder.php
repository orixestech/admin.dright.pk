<?php

namespace App\Controllers;


use App\Models\BuilderModel;
use App\Models\Crud;
use App\Models\Main;
use App\Models\PharmacyModal;

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
        $BuilderModel = new \App\Models\BuilderModel();

        echo view('header', $data);
        if ($data['page'] == 'add') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'update') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'hospital') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'images') {
            echo view('builder/images', $data);

        } elseif ($data['page'] == 'banners') {
            $BuilderModel = new \App\Models\BuilderModel();
            $data['specialities'] = $BuilderModel->specialities();
            echo view('builder/banners', $data);

        } else {
//            $data['doctors'] = $BuilderModel->Allprofiless('doctors');
//            print_r($data['doctors'] );exit();
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
//        print_r($Data);exit();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Alignment']) ? htmlspecialchars($record['Alignment']) : '';
            $data[] = isset($record['Color']) ? htmlspecialchars($record['Color']) : '';
            $data[] = isset($record['Title']) ? htmlspecialchars($record['Title']) : '';
            $data[] = isset($record['Image'])
                ? '<img src="' . load_image('general-banner_' . $record['UID']) . '" style="display: block; padding: 2px; border: 1px solid #145388 !important; border-radius: 3px; width: 150px;">'
                : '';
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

    public function fetch_images()
    {
        $BuilderModel = new BuilderModel();
        $Data = $BuilderModel->get_images_datatables();
        $totalfilterrecords = $BuilderModel->count_image_datatables();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Filename']) ? '<img src="' . PATH . 'upload/specialities/' . $record['Filename'] . '" class="img-thumbnail" style="height:80px;">' : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="DeleteImage(' . htmlspecialchars($record['UID']) . ')">Delete</a>

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
    public function fetch_doctors()
    {
        $BuilderModel = new BuilderModel();
        $PharmacyModal = new PharmacyModal();
        $type='doctors';
        $Data = $BuilderModel->get_doct_datatables($type);
        $totalfilterrecords = $BuilderModel->count_doct_datatables($type);
//        $SmsCredits = $BuilderModel->get_profile_options_data_by_id_option(315, 'sms_credits');

//        print_r($Data);exit();
        $dataarr = array();
        $cnt = $_POST['start'];
//            echo 'ddddd00';exit();
        foreach ($Data as $record) {
            $cnt++;
            $SmsCredits = $BuilderModel->get_profile_options_data_by_id_option($record['UID'], 'sms_credits');
            $TeleMedicineCredits = $BuilderModel->get_profile_options_data_by_id_option($record['UID'], 'telemedicine_credits');
            $Sponsor = $BuilderModel->get_profile_options_data_by_id_option($record['UID'], 'sponsor');
            $Sponsor = (isset($Sponsor[0]['UID']) && $Sponsor[0]['Description'] != '') ? $Sponsor[0]['Description'] : 0;
            $city = $PharmacyModal->getcitybyid($record['City']);

            // Determine row color based on specific conditions
            $class = ($record['SubDomain'] == '') ? 'background-color: #FFD4DB;' : '';
            if ($record['LastVisitDateTime'] == date("Y-m-d")) {
                $class = 'background-color: #D7FFCD;';
            }

            // Check last visit date format
            $lastVisit = !empty($record['LastVisitDateTime']) ? date("d M, Y", strtotime($record['LastVisitDateTime'])) : "N/A";

//            $ping = ping($record['SubDomain']);
            $pingicon = isset($record['SubDomain']) ? '<span class="fa fa-check ks-icon btn-success"></span>' : '<span class="fa fa-ban ks-icon btn-danger"></span>';

            // Add all necessary table columns to data array
            $data = [];
            $data[] = $cnt;
            $data[] = $record['Name'];
//            $data[] = '<img src="' . load_image('sponsors_' . $Sponsor) . '" height="45">';
            $data[] = $record['Email'];
            $data[] = $city[0]['FullName'];

            // TeleMedicine Credits Column
            $telemedicineCredits = isset($TeleMedicineCredits[0]['Description']) && $TeleMedicineCredits[0]['Description'] != ''
                ? '<strong>' . $TeleMedicineCredits[0]['Description'] . '</strong> TeleMedicine Credits<br>
                <button class="btn btn-outline-success" onclick="AddTeleMedicineCredits(' . $record['UID'] . ', 50);"><strong>50</strong></button>
                <button  class="btn btn-outline-success" onclick="AddTeleMedicineCredits(' . $record['UID'] . ', 100);"><strong>100</strong></button>'
                : '<button  class="btn btn-outline-success" onclick="AddTeleMedicineCredits(' . $record['UID'] . ', 100);"><strong>Free Credits</strong></button>';
            $data[] = $telemedicineCredits;

            // SMS Credits Column
            $smsCredits = isset($SmsCredits[0]['Description']) && $SmsCredits[0]['Description'] != ''
                ? '<strong>' . $SmsCredits[0]['Description'] . '</strong> SMS Credits<br>
                <button  class="btn btn-gradient-warning" onclick="AddSmsCredits(' . $record['UID'] . ', 250);"><strong>250</strong></button>
                <button  class="btn btn-gradient-warning" onclick="AddSmsCredits(' . $record['UID'] . ', 500);"><strong>500</strong></button>'
                : '<button  class="btn btn-gradient-warning" onclick="AddSmsCredits(' . $record['UID'] . ', 100);"><strong>Free Credits</strong></button>';
            $data[] = $smsCredits;



            $data[] = $lastVisit;
            $data[] = '
<td class="text-end">
    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Actions
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" onclick="EditDoctors(' . $record['UID'] . ');">Edit</a>
            <a class="dropdown-item" onclick="DeleteDoctor(' . htmlspecialchars($record['UID']) . ')">Delete</a>';

            if ($record['SubDomain'] != '') {
                $data[] .= '
            <a class="dropdown-item" href="http://' . $record['SubDomain'] . '/" target="_blank">Website Link</a>
            <a class="dropdown-item" onclick="SendDoctorProfileInfo(' . $record['UID'] . ');">Send Website Detail</a>
            <a class="dropdown-item" href="' . PATH . 'module/websites_profile/meta/' . $record['UID'] . '">Add Profile Meta</a>
            <a class="dropdown-item" onclick="AddNewBanner(' . $record['UID'] . ');">Add Individualized Banner</a>';
            }

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

    public function delete_images()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
//        print_r($id);exit();
        $Crud->DeleteRecord("websites_images", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = ' Deleted Successfully...!';
        echo json_encode($response);
    }
    public function delete_doctor()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
//        print_r($id);exit();
        $Crud->DeleteeRecord('public."profiles"', array("UID" => $id));
        $Crud->DeleteeRecord('public."profile_metas"', array("ProfileUID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = ' Deleted Successfully...!';
        echo json_encode($response);
    }
    public function add_telemedicine_credits()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
        $record = array();

        $newcredits = $_POST['newcredits'];
//        print_r($id);exit();
      $option=  $Crud->SingleeRecord('public."options"', array("ProfileUID" => $id , 'Name'=>'telemedicine_credits'));
        $oldcredits = 0;
        if (isset($option['Description'])) {
            $oldcredits = $option['Description'];
        }


        $Crud->DeleteeRecord('public."options"', array("ProfileUID" => $id , 'Name'=>'telemedicine_credits'));
        $record['ProfileUID']=$id;
        $record['Name']='telemedicine_credits';
        $record['Description']=$oldcredits + $newcredits;
        $RecordId = $Crud->AdddRecord('public."options"', $record);
        if (isset($RecordId) && $RecordId > 0) {
            $response['status'] = 'success';
            $response['message'] = 'Telemedicine Credits Added Successfully...!';
        } else {
            $response['status'] = 'fail';
            $response['message'] = 'Data Didnt Submitted Successfully...!';
        }
        echo json_encode($response);
    }
  public function add_sms_credits()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
        $record = array();

        $newcredits = $_POST['newcredits'];
//        print_r($id);exit();
      $option=  $Crud->SingleeRecord('public."options"', array("ProfileUID" => $id , 'Name'=>'sms_credits'));
        $oldcredits = 0;
        if (isset($option['Description'])) {
            $oldcredits = $option['Description'];
        }


        $Crud->DeleteeRecord('public."options"', array("ProfileUID" => $id , 'Name'=>'sms_credits'));
        $record['ProfileUID']=$id;
        $record['Name']='sms_credits';
        $record['Description']=$oldcredits + $newcredits;
        $RecordId = $Crud->AdddRecord('public."options"', $record);
        if (isset($RecordId) && $RecordId > 0) {
            $response['status'] = 'success';
            $response['message'] = 'SMS Credits Added Successfully...!';
        } else {
            $response['status'] = 'fail';
            $response['message'] = 'Data Didnt Submitted Successfully...!';
        }
        echo json_encode($response);
    }

    public function image_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();


        $filename = "";

        if ($_FILES['Image']['tmp_name']) {
            $ext = @end(@explode(".", basename($_FILES['Image']['name'])));
            $uploaddir = ROOT . "/upload/specialities/";
            $uploadfile = strtolower($Main->RandFileName() . "." . $ext);

            if (move_uploaded_file($_FILES['Image']['tmp_name'], $uploaddir . $uploadfile)) {
                $filename = $uploadfile;
            }
        }

        if ($filename != "") {
            $record['Filename'] = $filename;
        }
//            print_r($record);exit();
        $RecordId = $Crud->AddRecord("websites_images", $record);
        if (isset($RecordId) && $RecordId > 0) {
            $response['status'] = 'success';
            $response['message'] = 'Added Successfully...!';
        } else {
            $response['status'] = 'fail';
            $response['message'] = 'Data Didnt Submitted Successfully...!';
        }


        echo json_encode($response);
    }
}