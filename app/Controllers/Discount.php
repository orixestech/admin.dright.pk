<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\DiscountModel;
use App\Models\InvestigationModel;
use App\Models\LookupModal;
use App\Models\Main;

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
        $data['Specialities'] =$DiscountModel->get_speciality_data();

        if ($data['page'] == 'add-discount'){

            $data['PAGE'] = array();
            $Crud = new Crud();
            echo view('discount/main_form', $data);

        }else if($data['page'] == 'update-discount') {
            $UID = getSegment(4);
//            print_r($UID);exit();
            $data['UID'] = $UID;
            $Crud = new Crud();
            $PAGE = $Crud->SingleRecord('discount_center', array("UID" => $UID));
            $data['Images'] =$DiscountModel->GetDiscountCenterImagesByID($UID);

            $data['Data'] = $PAGE;
            echo view('discount/update_discount_main_form', $data);

        }else{

            echo view('discount/index', $data);

        }


        echo view('footer', $data);
    }

    public function view_parameter()
    {
        $data = $this->data;
        $data['UID'] = getSegment(3);
        echo view('header', $data);

        echo view('investigation/parameter', $data);


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
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="EditDiscountCenter(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="DeleteDiscountCenter(' . htmlspecialchars($record['UID']) . ')">Delete</a>
                <a class="dropdown-item" onclick="ViewParameter(' . htmlspecialchars($record['UID']) . ')">View Parameter</a>

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

    public function fetch_investigation_parameter()

    {
        $InvestigationModel = new InvestigationModel();
        $Lookup = new LookupModal();

        $ID = $this->request->getVar('UID');

        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');

        $Data = $InvestigationModel->get_datatables_investigation_parameter($keyword, $ID);
        $totalfilterrecords = $InvestigationModel->count_datatables_investigation_parameter($keyword, $ID);

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Parameters']) ? htmlspecialchars($record['Parameters']) : '';
            $data[] = isset($record['MinRange']) ? htmlspecialchars($record['MinRange']) : '';
            $data[] = isset($record['MaxRange']) ? htmlspecialchars($record['MaxRange']) : '';

            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateInvestigationParameter(\'' . htmlspecialchars($record['UID']) . '\', \'' . htmlspecialchars($ID) . '\')">Update</a>
                <a class="dropdown-item" onclick="DeleteInvestigationParameter(' . htmlspecialchars($record['UID']) . ')">Delete</a>

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

    public function parameter_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Parameter = $this->request->getVar('Parameter');

//print_r($Lookup);exit();
        if ($id == 0) {
            foreach ($Parameter as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("investigation_parameters", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($Parameter as $key => $value) {
                $record[$key] = $value;
            }
            $Crud->UpdateRecord("investigation_parameters", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully...!';
        }

        echo json_encode($response);
    }


    public function delete_discount_center()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $Crud->DeleteRecord("discount_center", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = 'Diet Deleted Successfully...!';
        echo json_encode($response);
    }
    public function delete_investigation_parameter()
    {
        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $table = "investigation_parameters";
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

        $record = $Crud->SingleRecord("investigation", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }

    public function get_record_parameter()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("investigation_parameters", array("UID" => $id));
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
}
