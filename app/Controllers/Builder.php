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
//        print_r($Data);exit();
        $dataarr = array();
        $cnt = $_POST['start'];
            echo 'ddddd00';exit();
        foreach ($Data as $record) {
            $cnt++;
            $SmsCredits = $BuilderModel->get_profile_options_data_by_id_option($record['UID'], 'sms_credits');
            $TeleMedicineCredits = $BuilderModel->get_profile_options_data_by_id_option($record['UID'], 'telemedicine_credits');
            $Sponsor = $BuilderModel->get_profile_options_data_by_id_option($record['UID'], 'sponsor');
            $Sponsor = (isset($Sponsor) && $Sponsor['Description'] != '') ? $Sponsor['Description'] : 0;
            $city = $PharmacyModal->getcitybyid($record['City']);

            // Determine row color based on specific conditions
            $class = ($record['SubDomain'] == '') ? 'background-color: #FFD4DB;' : '';
            if ($record['MaxVisitDate'] == date("Y-m-d")) {
                $class = 'background-color: #D7FFCD;';
            }

            // Check last visit date format
            $lastVisit = !empty($record['MaxVisitDate']) ? date("d M, Y", strtotime($record['MaxVisitDate'])) : "N/A";

            // Ping icon based on SubDomain availability
            $ping = ping($record['SubDomain']);
            $pingicon = $ping ? '<span class="fa fa-check ks-icon btn-success"></span>' : '<span class="fa fa-ban ks-icon btn-danger"></span>';

            // Add all necessary table columns to data array
            $data = [];
            $data[] = $cnt;
            $data[] = '<img src="' . PATH . 'module/load_image/' . str_replace("=", "", base64_encode('profile_' . $record['UID'])) . '" height="50">';
            $data[] = $record['Name'] . ' ' . $record['MaxVisitDate'];
            $data[] = '<img src="' . load_image('sponsors_' . $Sponsor) . '" height="45">';
            $data[] = $record['Email'];
            $data[] = $city['FullName'];

            // TeleMedicine Credits Column
            $telemedicineCredits = isset($TeleMedicineCredits['Description']) && $TeleMedicineCredits['Description'] != ''
                ? '<strong>' . $TeleMedicineCredits['Description'] . '</strong> TeleMedicine Credits<br>
                <a href="javascript:void(0);" class="btn btn-primary-outline btn-sm" onclick="AddTeleMedicineCredits(' . $record['UID'] . ', 50);"><strong>50</strong></a>
                <a href="javascript:void(0);" class="btn btn-primary-outline btn-sm" onclick="AddTeleMedicineCredits(' . $record['UID'] . ', 100);"><strong>100</strong></a>'
                : '<a href="javascript:void(0);" class="btn btn-primary-outline btn-sm" onclick="AddTeleMedicineCredits(' . $record['UID'] . ', 100);"><strong>Free Credits</strong></a>';
            $data[] = $telemedicineCredits;

            // SMS Credits Column
            $smsCredits = isset($SmsCredits['Description']) && $SmsCredits['Description'] != ''
                ? '<strong>' . $SmsCredits['Description'] . '</strong> SMS Credits<br>
                <a href="javascript:void(0);" class="btn btn-primary-outline btn-sm" onclick="AddSmsCredits(' . $record['UID'] . ', 250);"><strong>250</strong></a>
                <a href="javascript:void(0);" class="btn btn-primary-outline btn-sm" onclick="AddSmsCredits(' . $record['UID'] . ', 500);"><strong>500</strong></a>'
                : '<a href="javascript:void(0);" class="btn btn-primary-outline btn-sm" onclick="AddSmsCredits(' . $record['UID'] . ', 100);"><strong>Free Credits</strong></a>';
            $data[] = $smsCredits;

            // Actions Column
            $actions = '
            <a class="btn btn-primary-outline ks-no-text" title="Edit Doctor" href="javascript:void(0);" onclick="EditDoctors(' . $record['UID'] . ');"><span class="fa fa-pencil ks-icon"></span></a>
            <a class="btn btn-danger-outline ks-no-text" title="Delete Doctor" href="javascript:void(0);" onclick="DeleteDoctor(' . $record['UID'] . ');"><span class="fa fa-trash ks-icon"></span></a>';

            if ($record['SubDomain'] != '') {
                $actions .= '
                <a class="btn btn-info-outline ks-no-text" title="Website Link" href="http://' . $record['SubDomain'] . '/" target="_blank"><span class="fa fa-globe ks-icon"></span></a>' . $pingicon . '
                <a class="btn btn-info-outline ks-no-text" title="Send Website Details" href="javascript:void(0);" onclick="SendDoctorProfileInfo(' . $record['UID'] . ');"><span class="fa fa-user ks-icon"></span></a>
                <a class="btn btn-info-outline ks-no-text" title="Add Profile Metas" href="' . PATH . 'module/websites_profile/meta/' . $record['UID'] . '"><span class="fa fa-info ks-icon"></span></a>
                <a class="btn btn-info-outline ks-no-text" title="Add Individualised Banner" href="javascript:void(0);" onclick="AddNewBanner(' . $record['UID'] . ');"><span class="fa fa-image ks-icon"></span></a>';
            }

            $actions .= '<br>Last Visit Date: ' . $lastVisit;
            $data[] = $actions;

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