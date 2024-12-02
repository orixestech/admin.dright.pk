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

    public function listdiscount()
    {
        $data = $this->data;
        $data['page'] = getSegment(3);
        $LookupOptionData = new Main();

        echo view('header', $data);
            echo view('discount/index', $data);


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

        $Data = $DiscountModel->get_datatables($keyword);
        $totalfilterrecords = $DiscountModel->count_datatables($keyword);

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {


            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($Category[0]['Name']) ? htmlspecialchars($Category[0]['Name']) : '';
            $data[] = isset($Type[0]['Name']) ? htmlspecialchars($Type[0]['Name']) : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateInvestigation(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="DeleteInvestigation(' . htmlspecialchars($record['UID']) . ')">Delete</a>
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


    public function investigation_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Investigation = $this->request->getVar('Investigation');

        if (!empty($Investigation['Name'])) {
            if ($id == 0) {
                foreach ($Investigation as $key => $value) {
                    $record[$key] = ((isset($value)) ? $value : '');
                }

                $RecordId = $Crud->AddRecord("investigation", $record);
                if (isset($RecordId) && $RecordId > 0) {
                    $response['status'] = 'success';
                    $response['message'] = 'Added Successfully...!';
                } else {
                    $response['status'] = 'fail';
                    $response['message'] = 'Data Didnt Submitted Successfully...!';
                }
            } else {
                foreach ($Investigation as $key => $value) {
                    $record[$key] = $value;
                }
                $Crud->UpdateRecord("investigation", $record, array("UID" => $id));
                $response['status'] = 'success';
                $response['message'] = 'Updated Successfully...!';
            }
        } else {
            $response['status'] = 'fail';
            $response['message'] = 'Name Cant Be Empty...!';
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

    public function delete_investigation()
    {
        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $table = "investigation";
        $record['Archive'] = 1;
        $where = array('UID' => $UID);
        $Crud->UpdateRecord($table, $record, $where);
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';

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
