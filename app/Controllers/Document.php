<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\Main;
use App\Models\DocumentModel;

class Document extends BaseController
{
    var $data = array();

    public function __construct()
    {
        helper('main');
        $session = session();
        $session = $session->get();
//
        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
        $this->data['template'] = TEMPLATE;
        $this->data['path'] = PATH;
        $this->data[ 'session' ] = $session;
        CheckLogin( $this->data );
    }

    public function index()
    {
        $data = $this->data;
        $data['page'] = getSegment(2);
        $Users = new DocumentModel();

        echo view('header', $data);
        if ($data['page'] == 'diet-plan') {
            echo view('document/diet_plan', $data);
        } elseif ($data['page'] == 'workout-plan') {
            echo view('document/workout_plan', $data);

        } elseif ($data['page'] == 'faq') {
            echo view('document/faq', $data);

        }elseif ($data['page'] == 'tips-guides') {
            echo view('document/tips_guides', $data);

        }elseif ($data['page'] == 'exercise') {
            echo view('document/exercise', $data);

        } else {
            echo view('document/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('document/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_document_data()
    {
        $Users = new DocumentModel();
        $Document = $this->request->getVar('Document');
        $Data = $Users->get_datatables($Document);
        $totalfilterrecords = $Users->count_datatables($Document);
//        print_r($Data);exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Heading']) ? htmlspecialchars($record['Heading']) : '';
            $data[] = isset($record['Status']) && $record['Status'] === '0' ? 'active' : 'block';
            $data[] = '
<td class="text-end">
    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Actions
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" onclick="UpdateDocument(\'' . htmlspecialchars($record['UID']) . '\', \'' . htmlspecialchars($Document) . '\')">Update</a>
            <a class="dropdown-item" onclick="DeleteDocument(' . htmlspecialchars($record['UID']) . ')">Delete</a>
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
    public function form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Document = $this->request->getVar('Document');
        $Description = $this->request->getVar('Description');

//print_r($User);exit();
        if ($id == 0) {
            foreach ($Document as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }
            $record['Description'] = $Description;

            $RecordId = $Crud->AddRecord("public_documents", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = ' Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($Document as $key => $value) {
                $record[$key] = $value;
            }
            $record['Description'] = $Description;

            $Crud->UpdateRecord("public_documents", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = ' Updated Successfully...!';
        }

        echo json_encode($response);
    }
    public function delete()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
        $Crud->DeleteRecord("public_documents", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';
        echo json_encode($response);
    }
    public function get_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("public_documents", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }
}