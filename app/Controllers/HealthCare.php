<?php

namespace App\Controllers;

use App\Models\Crud;
use App\Models\HealthcareModel;
use App\Models\Main;
use App\Models\PharmacyModal;
use App\Models\SystemUser;


class HealthCare extends BaseController
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
        $fruits = new \App\Models\HealthcareModel();

        echo view('header', $data);
        if ($data['page'] == 'pending') {
            echo view('health_care/pending', $data);
        } elseif ($data['page'] == 'fruit') {

            echo view('health_care/fruit', $data);

        } elseif ($data['page'] == 'vegetable') {
            echo view('health_care/vegetable', $data);

        } elseif ($data['page'] == 'miscellaneous') {
            echo view('health_care/miscellaneous', $data);

        } elseif ($data['page'] == 'pulses-grains') {
            echo view('health_care/pulses-grains', $data);

        } elseif ($data['page'] == 'dry-fruits') {
            echo view('health_care/dry-fruites', $data);

        } else {
            echo view('health_care/index', $data);

        }
        echo view('footer', $data);
    }

    public function diet()
    {
        $data = $this->data;
        $data['page'] = getSegment(2);
        $data['item_uid'] = getSegment(3);
        $healthcare = new \App\Models\HealthcareModel();

        echo view('header', $data);
//        if ($data['page'] == 'fruit-detail') {
        $record = $healthcare->GetDietDataByID($data['item_uid']);
        $data['Record'] = $record[0];
//            echo '<pre>';
//            print_r( $data['Record']);exit();
        $data['NutritionalArray'] = $healthcare->NutritionalArray();
        echo view('health_care/detail', $data);
//        } elseif ($data['page'] == 'vegetable-detail') {
//            echo view('health_care/detail', $data);
//
//        } elseif ($data['page'] == 'miscellaneous-detail') {
//            echo view('health_care/detail', $data);
//
//        } elseif ($data['page'] == 'pulses-grains-detail') {
//            echo view('health_care/detail', $data);
//
//        } elseif ($data['page'] == 'dry-fruits-detail') {
//            echo view('health_care/detail', $data);
//
//        } else {
//            echo view('health_care/index', $data);
//
//        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('healthcare/dashboard', $data);
        echo view('footer', $data);
    } public function frenchises()
    {
        $data = $this->data;
        $data['page'] = getSegment(2);
        $PharmacyModal = new PharmacyModal();

        $data['cities'] = $PharmacyModal->citites();
        $data[ 'PAGE' ] = array ();

        echo view('header', $data);
    if ($data['page'] == 'add') {
            echo view('health_care/branch_main_form', $data);
//
        } elseif($data['page'] == 'update') {
        $UID = getSegment( 3 );
        $data[ 'UID' ] = $UID;
        $Crud = new Crud();
        $PAGE = $Crud->SingleRecord( 'public_branches', array ( "UID" => $UID ) );
        $data[ 'PAGE' ] = $PAGE;
        echo view('health_care/branch_main_form', $data);
//
    }else{
        echo view('health_care/frenchises', $data);

    }
        echo view('footer', $data);
    }

    public function diet_categories()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('health_care/diet_categories', $data);
        echo view('footer', $data);
    }

    public function support_videos()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('health_care/support_videos', $data);
        echo view('footer', $data);
    }

    public function fetch_diet_categories()
    {
        $Healthcare = new HealthcareModel();
        $Data = $Healthcare->get_diet_category_datatables();
        $totalfilterrecords = $Healthcare->count_diet_category_datatables();
//        print_r($Data);
//        exit();
        $Users = new SystemUser();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Actions = [];

            if( $Users->checkAccessKey('healthcare_diet_category_update') )
                $Actions[] = '<a class="dropdown-item" onclick="UpdateDietCategory(' . htmlspecialchars($record['UID']) . ')">Update</a>';
            if( $Users->checkAccessKey('healthcare_diet_category_delete') )
                $Actions[] = '<a class="dropdown-item" onclick="DeleteDietCategory(' . htmlspecialchars($record['UID']) . ')">Delete</a>';

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Category']) ? htmlspecialchars($record['Category']) : '';
            $data[] = isset($record['SubCategory']) ? htmlspecialchars($record['SubCategory']) : '';
            $data[] = isset($record['Unit']) ? htmlspecialchars($record['Unit']) : '';
            $data[] = isset($record['EAR']) ? htmlspecialchars($record['EAR']) : '';
            $data[] = isset($record['RDA']) ? htmlspecialchars($record['RDA']) : '';
            $data[] = isset($record['UL']) ? htmlspecialchars($record['UL']) : '';
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


    public function fetch_support_videos()
    {
        $Healthcare = new HealthcareModel();
        $Data = $Healthcare->get_support_videos_datatables();
        $totalfilterrecords = $Healthcare->count_support_videos_datatables();
//        print_r($Data);
//        exit();        $Users = new SystemUser();
        $Users = new SystemUser();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Actions = [];

            if( $Users->checkAccessKey('healthcare_supportvideos_update') )
                $Actions[] = '<a class="dropdown-item" onclick="UpdateSupportVideo(' . htmlspecialchars($record['UID']) . ')">Update</a>';
            if( $Users->checkAccessKey('healthcare_supportvideos_delete') )
                $Actions[] = '<a class="dropdown-item" onclick="DeleteSupportVideo(' . htmlspecialchars($record['UID']) . ')">Delete</a>';

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Category']) ? htmlspecialchars($record['Category']) : '';
            $data[] = isset($record['Title']) ? htmlspecialchars($record['Title']) : '';
            $data[] = isset($record['EmbedCode']) ? htmlspecialchars($record['EmbedCode']) : '';
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

    public function fetch_fruit()
    {
        $Healthcare = new HealthcareModel();
        $item = 'fruits';
        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');

        $Data = $Healthcare->get_diet_datatables($item, $keyword);
        $totalfilterrecords = $Healthcare->count_diet_datatables($item, $keyword);
//        print_r($Data);
//        exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Nitems = $Healthcare->GetNutritionalCountByItem($record['UID']);
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="' . PATH . 'upload/diet/' . $record['Image'] . '" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="' . PATH . 'upload/diet/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['UrduName']) ? htmlspecialchars($record['UrduName']) : '';
            $data[] = isset($Nitems) ? $Nitems : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateItem(' . htmlspecialchars($record['UID']) . ', \'fruits\')">Update</a>
                <a class="dropdown-item" onclick="DeleteItem(' . htmlspecialchars($record['UID']) . ')">Delete</a>
                <a class="dropdown-item" onclick="ItemDetail(' . htmlspecialchars($record['UID']) . ')">Diet Details</a>
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

    public function fetch_dry_fruit()
    {
        $Healthcare = new HealthcareModel();
        $item = 'dry-fruites';
        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');
        $Data = $Healthcare->get_diet_datatables($item, $keyword);;
        $totalfilterrecords = $Healthcare->count_diet_datatables($item, $keyword);

//        print_r($Data);
//        exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Nitems = $Healthcare->GetNutritionalCountByItem($record['UID']);
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="' . PATH . 'upload/diet/' . $record['Image'] . '" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="' . PATH . 'upload/diet/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['UrduName']) ? htmlspecialchars($record['UrduName']) : '';
            $data[] = isset($Nitems) ? $Nitems : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateItem(' . htmlspecialchars($record['UID']) . ', \'dry-fruites\')">Update</a>
                <a class="dropdown-item" onclick="DeleteItem(' . htmlspecialchars($record['UID']) . ')">Delete</a>
                           <a class="dropdown-item" onclick="ItemDetail(' . htmlspecialchars($record['UID']) . ')">Diet Details</a>

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

    public function fetch_grains()
    {
        $Healthcare = new HealthcareModel();
        $item = 'pulses-grains';
        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');
        $Data = $Healthcare->get_diet_datatables($item, $keyword);;
        $totalfilterrecords = $Healthcare->count_diet_datatables($item, $keyword);

//        print_r($Data);
//        exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Nitems = $Healthcare->GetNutritionalCountByItem($record['UID']);
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="' . PATH . 'upload/diet/' . $record['Image'] . '" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="' . PATH . 'upload/diet/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['UrduName']) ? htmlspecialchars($record['UrduName']) : '';
            $data[] = isset($Nitems) ? $Nitems : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateItem(' . htmlspecialchars($record['UID']) . ', \'pulses-grains\')">Update</a>
                <a class="dropdown-item" onclick="DeleteItem(' . htmlspecialchars($record['UID']) . ')">Delete</a>
                          <a class="dropdown-item" onclick="ItemDetail(' . htmlspecialchars($record['UID']) . ')">Diet Details</a>

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

    public function fetch_vegetable()
    {
        $Healthcare = new HealthcareModel();
        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');

        $Data = $Healthcare->get_vegetable_datatables($keyword);
        $totalfilterrecords = $Healthcare->count_vegetable_datatables($keyword);


        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Nitems = $Healthcare->GetNutritionalCountByItem($record['UID']);

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="' . PATH . 'upload/diet/' . $record['Image'] . '" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="' . PATH . 'upload/diet/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['UrduName']) ? htmlspecialchars($record['UrduName']) : '';
            $data[] = isset($Nitems) ? $Nitems : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateItem(' . htmlspecialchars($record['UID']) . ', \'vegetables\')">Update</a>
                <a class="dropdown-item" onclick="DeleteItem(' . htmlspecialchars($record['UID']) . ')">Delete</a>
                           <a class="dropdown-item" onclick="ItemDetail(' . htmlspecialchars($record['UID']) . ')">Diet Details</a>

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

    public function fetch_miscellaneous()
    {
        $Healthcare = new HealthcareModel();
        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');

        $Data = $Healthcare->get_miscellaneous_datatables($keyword);
        $totalfilterrecords = $Healthcare->count_miscellaneous_datatables($keyword);

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Nitems = $Healthcare->GetNutritionalCountByItem($record['UID']);

            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Image']) && $record['Image'] != '')
                ? '<img src="' . PATH . 'upload/diet/' . $record['Image'] . '" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="' . PATH . 'upload/diet/images.png">';

            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['UrduName']) ? htmlspecialchars($record['UrduName']) : '';
            $data[] = isset($Nitems) ? $Nitems : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateItem(' . htmlspecialchars($record['UID']) . ', \'miscellaneous\')">Update</a>
                <a class="dropdown-item" onclick="DeleteItem(' . htmlspecialchars($record['UID']) . ')">Delete</a>
                        <a class="dropdown-item" onclick="ItemDetail(' . htmlspecialchars($record['UID']) . ')">Diet Details</a>

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

    public function item_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Item = $this->request->getVar('Item');

        $filename = "";

        if ($_FILES['Image']['tmp_name']) {
            $ext = @end(@explode(".", basename($_FILES['Image']['name'])));
            $uploaddir = ROOT . "/upload/diet/";
            $uploadfile = strtolower($Main->RandFileName() . "." . $ext);

            if (move_uploaded_file($_FILES['Image']['tmp_name'], $uploaddir . $uploadfile)) {
                $filename = $uploadfile;
            }
        }

//        print_r($filename);exit();
        if ($id == 0) {
            foreach ($Item as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }
            if ($filename != "") {
                $record['Image'] = $filename;
            }
            $RecordId = $Crud->AddRecord("public_diet", $record);
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
            if ($filename != "") {
                $record['Image'] = $filename;
            }

            $Crud->UpdateRecord("public_diet", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Item Updated Successfully...!';
        }

        echo json_encode($response);
    }
    public function form_submit_frenchises()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Item = $this->request->getVar('Branch');

        $filename = "";
        $filenameProfile = "";

        if ($_FILES['Image']['tmp_name']) {
            $ext = @end(@explode(".", basename($_FILES['Image']['name'])));
            $uploaddir = ROOT . "/upload/franchise/";
            $uploadfile = strtolower($Main->RandFileName() . "." . $ext);

            if (move_uploaded_file($_FILES['Image']['tmp_name'], $uploaddir . $uploadfile)) {
                $filename = $uploadfile;
            }
        }  if ($_FILES['Profile']['tmp_name']) {
            $ext = @end(@explode(".", basename($_FILES['Profile']['name'])));
            $uploaddir = ROOT . "/upload/franchise/";
            $uploadfile = strtolower($Main->RandFileName() . "." . $ext);

            if (move_uploaded_file($_FILES['Profile']['tmp_name'], $uploaddir . $uploadfile)) {
                $filenameProfile = $uploadfile;
            }
        }

//        print_r($Item);exit();
        if ($id == 0) {
            foreach ($Item as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }
            if ($filename != "") {
                $record['ContactPersonImage'] = $filename;
            } if ($filenameProfile != "") {
                $record['ProfileImage'] = $filename;
            }
            $RecordId = $Crud->AddRecord("public_branches", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($Item as $key => $value) {
                $record[$key] = $value;
            }

            if ($filename != "") {
                $record['ContactPersonImage'] = $filename;
            } if ($filenameProfile != "") {
                $record['ProfileImage'] = $filename;
            }
            $Crud->UpdateRecord("public_branches", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully...!';
        }

        echo json_encode($response);
    }

    public function category_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Category = $this->request->getVar('DietCategory');
        $Description = $this->request->getVar('Description');

        if ($id == 0) {
            foreach ($Category as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $record['Description'] = $Description;
            $RecordId = $Crud->AddRecord("public_diet_category", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = ' Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($Category as $key => $value) {
                $record[$key] = $value;
            }
            $record['Description'] = $Description;


            $Crud->UpdateRecord("public_diet_category", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = ' Updated Successfully...!';
        }

        echo json_encode($response);
    }

    public function support_videos_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $videos = $this->request->getVar('SupportVideo');

        if ($id == 0) {
            foreach ($videos as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }
            $RecordId = $Crud->AddRecord("support_videos", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = ' Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($videos as $key => $value) {
                $record[$key] = $value;
            }
            $Crud->UpdateRecord("support_videos", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = ' Updated Successfully...!';
        }

        echo json_encode($response);
    }

    public function diet_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $fact = $this->request->getVar('fact');
        $diet_id = $this->request->getVar('diet_id');
//        print_r($fact);exit();
        $Crud = new Crud();
//            echo 'fefeg';exit();
        $Crud->DeleteRecord("public_diet_facts", array("DietID" => $diet_id));

        foreach ($fact as $key => $value) {
            $record['OptionID'] = ((isset($key)) ? $key : '');
            $record['Value'] = ((isset($value)) ? $value : '');
            $record['DietID'] = ((isset($diet_id)) ? $diet_id : '');
            $RecordId = $Crud->AddRecord("public_diet_facts", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Nutritional  Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Nutritional  Didnt Submitted Successfully...!';
            }

        }


        echo json_encode($response);
    }

    public function get_item_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("public_diet", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Item Record Get Successfully...!';
        echo json_encode($response);
    }

    public function get_record_support_video()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("support_videos", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Item Record Get Successfully...!';
        echo json_encode($response);
    }

    public function get_category_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("public_diet_category", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = ' Record Get Successfully...!';
        echo json_encode($response);
    }

    public function delete_item()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $Crud->DeleteRecord("public_diet", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = 'Diet Deleted Successfully...!';
        echo json_encode($response);
    }

    public function delete_category()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $Crud->DeleteRecord("public_diet_category", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';
        echo json_encode($response);
    }

    public function delete_support_video()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $Crud->DeleteRecord("support_videos", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';
        echo json_encode($response);
    }

    public function delete_frenchises()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $Crud->DeleteRecord("public_branches", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';
        echo json_encode($response);
    }

}
