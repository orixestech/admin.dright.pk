<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\Main;
use App\Models\DiseasesModel;

class Disease extends BaseController
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

        $data['diseases_category'] = $LookupOptionData->LookupsOption("diseases_category", 0);

        echo view('header', $data);

        echo view('diseases/index', $data);

        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('support_ticket/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_diseases()
    {
        $Users = new DiseasesModel();
        $keyword = ( (isset($_POST['search']['value'])) ? $_POST['search']['value'] : '' );

        $Data = $Users->get_diseases_datatables($keyword);
//        print_r($Data);exit();
        $totalfilterrecords = $Users->count_diseases_datatables($keyword);
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['DiseaseName']) ? htmlspecialchars($record['DiseaseName']) : '';
            $data[] = isset($record['Title']) ? htmlspecialchars($record['Title']) : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateDisease(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="DeleteDisease(' . htmlspecialchars($record['UID']) . ')">Delete</a>

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

    public function Disease_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Disease = $this->request->getVar('Disease');
//print_r($Disease);exit();
        if (!empty($Disease['DiseaseName'])) {
            if ($id == 0) {
                foreach ($Disease as $key => $value) {
                    $record[$key] = ((isset($value)) ? $value : '');
                }

                $RecordId = $Crud->AddRecord("diseases", $record);
                if (isset($RecordId) && $RecordId > 0) {
                    $response['status'] = 'success';
                    $response['message'] = 'Added Successfully...!';
                } else {
                    $response['status'] = 'fail';
                    $response['message'] = 'Data Didnt Submitted Successfully...!';
                }
            } else {
                foreach ($Disease as $key => $value) {
                    $record[$key] = $value;
                }
                $Crud->UpdateRecord("diseases", $record, array("UID" => $id));
                $response['status'] = 'success';
                $response['message'] = 'Updated Successfully...!';
            }

        }
        else{
            $response['status'] = 'fail';
            $response['message'] = 'Name Cant Be Empty...!';
        }

        echo json_encode($response);
    }

    public function delete()
    {
        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $table = "diseases";
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

        $record = $Crud->SingleRecord("diseases", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }
}
