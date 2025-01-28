<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\DiscountModel;
use App\Models\InvestigationModel;
use App\Models\LookupModal;
use App\Models\Main;
use App\Models\SystemUser;

class Discount extends BaseController
{
    var $data = array();

    public function __construct()
    {

        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
    }

    public function discount_center()
    {
        $data = $this->data;
        $data['page'] = getSegment(3);
        $LookupOptionData = new Main();
        $DiscountModel = new DiscountModel();
        echo view('header', $data);
        $data['Specialities'] = $DiscountModel->get_speciality_data();

        if ($data['page'] == 'add-discount') {

            $data['PAGE'] = array();
            $Crud = new Crud();
            echo view('discount/main_form', $data);

        } else if ($data['page'] == 'update-discount') {
            $UID = getSegment(4);
//            print_r($UID);exit();
            $data['UID'] = $UID;
            $Crud = new Crud();
            $PAGE = $Crud->SingleRecord('discount_center', array("UID" => $UID));
            $data['Images'] = $DiscountModel->GetDiscountCenterImagesByID($UID);

            $data['Data'] = $PAGE;
            echo view('discount/update_discount_main_form', $data);

        } else {

            echo view('discount/index', $data);

        }


        echo view('footer', $data);
    }

    public function discount_center_offer()
    {
        $data = $this->data;
        $data['UID'] = getSegment(3);
        echo view('header', $data);
        $LookupOptionData = new Main();

        $data['Group'] = $LookupOptionData->LookupsOption("discount_group", 0);

        echo view('discount/discount_offer', $data);


        echo view('footer', $data);
    }

    public function discount_center_doctor()
    {
        $data = $this->data;
        $data['UID'] = getSegment(3);
//        print_r( $data['UID'] );exit();

        echo view('header', $data);
        echo view('discount/discount_center_doctor', $data);
        echo view('footer', $data);
    }

