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
//        $session = session();
//        $session = $session->get();
//
        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
        $this->data['template'] = TEMPLATE;
        $this->data['path'] = PATH;
//        $this->data[ 'session' ] = $session;
//        CheckLogin( $this->data );
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
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['FullName']) ? htmlspecialchars($record['FullName']) : '';
            $data[] = isset($record['Email']) ? htmlspecialchars($record['Email']) : '';
            $data[] = isset($record['AccessLevel']) ? htmlspecialchars($record['AccessLevel']) : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateDocument(' . htmlspecialchars($record['UID']) . ')">Update</a>
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
    public function user_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $User = $this->request->getVar('User');


        if ($id == 0) {
            foreach ($User as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("system_users", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'User Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($User as $key => $value) {
                $record[$key] = $value;
            }
            $Crud->UpdateRecord("system_users", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'User Updated Successfully...!';
        }

        echo json_encode($response);
    }
    public function delete_user()
    {
        $Crud = new Crud();
        $id = $_POST['id'];
        $Crud->DeleteRecord("system_users", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = 'User Deleted Successfully...!';
        echo json_encode($response);
    }
    public function get_item_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("system_users", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }
}
