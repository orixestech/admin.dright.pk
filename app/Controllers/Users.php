<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\Main;
use App\Models\SystemUser;

class Users extends BaseController
{
    var $data = array();
    var $MainModel;
    var $table = 'system_users';

    public function __construct()
    {

        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
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
        } elseif ($data['page'] == 'admin-approval') {
            echo view('users/admin_approval', $data);
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
        $keyword = ( (isset($_POST['search']['value'])) ? $_POST['search']['value'] : '' );

        $Data = $Users->get_users_datatables($keyword);
        $totalfilterrecords = $Users->count_users_datatables($keyword);
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
    public function fetch_admin_activites()
    {
        $Users = new SystemUser();
        $keyword = ( (isset($_POST['search']['value'])) ? $_POST['search']['value'] : '' );

        $Data = $Users->get_admin_activity_datatables($keyword);
        $totalfilterrecords = $Users->count_admin_activity_datatables($keyword);
//        echo '<pre>';
//        print_r($Data);exit();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['FullName']) ? htmlspecialchars($record['FullName']) : '';
            $data[] = isset($record['Segment']) ? htmlspecialchars($record['Segment']) : '';
            $data[] = isset($record['Description']) ?
                htmlspecialchars(str_replace(['<strong>', '</strong>'], ' ', $record['Description'])) : '';

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
    public function fetch_admin_approval()
    {
        $Users = new SystemUser();
        $keyword = ( (isset($_POST['search']['value'])) ? $_POST['search']['value'] : '' );

        $Data = $Users->get_diet_admin_category_datatables($keyword);
        $totalfilterrecords = $Users->count_diet_admin_category_datatables($keyword);
//        echo '<pre>';
//        print_r($Data);exit();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['EditBy']) ? htmlspecialchars($record['EditBy']) : '';
            $data[] = isset($record['ModuleRef']) ? htmlspecialchars($record['ModuleRef']) : '';
            $data[] = isset($record['Description']) ? substr(strip_tags($record['Description']), 0, 50) . ' ... <a href="javascript:void(0)" style="color: red;" onclick="LoadDescriptionModel(' . $record['UID'] . ')">read more</a>' : '';
            $data[] = ($record['ApprovedBy'] > 0) ? '<span class="btn btn-info rounded btn-sm">Approved</span>' : '<a href="javascript:void(0)" onClick="ApproveQuery(' . $record['UID'] . ')" class="btn btn-danger-outline ks-no-text"><span class="fa fa-check ks-icon"></span></a>';



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
            $record['Password'] = $Main->CRYPT($record['Password'], 'hide');
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
    public function get_admin_updates_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("admin_updates", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }
}