    public function discount_center_doctor_form()
    {
        $data = $this->data;
        $data['UID'] = getSegment(4);
        $data['page'] = getSegment(3);
        echo view('header', $data);

        if ($data['page'] == 'update-doctor') {
            $ID = getSegment(4);
//            print_r($UID);exit();
            $data['ID'] = $ID;
            $Crud = new Crud();
            $PAGE = $Crud->SingleRecord('discount_center_doctors', array("UID" => $ID));
            $data['Data'] = $PAGE;
            echo view('discount/discount_doc_update_form', $data);

        } else {
            $data['PAGE'] = array();


            echo view('discount/discount_doctor_main_form', $data);
        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('investigation/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_discount()
    {
        $DiscountModel = new DiscountModel();
        $Lookup = new LookupModal();
        $system = new SystemUser();


        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');

        $Data = $DiscountModel->get_discount_datatables($keyword);
//        print_r($Data);exit();
        $totalfilterrecords = $DiscountModel->count_discount_datatables($keyword);

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $Actions = [];

            if( $system->checkAccessKey('healthcare_discount_update') )
                $Actions[] = '<a class="dropdown-item" onclick="EditDiscountCenter(' . htmlspecialchars($record['UID']) . ')">Update</a>';
            if( $system->checkAccessKey('healthcare_discount_delete') )
                $Actions[] = '<a class="dropdown-item" onclick="DeleteDiscountCenter(' . htmlspecialchars($record['UID']) . ')">Delete</a>';
 if( $system->checkAccessKey('healthcare_discount_offer_list') )
                $Actions[] = '<a class="dropdown-item" onclick="discount_offer(' . htmlspecialchars($record['UID']) . ')">Update</a>';
            if( $system->checkAccessKey('healthcare_discount_center_doctor_list') )
                $Actions[] = '<a class="dropdown-item" onclick="discount_center_doctor(' . htmlspecialchars($record['UID']) . ')">Delete</a>';

            $data[] = isset($record['Department']) ? htmlspecialchars($record['Department']) : '';

            $data[] = isset($record['Image'])
                ? "<img src='" . load_image('mysql|discount_center|' . $record['UID']) . "' style='display: block; padding: 2px; border: 1px solid #145388 !important; border-radius: 3px; width: 150px;' />"
                : '';
            $data[] = isset($record['Title']) ? htmlspecialchars($record['Title']) : '';
            $data[] = isset($record['Address']) ? htmlspecialchars($record['Address']) : '';
            $data[] = isset($record['Services']) ? htmlspecialchars($record['Services']) : '';
            $data[] = isset($record['BasicDiscount']) ? htmlspecialchars($record['BasicDiscount']) : '';
            $data[] = isset($record['PremiumDiscount']) ? htmlspecialchars($record['PremiumDiscount']) : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
                                    <div class="dropdown-menu">' . implode(" ", $Actions) . '</div>

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

    public function fetch_discount_doctor()
    {
        $DiscountModel = new DiscountModel();
        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');
        $ID = $this->request->getVar('UID');

        $Data = $DiscountModel->get_datatables_discount_doctor($ID, $keyword);
        $totalfilterrecords = $DiscountModel->count_datatables_discount_doctor($ID, $keyword);

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="' . PATH . 'upload/doctors/' . $record['Image'] . '" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="' . PATH . 'upload/doctors/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['Qualification']) ? htmlspecialchars($record['Qualification']) : '';
            $data[] = isset($record['Speciality']) ? htmlspecialchars($record['Speciality']) : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateDiscountDoctor(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="DeleteDiscountDoctor(' . htmlspecialchars($record['UID']) . ')">Delete</a>
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

    public function fetch_discount_offer()

    {
        $DiscountModel = new DiscountModel();
        $Lookup = new LookupModal();

        $ID = $this->request->getVar('UID');

        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');

        $Data = $DiscountModel->get_datatables_discount_offer($ID, $keyword);
        $totalfilterrecords = $DiscountModel->count_datatables_discount_offer($ID, $keyword);

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Group = $Lookup->LookupOptionBYID($record['Group']);

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($Group[0]['Name']) ? htmlspecialchars($Group[0]['Name']) : '';
            $data[] = isset($record['ServiceName']) ? htmlspecialchars($record['ServiceName']) : '';
            $data[] = isset($record['CurrentPrice']) ? htmlspecialchars($record['CurrentPrice']) : '';
            $data[] = isset($record['BasicDiscount']) ? htmlspecialchars($record['BasicDiscount']) : '';
            $data[] = isset($record['PremiumDiscount']) ? htmlspecialchars($record['PremiumDiscount']) : '';

            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="EditDiscountCenterOffer(\'' . htmlspecialchars($record['UID']) . '\', \'' . htmlspecialchars($ID) . '\')">Update</a>
                <a class="dropdown-item" onclick="DeleteDiscountCenterOffer(' . htmlspecialchars($record['UID']) . ')">Delete</a>

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


    public function discount_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();

        $id = $this->request->getVar('id');
//        $logedInUserName = $_SESSION('UserName');
        $title = $this->request->getVar('title');
        $department = $this->request->getVar('department');

        $record = [
            'Department' => $department,
            'Title' => $title,
            'ContactEmail' => $this->request->getVar('email'),
            'Website' => $this->request->getVar('website'),
            'ContactNumbers' => $this->request->getVar('contactno'),
            'Address' => $this->request->getVar('address'),
            'Services' => '',
            'Facilities' => $this->request->getVar('facilities'),
            'ShortHistory' => $this->request->getVar('short_history'),
            'BasicDiscount' => $this->request->getVar('basic_discount'),
            'PremiumDiscount' => $this->request->getVar('premium_discount'),
            'OrderID' => $this->request->getVar('order_id')
        ];

        if ($_FILES['profile_image']['tmp_name'] != '') {
            $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
            $uploadDir = ROOT . "/upload/discount/";
            $fileName = strtolower($Main->RandFileName() . "." . $ext);

            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadDir . $fileName)) {
                $record['Image'] = $fileName;
            }
        }

        if ($id == 0) {
            $discountCenterId = $Crud->AddRecord("discount_center", $record);

            if ($discountCenterId > 0) {
                // Specialities Handling
                $specialities = $this->request->getVar('specialities');
                if (!empty($specialities)) {
                    foreach ($specialities as $speciality) {
                        $specialityRecord = [
                            'DiscountCenterUID' => $discountCenterId,
                            'Speciality' => $speciality
                        ];
                        $Crud->AddRecord("discount_center_specialities", $specialityRecord);
                    }
                }

                // Timings Handling
                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                $startTimes = $this->request->getVar('start_time');
                $endTimes = $this->request->getVar('end_time');

                foreach ($days as $day) {
                    if (!empty($startTimes[$day]) && !empty($endTimes[$day])) {
                        $timingRecord = [
                            'DiscountCenterID' => $discountCenterId,
                            'Weekday' => $day,
                            'StartTime' => $startTimes[$day],
                            'EndTime' => $endTimes[$day]
                        ];
                        $Crud->AddRecord("discount_center_timings", $timingRecord);
                    }
                }

                // Images Handling
                if (!empty($_FILES['image']['name'][0])) {
                    $sortOrders = $this->request->getVar('sort_order');
                    $files = $_FILES['image'];
                    for ($i = 0; $i < count($files['name']); $i++) {
                        $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                        $fileName = strtolower($Main->RandFileName() . "." . $ext);

                        if (move_uploaded_file($files['tmp_name'][$i], $uploadDir . $fileName)) {
                            $imageRecord = [
                                'DiscountCenterID' => $discountCenterId,
                                'Image' => $fileName,
                                'SortOrder' => $sortOrders[$i]
                            ];
                            $Crud->AddRecord("discount_center_images", $imageRecord);
                        }
                    }
                }

                $response['status'] = 'success';
                $response['message'] = 'Discount Center Added Successfully!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Error Adding Discount Center!';
            }
        } else {
            $Crud->UpdateRecord("discount_center", $record, ['UID' => $id]);
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

            // Update Specialities
            $Crud->DeleteRecord("discount_center_specialities", ['DiscountCenterUID' => $id]);
            $specialities = $this->request->getVar('specialities');
            if (!empty($specialities)) {
                foreach ($specialities as $speciality) {
                    $specialityRecord = [
                        'DiscountCenterUID' => $id,
                        'Speciality' => $speciality
                    ];
                    $Crud->AddRecord("discount_center_specialities", $specialityRecord);
                }
            }

            // Update Timings
            $Crud->DeleteRecord("discount_center_timings", ['DiscountCenterID' => $id]);
            foreach ($days as $day) {
                if (!empty($startTimes[$day]) && !empty($endTimes[$day])) {
                    $timingRecord = [
                        'DiscountCenterID' => $id,
                        'Weekday' => $day,
                        'StartTime' => $startTimes[$day],
                        'EndTime' => $endTimes[$day]
                    ];
                    $Crud->AddRecord("discount_center_timings", $timingRecord);
                }
            }

            // Update Images
            if (!empty($_FILES['image']['name'][0])) {
                for ($i = 0; $i < count($files['name']); $i++) {
                    $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                    $fileName = strtolower($Main->RandFileName() . "." . $ext);

                    if (move_uploaded_file($files['tmp_name'][$i], $uploadDir . $fileName)) {
                        $imageRecord = [
                            'DiscountCenterID' => $id,
                            'Image' => $fileName,
                            'SortOrder' => $sortOrders[$i]
                        ];
                        $Crud->AddRecord("discount_center_images", $imageRecord);
                    }
                }
            }

            $response['status'] = 'success';
            $response['message'] = 'Discount Center Updated Successfully!';
        }

        echo json_encode($response);
    }

    public function discount_offer_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Offer = $this->request->getVar('Offer');

//print_r($Lookup);exit();
        if ($id == 0) {
            foreach ($Offer as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("discount_center_offers", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($Offer as $key => $value) {
                $record[$key] = $value;
            }
            $Crud->UpdateRecord("discount_center_offers", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully...!';
        }

        echo json_encode($response);
    }

    public function discount_doctor_form_submit()
    {
        $Crud = new Crud();
        $id = $this->request->getVar('id');
        $discountcenterid = $this->request->getVar('discountcenterid');
        $Main = new Main();
        $profile = '';
        if ($_FILES['profile']['tmp_name'] != '') {
            $ext = @end(@explode(".", basename($_FILES['profile']['name'])));
            $uploaddir = ROOT . "/upload/discount/doctors/";
            $uploadfile = strtolower($Main->RandFileName() . "." . $ext);

            if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploaddir . $uploadfile)) {
                $profile = $uploadfile;
            }
        }
        if ($id == 0) {

            $record['DiscountCenterUID'] = $discountcenterid;
            $record['Name'] = $this->request->getVar('name');
            $record['Qualification'] = $this->request->getVar('qualification');
            $record['PMDCno'] = $this->request->getVar('pmdc');
            $record['Speciality'] = $this->request->getVar('Speciality');
            $record['ShortDesc'] = $this->request->getVar('short_description');
            $record['Department'] = $this->request->getVar('department');
            $record['Website'] = $this->request->getVar('Website');

            if ($profile != '') {
                $record['Profile'] = $profile;

            } else {
                $record['Profile'] = $profile;

            }
            $docid = $Crud->AddRecord("discount_center_doctors", $record);
            if (isset($docid) && $docid > 0) {
                ////////////////////// Doctors Timings Segment Start /////////////////////////////////
                $Shift = array('morning', 'evening');
                $Days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

                $timingArray = array();
                $StartTime = $_REQUEST['start_time'];
                $EndTime = $_REQUEST['end_time'];
                $on_call = $_REQUEST['on_call'];

                foreach ($Shift as $ME) {
                    foreach ($Days as $Day) {
                        $fdata = array();
                        $fdata['DiscountDoctUID'] = $docid;
                        $fdata['Shift'] = $ME;
                        $fdata['Weekday'] = $Day;
                        (isset($StartTime[$ME][$Day]) && $StartTime[$ME][$Day] != '') ? $fdata['StartTime'] = $StartTime[$ME][$Day] : '';
                        (isset($EndTime[$ME][$Day]) && $EndTime[$ME][$Day] != '') ? $fdata['EndTime'] = $EndTime[$ME][$Day] : '';
                        (isset($on_call[$ME][$Day])) ? $fdata['OnCall'] = 1 : '';

                        $timingArray[] = $fdata;
                    }
                }

                foreach ($timingArray as $timequery) {
                    if (isset($timequery['StartTime']) || isset($timequery['EndTime']) || isset($timequery['OnCall'])) {

                        $id = $Crud->AddRecord("discount_center_doctors_timings", $timequery);

                    }
                }


                $data = array();
                $data['status'] = "success";
                $data['id'] = $discountcenterid;
                $data['msg'] = "Discount Center Doctors Added Suuccessfully.....!";
                echo json_encode($data);


            } else {

                $data = array();
                $data['status'] = "fail";
                $data['msg'] = "Error in Adding Discount Center Doctors...!";
                echo json_encode($data);
            }


        }
        else {

            $record['DiscountCenterUID'] = $discountcenterid;
            $record['Name'] = $this->request->getVar('name');
            $record['Qualification'] = $this->request->getVar('qualification');
            $record['PMDCno'] = $this->request->getVar('pmdc');
            $record['Speciality'] = $this->request->getVar('Speciality');
            $record['ShortDesc'] = $this->request->getVar('short_description');
            $record['Department'] = $this->request->getVar('department');
            $record['Website'] = $this->request->getVar('Website');

            if ($profile != '') {
                $record['Profile'] = $profile;

            }


            if ($Crud->UpdateRecord("discount_center_offers", $record, array("UID" => $id))) {

                $Crud->DeleteRecord("discount_center_doctors_timings", array("DiscountDoctUID" => $id));

                $Shift = array('morning', 'evening');
                $Days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

                $timingArray = array();
                $StartTime = $_REQUEST['start_time'];
                $EndTime = $_REQUEST['end_time'];
                $on_call = $_REQUEST['on_call'];

                foreach ($Shift as $ME) {
                    foreach ($Days as $Day) {
                        $fdata = array();
                        $fdata['DiscountDoctUID'] = $id;
                        $fdata['Shift'] = $ME;
                        $fdata['Weekday'] = $Day;
                        (isset($StartTime[$ME][$Day]) && $StartTime[$ME][$Day] != '') ? $fdata['StartTime'] = $StartTime[$ME][$Day] : '';
                        (isset($EndTime[$ME][$Day]) && $EndTime[$ME][$Day] != '') ? $fdata['EndTime'] = $EndTime[$ME][$Day] : '';
                        (isset($on_call[$ME][$Day])) ? $fdata['OnCall'] = 1 : '';

                        $timingArray[] = $fdata;
                    }
                }

                foreach ($timingArray as $timequery) {
                    if (isset($timequery['StartTime']) || isset($timequery['EndTime']) || isset($timequery['OnCall'])) {
                        $id = $Crud->AddRecord("discount_center_doctors_timings", $timequery);

                    }
                }


                $data = array();
                $data['status'] = "success";
                $data['id'] = $discountcenterid;
                $data['msg'] = "Discount Center Doctors Updated Suuccessfully.....!";
                echo json_encode($data);
            } else {

                $data = array();
                $data['status'] = "fail";
                $data['msg'] = "Error in Updating Discount Center Doctors...!";
                echo json_encode($data);
            }

        }

    }






    public function delete_discount_center()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $Crud->DeleteRecord("discount_center", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';
        echo json_encode($response);
    }
    public function delete_discount_center_offers()
    {
        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $Crud->DeleteRecord("discount_center_offers", array("UID" => $UID));

        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';

        echo json_encode($response);
    }


    public function get_record_discount_offer()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("discount_center_offers", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }

    public function search_filter()
    {
        $session = session();
//        $Key = $this->request->getVar( 'Key' );
//        $city = $this->request->getVar( 'city' );
        $MACAddress = $this->request->getVar('Name');


        $AllFilter = array(
//            'Key' => $Key,
//            'city' => $city,
            'Name' => $MACAddress,

        );


//        print_r($AllFilter);exit();
        $session->set('LookupFilters', $AllFilter);

        $response['status'] = "success";
        $response['message'] = "Filters Updated Successfully";

        echo json_encode($response);
    }
    public function investiagation_search_filter()
    {
        $session = session();
        $Category = $this->request->getVar('Category');
        $Type = $this->request->getVar('Type');
        $AllFilter = array(
            'Category' => $Category,
            'Type' => $Type

        );
        $session->set('InvestigationFilters', $AllFilter);
        $response['status'] = "success";
        $response['message'] = "Filters Updated Successfully";

        echo json_encode($response);
    }
    public
    function get_doctor_timings_data()
    {
        $DiscountModel = new DiscountModel();

        $id = $this->request->getVar('id');

        $Data = $DiscountModel->get_doct_timings_by_doct_id($id);
        $result = array();

        foreach ($Data as $D) {

            $arr = array();

            $arr['UID'] = $D['UID'];
            $arr['DiscountDoctUID'] = $D['DiscountDoctUID'];
            $arr['Shift'] = $D['Shift'];
            $arr['Weekday'] = $D['Weekday'];
            $arr['StartTime'] = (($D['StartTime'] != null) ? date('H:i', strtotime($D['StartTime'])) : null);
            $arr['EndTime'] = (($D['EndTime'] != null) ? date('H:i', strtotime($D['EndTime'])) : null);
            $arr['OnCall'] = $D['OnCall'];

            $result[] = $arr;
        }

        echo json_encode($result);
    }

}
