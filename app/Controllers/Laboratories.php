<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\LaboratoriesModel;
use App\Models\LookupModal;
use App\Models\Main;
use App\Models\DiseasesModel;

class Laboratories extends BaseController
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
        $LookupOptionData = new Main();

        $data['cities'] = $LookupOptionData->LookupsOption("cities", 0);

        echo view('header', $data);

        echo view('laboratories/index', $data);

        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('laboratories/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_laboratories()
    {
        $Users = new LaboratoriesModel();
        $Lookup = new LookupModal();
        $Data = $Users->get_datatables();
        $totalfilterrecords = $Users->count_datatables();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $inquiry = $Users->GetLabInquiryCount($record['UID']);
            $City= $Lookup->LookupOptionBYID($record['City']);
//            print_r($City);exit();
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['Logo']) && $record['Logo'] != '')
                ? '<img src="' . PATH . 'upload/laboratory/' . $record['Logo'] . '" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="' . PATH . 'upload/laboratory/images.png">';

            $data[] = isset($record['FullName']) ? htmlspecialchars($record['FullName']) : '';
            $data[] = isset($City[0]['Name']) ? htmlspecialchars($City[0]['Name']) : '';
            $data[] = isset($record['ContactNo']) ? htmlspecialchars($record['ContactNo']) : '';
            $data[] = isset($record['Email']) ? htmlspecialchars($record['Email']) : '';
            $data[] = isset($inquiry['LabInquiryCount']) && $inquiry['LabInquiryCount'] > 0
                ? '<strong>' . htmlspecialchars($inquiry['InquiryCount']) . ' Inquiry</strong> With <strong>' . htmlspecialchars($inquiry['LabInquiryCount']) . ' Lab Test</strong>'
                : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="Updatelaboratories(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="Deletelaboratories(' . htmlspecialchars($record['UID']) . ')">Delete</a>

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

    public function laboratories_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $laboratory = $this->request->getVar('laboratory');


        if ($id == 0) {
            foreach ($laboratory as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("laboratories", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($laboratory as $key => $value) {
                $record[$key] = $value;
            }
            $Crud->UpdateRecord("laboratories", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully...!';
        }

        echo json_encode($response);
    }

    public function delete()
    {
        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $table = "laboratories";
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

        $record = $Crud->SingleRecord("laboratories", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }
}
