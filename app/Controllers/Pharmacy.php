<?php

namespace App\Controllers;


use App\Models\PharmacyModal;

class Pharmacy extends BaseController
{
    var $data = array();

    public function __construct()
    {
        helper('main');
//        $session = session();
//        $session = $session->get();
//
//        $this->MainModel = new Main();
//        $this->data = $this->MainModel->DefaultVariable();
        $this->data['template'] = TEMPLATE;
        $this->data['path'] = PATH;
//        $this->data[ 'session' ] = $session;
//        CheckLogin( $this->data );
    }

    public function index()
    {
        $data = $this->data;
        $data['page'] = getSegment(2);

        echo view('header', $data);
        if ($data['page'] == 'pending') {
            echo view('pharmacy/pending', $data);
        }elseif ($data['page'] == 'add'){
            echo view('pharmacy/main_form', $data);

        }elseif ($data['page'] == 'update'){
            echo view('pharmacy/main_form', $data);

        } else {
            echo view('pharmacy/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('pharmacy/dashboard', $data);
        echo view('footer', $data);
    }
    public function fetch_medicine()
    {
        $PharmacyModal = new PharmacyModal();
        $Data = $PharmacyModal->get_datatables();
        $totalfilterrecords = $PharmacyModal->count_datatables();
//        print_r($Data);
//        exit();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($record['PharmaCompanyUID']) ? htmlspecialchars($record['PharmaCompanyUID']) : '';
            $data[] = isset($record['MedicineTitle']) ? htmlspecialchars($record['MedicineTitle']) : '';
            $data[] = isset($record['Ingredients']) ? htmlspecialchars($record['Ingredients']) : '';
            $data[] = isset($record['DosageForm']) ? htmlspecialchars($record['DosageForm']) : '';
            $data[] = isset($record['Packing']) ? htmlspecialchars($record['Packing']) : '';
            $data[] = isset($record['TradePrice']) ? htmlspecialchars($record['TradePrice']) : '';
            $data[] = isset($record['RetailPrice']) ? htmlspecialchars($record['RetailPrice']) : '';
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

}
