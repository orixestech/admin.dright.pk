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
        $PharmacyModal = new \App\Models\PharmacyModal();
        $data['Cities'] = $PharmacyModal->citites();
        $data['specialities'] = $BuilderModel->specialities();
        $data['Sponsors'] = $BuilderModel->get_all_sponsors();
        $data['extended_profiles'] = $BuilderModel->extended_profiles();
        $data['PAGE'] = array();

        echo view('header', $data);
        if ($data['page'] == 'add-doctor') {
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'add-hospital') {

            echo view('builder/hospital_main_form', $data);

        } elseif ($data['page'] == 'specialities') {

            echo view('builder/specialities', $data);

        } elseif ($data['page'] == 'update-doctor') {
            $UID = getSegment(3);
            $data['UID'] = $UID;
            $Crud = new Crud();
            $PAGE = $Crud->SingleeRecord('representatives', array("UID" => $UID));
            $data['PAGE'] = $PAGE;
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'update-hospital') {
            $UID = getSegment(3);
            $data['UID'] = $UID;
            $Crud = new Crud();
            $PAGE = $Crud->SingleeRecord('representatives', array("UID" => $UID));
            $data['PAGE'] = $PAGE;
            echo view('builder/main_form', $data);

        } elseif ($data['page'] == 'hospital') {
            echo view('builder/hospital', $data);

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
        $type = 'doctors';
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

    public function fetch_hospitals()
    {
        $BuilderModel = new BuilderModel();
        $PharmacyModal = new PharmacyModal();
        $type = 'hospitals';
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
            $city = $PharmacyModal->getcitybyid($record['City']);

            $data = [];
            $data[] = $cnt;
            $data[] = $record['Name'];
//            $data[] = '<img src="' . load_image('sponsors_' . $Sponsor) . '" height="45">';
            $data[] = $record['Email'];
            $data[] = $city[0]['FullName'];


            // SMS Credits Column
            $smsCredits = isset($SmsCredits[0]['Description']) && $SmsCredits[0]['Description'] != ''
                ? '<strong>' . $SmsCredits[0]['Description'] . '</strong> SMS Credits<br>
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
            <a class="dropdown-item" onclick="EditDoctors(' . $record['UID'] . ');">Edit</a>
            <a class="dropdown-item" onclick="DeleteHospital(' . htmlspecialchars($record['UID']) . ')">Delete</a>';

            if ($record['SubDomain'] != '') {
                $data[] .= '
            <a class="dropdown-item" href="http://' . $record['SubDomain'] . '/" target="_blank">Website Link</a>
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
    public function fetch_specialities()
    {
        $BuilderModel = new BuilderModel();
        $keyword = ( (isset($_POST['search']['value'])) ? $_POST['search']['value'] : '' );

        $Data = $BuilderModel->get_specialities_datatables($keyword);
        $totalfilterrecords = $BuilderModel->count_specialities_datatables($keyword);

//        print_r($totalfilterrecords);exit();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            if( $record['Icon'] != '' ){
                if( file_exists( ROOT."/upload/specialities/".$record['Icon'] ) ){
                    $file = $record['Icon'];
                }else{
                    $file ='no-image.png';
                }
            }else{
                $file ='no-image.png';

            }

            $TotalSpecialities=count($BuilderModel->get_speciality_images_by_id( $record['UID'] ));
//            print_r($TotalSpecialities);exit();
            $data = [];
            $data[] = $cnt;
            $data[] = $record['Name'];
            $data[] = '<img src="'. PATH .'upload/specialities/'.$file.'" height="45">';
            $data[] = isset($TotalSpecialities)?$TotalSpecialities:'0';


            $data[] = '
<td class="text-end">
    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Actions
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" onclick="Editspecialities(' . htmlspecialchars($record['UID']) . ');">Edit</a>
            <a class="dropdown-item" onclick="Deletespecialities(' . htmlspecialchars($record['UID']) . ');">Delete</a>
            <a class="dropdown-item" onclick="Addheading(' . htmlspecialchars($record['UID']) . ');">Add Heading</a>
            <a class="dropdown-item" onclick="AddMessage(' . htmlspecialchars($record['UID']) . ');">Add Message</a>
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
        $Crud->DeleteRecordPG('public."profiles"', array("UID" => $id));
        $Crud->DeleteRecordPG('public."profile_metas"', array("ProfileUID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = ' Deleted Successfully...!';
        echo json_encode($response);
    }

    public function delete_hospital()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
//        print_r($id);exit();
        $Crud->DeleteRecordPG('public."profiles"', array("UID" => $id));
        $Crud->DeleteRecordPG('public."profile_metas"', array("ProfileUID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = ' Deleted Successfully...!';
        echo json_encode($response);
    }
    public function delete_specialities()
    {
        $BuilderModel = new BuilderModel();
        $Crud = new Crud();
        $response = array();

        $id= $this->request->getVar('id');
       $record= $BuilderModel ->get_speciality_images_by_id($id);
        if(count($record) === 0)
        {

            $response['message'] = 'No Images Found';

        }
        else{
            foreach ($record as $r) {
                @unlink("upload/specialities/" . $r['Value']);
            }
            $Crud->DeleteRecord('public."speciality_metas"', array("SpecialityUID" => $id));

        }
        $Crud->DeleteRecord('specialities', array("UID" => $id));
        $response['status'] = 'success';
        $response['message'] .= ' And Specialities Deleted Successfully...!';
        echo json_encode($response);
    }
    public function delete_specialities_meta()
    {
        $BuilderModel = new BuilderModel();
        $Crud = new Crud();
        $response = array();

        $id= $this->request->getVar('id');

        $Crud->DeleteRecord('speciality_metas', array("UID" => $id));
        $response['status'] = 'success';
        $response['message'] = '  Specialities Meta Deleted Successfully...!';
        echo json_encode($response);
    }
    public function submit_general_image(){
        $Crud = new Crud();
        $alignment= $this->request->getVar('alignment');
        $color= $this->request->getVar('color');
        $speciality= $this->request->getVar('speciality');
//        print_r($alignment);exit();



    }
    public function get_specialities_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("specialities", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }

    public function add_telemedicine_credits()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
        $record = array();

        $newcredits = $_POST['newcredits'];
//        print_r($id);exit();
        $option = $Crud->SingleeRecord('public."options"', array("ProfileUID" => $id, 'Name' => 'telemedicine_credits'));
        $oldcredits = 0;
        if (isset($option['Description'])) {
            $oldcredits = $option['Description'];
        }


        $Crud->DeleteRecordPG('public."options"', array("ProfileUID" => $id, 'Name' => 'telemedicine_credits'));
        $record['ProfileUID'] = $id;
        $record['Name'] = 'telemedicine_credits';
        $record['Description'] = $oldcredits + $newcredits;
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
    public function submit_specialities()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response=array();
        $tag = $this->request->getVar('tag');
        $name = $this->request->getVar('name');
        $id = $this->request->getVar('UID');
        $icon = '';
        if ($_FILES['icon']['tmp_name'] != '') {
            $ext = @end(@explode(".", basename($_FILES['icon']['name'])));
            $uploaddir = ROOT . "/upload/specialities/";
            $uploadfile = strtolower($Main->RandFileName() . "." . $ext);

            if (move_uploaded_file($_FILES['icon']['tmp_name'], $uploaddir . $uploadfile)) {
                $icon = $uploadfile;
            }
        }

        if ($id == 0) {
            $record['Tag'] = $tag;
            $record['Name'] = $name;

            if ($icon != "") {
                $record['Icon'] = $icon;
            }
//            print_r($record);exit();

            $RecordId = $Crud->AddRecord("specialities", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = ' Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        }
        else {
            $record['Tag'] = $tag;
            $record['Name'] = $name;

            if ($icon != "") {
                $record['Icon'] = $icon;


            }
            $Crud->UpdateRecord("specialities", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = ' Updated Successfully...!';
        }
        echo json_encode($response);

    }
    public function submit_specialities_meta()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response=array();
        $id = $this->request->getVar('UID');
        $SpecialityID = $this->request->getVar('SpecialityID');
        $meta = $this->request->getVar('meta');
        $name = $this->request->getVar('name');

        if ($id == 0) {
            $record['SpecialityUID'] = $SpecialityID;
            $record['Option'] = $meta;
            $record['Value'] = $name;



            $RecordId = $Crud->AddRecord("speciality_metas", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = ' Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        }
        else {
            $record['SpecialityUID'] = $SpecialityID;
            $record['Option'] = $meta;
            $record['Value'] = $name;
            $Crud->UpdateRecord("speciality_metas", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = ' Updated Successfully...!';
        }
        echo json_encode($response);

    }
    public function add_sms_credits()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
        $record = array();

        $newcredits = $_POST['newcredits'];
        $option = $Crud->SingleeRecord('public."options"', array("ProfileUID" => $id, 'Name' => 'sms_credits'));
        $oldcredits = 0;
        if (isset($option['Description'])) {
            $oldcredits = $option['Description'];
        }
        $Crud->DeleteRecordPG('public."options"', array("ProfileUID" => $id, 'Name' => 'sms_credits'));
        $record['ProfileUID'] = $id;
        $record['Name'] = 'sms_credits';
        $record['Description'] = $oldcredits + $newcredits;
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

    public function hospitals_profile_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();
        $records = array();
        $id = $this->request->getVar('UID');
        $email = $this->request->getVar('email');
        $ContactNo = $this->request->getVar('ContactNo');
//        $file = file_get_contents($_FILES['profile']['tmp_name']);
//        echo 'dddddd';exit();
        if ($id == 0) {
            $Data = $Crud->SingleeRecord('public."profiles"', array("Email" => $email, 'ContactNo' => $ContactNo));

            if (!empty($Data) && $Data['UID'] > 0) {
                if ($Data['ContactNo'] == $ContactNo) {

                    $responce = array();
                    $responce['status'] = 'fail';
                    $responce['message'] = '<strong>Contact No</strong> Already Assign to <strong>' . (($Data['SubDomain'] != '') ? $Data['SubDomain'] : $Data['Name']) . '</strong> ...!';
                    echo json_encode($responce);

                } else if ($Data['Email'] == $email) {

                    $responce = array();
                    $responce['status'] = 'fail';
                    $responce['message'] = '<strong>Email</strong> Already Assign to <strong>' . (($Data['SubDomain'] != '') ? $Data['SubDomain'] : $Data['Name']) . '</strong> ...!';
                    echo json_encode($responce);
                }

            } else {
                $subdomain = $this->request->getVar('sub_domain');
                $record['Type'] = 'hospitals';
                $record['Name'] = $this->request->getVar('name');
                $record['Email'] = $this->request->getVar('email');
                $record['Password'] = $this->request->getVar('password');
                $record['City'] = $this->request->getVar('city');
                $record['ContactNo'] = $this->request->getVar('ContactNo');
                $record['SubDomain'] = $subdomain;
                $file = '';
                if ($file != '') {
                    $record['Profile'] = base64_encode($file);

                } else {
                    $record['Profile'] = '';

                }
                $website_profile_id = $Crud->AdddRecord("public.profiles", $record);

                if ($website_profile_id) {
                    $theme = $this->request->getVar('theme');
                    $Options = array('theme_css' => 'dore.light.red.css', 'theme' => ((isset($theme) && $theme != '') ? $theme : ''), 'sms_credits' => 100, 'notify_sms' => 1, 'notify_email' => 1);
                    foreach ($Options as $key => $value) {

                        if ($value != '') {
                            $record_option['ProfileUID'] = $website_profile_id;
                            $record_option['Name'] = $key;
                            $record_option['Description'] = $value;

                            $id = $Crud->AdddRecord("public.options", $record_option);
                        }
                    }
                    $ExtendedArray = array('clinta_extended_profiles', 'short_description');
                    foreach ($ExtendedArray as $M) {

                        if ($this->request->getVar($M) != '') {

                            $record_meta['ProfileUID'] = $website_profile_id;
                            $record_meta['Option'] = $M;
                            $record_meta['Value'] = $this->request->getVar($M);

                            $id = $Crud->AdddRecord("public.profile_metas", $record_meta);

                        }
                    }

                    $message = 'Dear Clinta Support,
"' . $this->request->getVar('name') . '" New Hospital Added Successfully in Clinta Apanel,
Please Assign SubDomain.';
                    $Main->send('03155913609', $message);


                    if (isset($subdomain) && $subdomain != '') {
                        $mobile = $this->request->getVar('contact_no');
                        $message = 'Dear ' . $this->request->getVar('name') . ',
Congratulations, your own website has been created.
URL: http://' . $subdomain . '
Email: ' . $this->request->getVar('email') . '
Password: ' . $this->request->getVar('password');
                        $Main->send($mobile, $message);
                    }


                    $data = array();
                    $data['status'] = "success";
                    $data['id'] = $website_profile_id;
                    $data['message'] = "Hospitals Profile Added Successfully.....!";
                    echo json_encode($data);


                } else {

                    $data = array();
                    $data['status'] = "fail";
                    $data['message'] = "Error in Adding Hospitals Profile...!";
                    echo json_encode($data);
                }
            }

        } else {
            $Data = $Crud->SingleeRecord('public."profiles"', array("Email" => $email, 'ContactNo' => $ContactNo));

            if (!empty($Data) && $Data['UID'] > 0) {
                if ($Data['ContactNo'] == $ContactNo) {

                    $responce = array();
                    $responce['status'] = 'fail';
                    $responce['message'] = '<strong>Contact No</strong> Already Assign to <strong>' . (($Data['SubDomain'] != '') ? $Data['SubDomain'] : $Data['Name']) . '</strong> ...!';
                    echo json_encode($responce);

                } else if ($Data['Email'] == $email) {

                    $responce = array();
                    $responce['status'] = 'fail';
                    $responce['message'] = '<strong>Email</strong> Already Assign to <strong>' . (($Data['SubDomain'] != '') ? $Data['SubDomain'] : $Data['Name']) . '</strong> ...!';
                    echo json_encode($responce);
                }

            } else {

                $subdomain = $this->request->getVar('sub_domain');
                $record['Type'] = 'hospitals';
                $record['Name'] = $this->request->getVar('name');
                $record['Email'] = $this->request->getVar('email');
                $record['Password'] = $this->request->getVar('password');
                $record['City'] = $this->request->getVar('city');
                $record['ContactNo'] = $this->request->getVar('ContactNo');
                $record['SubDomain'] = $subdomain;
                $file = '';
                if ($file != '') {
                    $record['Profile'] = base64_encode($file);

                }
                $website_profile_id = $Crud->UpdateeRecord("public.profiles", $record, array('UID' => $id));

                if ($website_profile_id) {
                    $ExtendedArray = array('clinta_extended_profiles', 'short_description', 'healthcare_status', 'patient_portal');
                    foreach ($ExtendedArray as $EA) {
                        $Crud->DeleteRecordPG('public."profile_metas"', array("ProfileUID" => $id, 'Option' => $EA));
                    }

                    foreach ($ExtendedArray as $M) {

                        if ($this->request->getVar($M) != '') {

                            $record_meta['ProfileUID'] = $website_profile_id;
                            $record_meta['Option'] = $M;
                            $record_meta['Value'] = $this->request->getVar($M);

                            $id = $Crud->AdddRecord("public.profile_metas", $record_meta);

                        }
                    }
                    $theme = $this->request->getVar('theme');
                    $Options = array('theme_css' => 'dore.light.red.css', 'theme' => ((isset($theme) && $theme != '') ? $theme : ''), 'sms_credits' => 100, 'notify_sms' => 1, 'notify_email' => 1);


                    foreach ($Options as $key => $value) {

                        if ($value != '') {
                            $Data = $Crud->SingleeRecord('public."options"', array("ProfileUID" => $website_profile_id, 'Name' => $key));
                            if (isset($Data['UID'])) {
                                $record_option['Description'] = $value;
                                $website_profile_id = $Crud->UpdateeRecord("public.options", $record_option, array('UID' => $Data['UID']));

                            } else {
                                $record_option['Description'] = $value;
                                $record_option['Name'] = $key;
                                $record_meta['ProfileUID'] = $id;

                                $id = $Crud->AdddRecord("public.options", $record_option);

                            }
                            $data = array();
                            $data['status'] = "success";
                            $data['id'] = $id;
                            $data['message'] = "Hospitals Profile Updated Suuccessfully.....!";
                            echo json_encode($data);
                        } else {

                            $data = array();
                            $data['status'] = "fail";
                            $data['message'] = "Error in Updating Hospitals Profile...!";
                            echo json_encode($data);
                        }


                    }
                }

            }

        }


    }


    public function doctors_profile_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();
        $records = array();
        $record_meta = array();
        $logo_record = array();
        $record_option = array();
        $id = $this->request->getVar('UID');
        $email = $this->request->getVar('email');
        $ContactNo = $this->request->getVar('ContactNo');

        $file = file_get_contents($_FILES['profile']['tmp_name']);
        echo 'dddd';
        exit();

        if ($id == 0) {

            $Data = $Crud->SingleeRecord('public."profiles"', array("Email" => $email, 'ContactNo' => $ContactNo));

            if (!empty($Data) && $Data['UID'] > 0) {
                if ($Data['ContactNo'] == $ContactNo) {

                    $responce = array();
                    $responce['status'] = 'fail';
                    $responce['message'] = '<strong>Contact No</strong> Already Assign to <strong>' . (($Data['SubDomain'] != '') ? $Data['SubDomain'] : $Data['Name']) . '</strong> ...!';
                    echo json_encode($responce);

                } else if ($Data['Email'] == $email) {

                    $responce = array();
                    $responce['status'] = 'fail';
                    $responce['message'] = '<strong>Email</strong> Already Assign to <strong>' . (($Data['SubDomain'] != '') ? $Data['SubDomain'] : $Data['Name']) . '</strong> ...!';
                    echo json_encode($responce);
                }

            } else {


                $subdomain = $this->request->getVar('sub_domain');
                $AdminDomain = $this->request->getVar('AdminDomain');
//                $pgsql->trans_start();
//                $pgsql->set('Type', 'doctors');
//                $pgsql->set('Name', $this->request->getVar('name'));
//                $pgsql->set('Email', $this->request->getVar('email'));
//                $pgsql->set('Password', $this->request->getVar('password'));
//                $pgsql->set('City', $this->request->getVar('city'));
//                $pgsql->set('ContactNo', $this->request->getVar('ContactNo'));
//                $pgsql->set('SubDomain', $subdomain);
//                $pgsql->set('AdminDomain', $AdminDomain);
                $record['Type'] = 'doctors';
                $record['Name'] = $this->request->getVar('name');
                $record['Email'] = $this->request->getVar('email');
                $record['Password'] = $this->request->getVar('password');
                $record['City'] = $this->request->getVar('city');
                $record['ContactNo'] = $this->request->getVar('ContactNo');
                $record['SubDomain'] = $subdomain;
                $record['AdminDomain'] = $AdminDomain;

                if ($file != '') {
                    $record['Profile'] = base64_encode($file);

//                    $pgsql->set('Profile', base64_encode($file));

                } else {
                    $record['Profile'] = '';

//                    $pgsql->set('Profile', '');
                }
                $website_profile_id = $Crud->AdddRecord("public.profiles", $record);

                if ($website_profile_id) {

//                    $website_profile_id = $pgsql->insert_id();
//                    $pgsql->trans_complete();

                    $logos = array('sponsored_logo', 'initatived_logo');

                    foreach ($logos as $log) {

                        $file = $Main->upload_image($log, 1024);

                        if ($file != '') {
                            $records['ProfileUID'] = $website_profile_id;
                            $records['Option'] = $log;
                            $records['Value'] = $file;


                            $id = $Crud->AdddRecord("public.profile_metas", $records);


                        }
                    }


                    $Metas = array('speciality', 'qualification', 'pmdcno', 'department', 'short_description', 'telemedicine_id', 'initatived_text', 'healthcare_status', 'patient_portal');

                    foreach ($Metas as $M) {

                        if ($this->request->getVar($M) != '') {

                            $record_meta['ProfileUID'] = $website_profile_id;
                            $record_meta['Option'] = $M;
                            $record_meta['Value'] = $this->request->getVar($M);

                            $id = $Crud->AdddRecord("public.profile_metas", $record_meta);

                        }
                    }

                    $Sponsor = $this->request->getVar('sponsor');
                    $theme = $this->request->getVar('theme');
                    $Options = array('award_nav' => 'show', 'patient_nav' => 'show', 'research_nav' => 'show', 'theme_css' => 'dore.light.red.css', 'custom_banners' => '5', 'theme' => ((isset($theme) && $theme != '') ? $theme : ''), 'sms_credits' => 100, 'notify_sms' => 1, 'notify_email' => 1, 'sponsor' => ((isset($Sponsor) && $Sponsor != '') ? $Sponsor : ''));

//                    'theme_css' => 'dore.light.red.css',

                    foreach ($Options as $key => $value) {

                        if ($value != '') {
                            $record_option['ProfileUID'] = $website_profile_id;
                            $record_option['Name'] = $key;
                            $record_option['Description'] = $value;

                            $id = $Crud->AdddRecord("public.options", $record_option);
//                            $pgsql->trans_start();
//                            $pgsql->set('ProfileUID', $website_profile_id);
//                            $pgsql->set('Name', $key);
//                            $pgsql->set('Description', $value);
//                            $pgsql->insert('public.options');
//                            $pgsql->trans_complete();
                        }
                    }

                    $message = 'Dear Clinta Support,
"' . $this->request->getVar('name') . '" New Doctor Added Successfully in Clinta Apanel,
Please Assign SubDomain.';

                    $Main->send('03155913609', $message);


                    if (isset($subdomain) && $subdomain != '') {
                        $mobile = $this->request->getVar('ContactNo');
                        $message = 'Dear ' . $this->request->getVar('name') . ',
Congratulations, your own website has been created.
URL: http://' . $subdomain . '
Email: ' . $this->request->getVar('email') . '
Password: ' . $this->request->getVar('password');
                        $Main->send($mobile, $message);
                    }

                    $data = array();
                    $data['status'] = "success";
                    $data['id'] = $website_profile_id;
                    $data['message'] = "Doctor Profile Added Suuccessfully.....!";
                    echo json_encode($data);


                } else {

                    $data = array();
                    $data['status'] = "fail";
                    $data['message'] = "Error in Adding Doctors Profile...!";
                    echo json_encode($data);
                }

            }

        } else {
            $Data = $Crud->SingleeRecord('public."profiles"', array("Email" => $email, 'ContactNo' => $ContactNo));
            if ($Data['UID'] > 0) {
                if ($Data['ContactNo'] == $ContactNo) {

                    $responce = array();
                    $responce['status'] = 'fail';
                    $responce['message'] = '<strong>Contact No</strong> Already Assign to <strong>' . (($Data['SubDomain'] != '') ? $Data['SubDomain'] : $Data['Name']) . '</strong> ...!';
                    echo json_encode($responce);

                } else if ($Data['Email'] == $email) {

                    $responce = array();
                    $responce['status'] = 'fail';
                    $responce['message'] = '<strong>Email</strong> Already Assign to <strong>' . (($Data['SubDomain'] != '') ? $Data['SubDomain'] : $Data['Name']) . '</strong> ...!';
                    echo json_encode($responce);
                }

            } else {

                $subdomain = $this->request->getVar('sub_domain');
                $AdminDomain = $this->request->getVar('AdminDomain');
                $record['Type'] = 'doctors';
                $record['Name'] = $this->request->getVar('name');
                $record['Email'] = $this->request->getVar('email');
                $record['Password'] = $this->request->getVar('password');
                $record['City'] = $this->request->getVar('city');
                $record['ContactNo'] = $this->request->getVar('ContactNo');
//                $pgsql->trans_start();
//                $pgsql->set('Type', 'doctors');
//                $pgsql->set('Name', $this->request->getVar('name'));
//                $pgsql->set('Email', $this->request->getVar('email'));
//                $pgsql->set('Password', $this->request->getVar('password'));
//                $pgsql->set('City', $this->request->getVar('city'));
//                $pgsql->set('ContactNo', $this->request->getVar('ContactNo'));
                if (isset($AdminDomain) && $AdminDomain != '') {

                    $record['AdminDomain'] = $AdminDomain;

                }
                if (isset($subdomain) && $subdomain != '') {
                    $record['SubDomain'] = $subdomain;

                    $mobile = $this->request->getVar('ContactNo');
                    $message = 'Dear ' . $this->request->getVar('name') . ',
Congratulations, your own website has been created.
URL: http://' . $subdomain . '
Email: ' . $this->request->getVar('email') . '
Password: ' . $this->request->getVar('password');
                    $Main->send($mobile, $message);
                }
                if ($file != '') {
                    $record['Profile'] = base64_encode($file);
                }
                $updateid = $Crud->UpdateeRecord("public.profiles", $record, array('UID' => $id));

//                $pgsql->where('UID', $id);
                if ($updateid > 0) {
//                    $pgsql->trans_complete();

                    ////////////////////////Profile Metas Delete Query///////////////////////////////////
                    /*$pgsql->trans_start();
                    $pgsql->where('ProfileUID', $id);
                    $pgsql->where('Option !=', 'initatived_logo');
                    $pgsql->where('Option !=', 'parent_id');
                    $pgsql->where('Option !=', 'note');
                    $pgsql->delete('public.profile_metas');
                    $pgsql->trans_complete();*/
                    ////////////////////////End///////////////////////////////////

                    ////////////////////////Sponsor Segment///////////////////////////////////
                    $Sponsor = $this->request->getVar('sponsor');
                    if (isset($Sponsor) && $Sponsor != '') {
                        $sql = 'SELECT * FROM public."options" WHERE ProfileUID = ' . $id . ' AND Name = \'sponsor\'';
                        $SponsorData = $Crud->ExecutePgSQL($sql);

//                        $pgsql->trans_start();
//                        $pgsql->select('UID');
//                        $pgsql->from('public.options');
//                        $pgsql->where('ProfileUID', $id);
//                        $pgsql->where('Name', 'sponsor');
//                        $query = $pgsql->get();
//                        $SponsorData = $query->row_array();
//                        $pgsql->trans_complete();
                        if (isset($SponsorData['UID'])) {
                            $updateid = $Crud->UpdateeRecord("public.options", array('Description' => $Sponsor), array('UID' => $SponsorData['UID']));

//                            $pgsql->trans_start();
//                            $pgsql->set('Description', $Sponsor);
//                            $pgsql->where('UID', $SponsorData['UID']);
//                            $pgsql->update('public.options');
//                            $pgsql->trans_complete();

                        } else {
                            $record_option['Description'] = $Sponsor;
                            $record_option['Name'] = 'sponsor';
                            $record_option['ProfileUID'] = $id;
                            $id = $Crud->AdddRecord("public.options", $record_option);

//                            $pgsql->trans_start();
//                            $pgsql->set('ProfileUID', $id);
//                            $pgsql->set('Name', 'sponsor');
//                            $pgsql->set('Description', $Sponsor);
//                            $pgsql->insert('public.options');
//                            $pgsql->trans_complete();
                        }
                    }
                    ////////////////////////Sponsor Segment END///////////////////////////////////

                    $Metas = array('speciality', 'qualification', 'pmdcno', 'department', 'short_description', 'telemedicine_id', 'initatived_text', 'healthcare_status');
                    foreach ($Metas as $M) {
                        if ($this->request->getVar($M) != '') {
                            $sql = 'SELECT * FROM public."profile_metas" WHERE ProfileUID = ' . $id . ' AND Option =' . $M . ' ';
                            $ProfileMetaData = $Crud->ExecutePgSQL($sql);
//                            $pgsql->trans_start();
//                            $pgsql->select('UID');
//                            $pgsql->from('public.profile_metas');
//                            $pgsql->where('ProfileUID', $id);
//                            $pgsql->where('Option', $M);
//                            $query = $pgsql->get();
//                            $ProfileMetaData = $query->row_array();
//                            $pgsql->trans_complete();
                            if (isset($ProfileMetaData['UID'])) {
                                $updateid = $Crud->UpdateeRecord("public.profile_metas", array('Value' => $this->request->getVar($M)), array('UID' => $ProfileMetaData['UID']));

//                                $pgsql->trans_start();
//                                $pgsql->set('Value', $this->request->getVar($M));
//                                $pgsql->where('UID', $ProfileMetaData['UID']);
//                                $pgsql->update('public.profile_metas');
//                                $pgsql->trans_complete();

                            } else {
                                $record_option['Value'] = $this->request->getVar($M);
                                $record_option['Option'] = $M;
                                $record_option['ProfileUID'] = $id;
                                $id = $Crud->AdddRecord("public.profile_metas", $record_option);

//                                $pgsql->trans_start();
//                                $pgsql->set('ProfileUID', $id);
//                                $pgsql->set('Option', $M);
//                                $pgsql->set('Value', $this->request->getVar($M));
//                                $pgsql->insert('public.profile_metas');
//                                $pgsql->trans_complete();
                            }
                        }
                    }

                    ///////////////////////////Check option///////////////////////////////////

                    $theme = $this->request->getVar('theme');
                    $Options = array('theme' => ((isset($theme) && $theme != '') ? $theme : ''));
                    $Options_record = array();
                    foreach ($Options as $key => $value) {

                        if ($value != '') {
                            $Data = $Crud->SingleeRecord('public."options"', array("ProfileUID" => $id, 'Name' => $key));

//                            $pgsql->trans_start();
//                            $pgsql->select('*');
//                            $pgsql->from('public.options');
//                            $pgsql->where('ProfileUID', $id);
//                            $pgsql->where('Name', $key);
//                            $query = $pgsql->get();
//                            $Data = $query->row_array();
//                            $pgsql->trans_complete();

                            if (isset($Data['UID'])) {
                                $updateid = $Crud->UpdateeRecord("public.options", array('Description' => $value), array('UID' => $Data['UID']));

                            } else {
                                $Options_record['Description'] = $value;
                                $Options_record['Name'] = $key;
                                $Options_record['ProfileUID'] = $id;
                                $id = $Crud->AdddRecord("public.options", $Options_record);

//                                $pgsql->trans_start();
//                                $pgsql->set('ProfileUID', $id);
//                                $pgsql->set('Name', $key);
//                                $pgsql->set('Description', $value);
//                                $pgsql->insert('public.options');
//                                $pgsql->trans_complete();
                            }
                        }
                    }


                    ///////////////////////////Check Sponsor OR Initatived Logo///////////////////////////////////

                    $logos = array('initatived_logo');
                    //print_r($_FILES );exit;
                    foreach ($logos as $log) {
                        //echo $_FILES[ $log ][ 'name' ];
                        if ($_FILES[$log]['name'] != '') {
                            $Data = $Crud->SingleeRecord('public."profile_metas"', array("ProfileUID" => $id, 'Option' => $log));

//                            $pgsql->trans_start();
//                            $pgsql->select('*');
//                            $pgsql->from('public.profile_metas');
//                            $pgsql->where('ProfileUID', $id);
//                            $pgsql->where('Option', $log);
//                            $query = $pgsql->get();
//                            $Data = $query->row_array();
                            //echo $pgsql->last_query();
//                            $pgsql->trans_complete();
                            //print_r( $Data ); exit;

                            if (isset($Data['UID'])) {

                                $file = $Main->upload_image($log, 1024);
//                                $pgsql->trans_start();
                                $updateid = $Crud->UpdateeRecord("public.profile_metas", array('Value' => $file), array('UID' => $Data['UID']));

//                                $pgsql->set('Value', $file);
//                                $pgsql->where('UID', $Data['UID']);
//                                $pgsql->update('public.profile_metas');
                                //echo $pgsql->last_query();
//                                $pgsql->trans_complete();


                            } else {

                                $file = $Main->upload_image($log, 1024);
                                $logo_record['Value'] = $file;
                                $logo_record['Option'] = $log;
                                $logo_record['ProfileUID'] = $id;
                                $id = $Crud->AdddRecord("public.profile_metas", $logo_record);

//                                $pgsql->trans_start();
//                                $pgsql->set('ProfileUID', $id);
//                                $pgsql->set('Option', $log);
//                                $pgsql->set('Value', $file);
//                                //$pgsql->set( 'Value', 'xxxxxxxx' );
//                                $pgsql->insert('public.profile_metas');
//                                //echo $pgsql->last_query();
//                                $pgsql->trans_complete();

                            }
                        }

                    }

                    //////////////////////End///////////////////////////////////


                    $data = array();
                    $data['status'] = "success";
                    $data['id'] = $id;
                    $data['message'] = "Doctors Profile Updated Suuccessfully.....!";
                    echo json_encode($data);
                } else {

                    $data = array();
                    $data['status'] = "fail";
                    $data['message'] = "Error in Updating Doctors Profile...!";
                    echo json_encode($data);
                }

            }


        }


        echo json_encode($response);
    }
    public
    function load_speciality_metas_data_grid(){
        $BuilderModel = new BuilderModel();

        $id = $this->request->getVar( 'id' );
        $option = $this->request->getVar( 'option' );
//            print_r($option);exit();
        $Data = $BuilderModel->get_speciality_meta_data_by_id_option( $id , $option); //print_r($id); exit;
//            print_r($option);exit();
        if( count( $Data ) > 0 ){

            $html = '';

            $html.='<div class="col-md-12">
							<div class="table table-responcive">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="30">Sr.No</th>
											<th>Name</th>
											<th width="40">Action</th>
										</tr>
									</thead>
									<tbody>';
            $cnt = 0;
            foreach( $Data as $D ){
                $cnt++;
                $html.='<tr>
															<td>'.$cnt.'</td>
															<td>'.$D['Value'].'</td>
															<td><a href="javascript:void(0);" onclick="DeleteSpecialityMetas( '.$D['UID'].' );"><i style="color:red;" class="fa fa-trash"></i></a></td>
														</tr>';
            }

            $html.='</tbody>
								</table>
							</div>
						</div>';
        }
        else{
            $html=' No records found';
        }

        echo $html;
    }


}