<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\Main;
use App\Models\SystemUser;

class Users extends BaseController
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
        $Users = new SystemUser();

        echo view('header', $data);
        if ($data['page'] == 'access_level') {
            echo view('users/access_level', $data);
        } elseif ($data['page'] == 'add') {
            echo view('users/main_form', $data);

        } elseif ($data['page'] == 'admin-activites') {
            echo view('users/admin_activites', $data);

        } else {
            echo view('users/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('support_ticket/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_users()
    {
        $Users = new SystemUser();
        $Data = $Users->get_users_datatables();
        $totalfilterrecords = $Users->count_users_datatables();
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
                <a class="dropdown-item" onclick="UpdateUser(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="DeleteUser(' . htmlspecialchars($record['UID']) . ')">Delete</a>

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
