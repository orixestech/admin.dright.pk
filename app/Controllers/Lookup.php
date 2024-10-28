<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\LookupModal;
use App\Models\Main;

class Lookup extends BaseController
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
        echo view('header', $data);

        echo view('lookups/index', $data);


        echo view('footer', $data);
    }

    public function lookup_option()
    {
        $data = $this->data;
        $data['UID'] = getSegment(3);
        echo view('header', $data);

        echo view('lookups/lookup_options', $data);


        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('lookups/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_lookups()
    {
        $Lookup = new LookupModal();
        $Data = $Lookup->get_datatables();
        $totalfilterrecords = $Lookup->count_datatables();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['Key']) ? htmlspecialchars($record['Key']) : '';
            $data[] = isset($record['Description']) ? htmlspecialchars($record['Description']) : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateLookup(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="DeleteLookup(' . htmlspecialchars($record['UID']) . ')">Delete</a>
                <a class="dropdown-item" onclick="ViewLookupOption(' . htmlspecialchars($record['UID']) . ')">View Option</a>

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

    public function fetch_lookups_options()
    {
        $Lookup = new LookupModal();
        $LookupID = $this->request->getVar('UID');

        $Data = $Lookup->get_lookup_option_datatables($LookupID);
        $totalfilterrecords = $Lookup->count_lookup_optiondatatables($LookupID);

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateLookupOption(\'' . htmlspecialchars($record['UID']) . '\', \'' . htmlspecialchars($LookupID) . '\')">Update</a>
                <a class="dropdown-item" onclick="DeleteLookupOption(\'' . htmlspecialchars($record['UID']) . '\')">Delete</a>
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

    public function lookup_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Lookup = $this->request->getVar('Lookup');

//print_r($Lookup);exit();
        if ($id == 0) {
            foreach ($Lookup as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("lookups", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($Lookup as $key => $value) {
                $record[$key] = $value;
            }
            $Crud->UpdateRecord("lookups", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully...!';
        }

        echo json_encode($response);
    }
    public function lookup_option_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $LookupOption = $this->request->getVar('LookupOption');

//print_r($Lookup);exit();
        if ($id == 0) {
            foreach ($LookupOption as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("lookups_options", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($LookupOption as $key => $value) {
                $record[$key] = $value;
            }
            $Crud->UpdateRecord("lookups_options", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully...!';
        }

        echo json_encode($response);
    }

    public function delete_lookup()
    {
        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $table = "lookups";
        $record['Archive'] = 1;
        $where = array('UID' => $UID);
        $Crud->UpdateRecord($table, $record, $where);
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';

        echo json_encode($response);
    }

    public function delete_lookup_option()
    {
        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $table = "lookups_options";
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

        $record = $Crud->SingleRecord("lookups", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }

    public function get_lookup_option_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("lookups_options", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }
}
