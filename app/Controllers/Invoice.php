<?php

namespace App\Controllers;


use App\Models\Crud;
use App\Models\Main;
use App\Models\SystemUser;

class Invoice extends BaseController
{
    var $data = array();
    var $MainModel;

    public function __construct()
    {

        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
    }

    public function index()
    {
        $data = $this->data;
        $data['page'] = getSegment(2);

        echo view('header', $data);

        echo view('invoice/index', $data);

        echo view('footer', $data);
    }

    public function invoice_detail()
    {
        $data = $this->data;
        $data['UID'] = getSegment(3);
        $Crud = new Crud();
        $Invoice = new SystemUser();

        $data['AllItems'] = $Invoice->items();
        $data['InvoiceDetail'] = $Crud->SingleRecord("invoices", array("UID" => $data['UID']));

        echo view('header', $data);

        echo view('invoice/invoice_detail', $data);

        echo view('footer', $data);
    }


    public function fetch_invoice()
    {
        $Users = new SystemUser();
        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');

        $Data = $Users->get_invoice_datatables($keyword);
        $totalfilterrecords = $Users->count_invoice_datatables($keyword);
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['Name']) ? htmlspecialchars($record['Name']) : '';
            $data[] = isset($record['Email']) ? htmlspecialchars($record['Email']) : '';
            $data[] = isset($record['PhoneNumber']) ? htmlspecialchars($record['PhoneNumber']) : '';
            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="Invoice(' . htmlspecialchars($record['UID']) . ')">Invoice</a>
                <a class="dropdown-item" onclick="UpdateInvoice(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="DeleteInvoice(' . htmlspecialchars($record['UID']) . ')">Delete</a>

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

    public function invoice_detail_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $User = $this->request->getVar('Invoice');


        if ($id == 0) {
            foreach ($User as $key => $value) {
                $record[$key] = ((isset($value)) ? $value : '');
            }

            $RecordId = $Crud->AddRecord("invoices", $record);
            if (isset($RecordId) && $RecordId > 0) {
                $record2['InvoiceID'] = Code($RecordId, 'INV-');

                $Crud->UpdateRecord('invoices', $record2, array("UID" => $RecordId));
                $Main = new Main();

                $msg = $_SESSION['FullName'] . ' Add Invoice Detail Through Admin Dright';
                $logesegment = 'Users';
                $Main->adminlog($logesegment, $msg, $this->request->getIPAddress());
                $response['status'] = 'success';
                $response['message'] = 'Invoice Added Successfully...!';
            } else {
                $response['status'] = 'fail';
                $response['message'] = 'Data Didnt Submitted Successfully...!';
            }
        } else {
            foreach ($User as $key => $value) {
                $record[$key] = $value;
            }

            $msg = $_SESSION['FullName'] . ' Update Invoice Detail Through Admin Dright';
            $logesegment = 'Users';
            $Main->adminlog($logesegment, $msg, $this->request->getIPAddress());
            $Crud->UpdateRecord("invoices", $record, array("UID" => $id));
            $response['status'] = 'success';
            $response['message'] = 'User Updated Successfully...!';
        }

        echo json_encode($response);
    }

    public function delete_invoice()
    {
        $data = $this->data;
        $UID = $this->request->getVar('id');
        $Crud = new Crud();
        $table = "invoices";
        $record['Archive'] = 1;
        $where = array('UID' => $UID);
        $Crud->UpdateRecord($table, $record, $where);
        $response['status'] = 'success';
        $response['message'] = 'Deleted Successfully...!';
    }

    public function get_record_invoice()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("invoices", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }

    public function get_item_price()
    {
        $response = ['success' => false, 'price' => '', 'message' => ''];
        $Crud = new Crud();

        $UID = $this->request->getVar('UID');
//        print_r($UID);
//        exit();
        if ($UID) {
            // Fetch the item details based on UID
            $item = $Crud->SingleRecord('items', ['UID' => $UID]);
            if ($item) {
                $response['success'] = true;
                $response['price'] = $item['Price']; // Assuming 'Price' is the column name
            } else {
                $response['message'] = 'Item not found.';
            }
        } else {
            $response['message'] = 'Invalid item ID.';
        }


        echo json_encode($response);
    }

}
