<?php

namespace App\Controllers;

use App\Models\ExtendedModel;
use App\Models\Main;
use App\Models\PharmacyModal;

class Extended extends BaseController
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

        echo view('header', $data);
       if ($data['page'] == 'add'){
            echo view('extended/main_form', $data);

        }elseif ($data['page'] == 'update'){
            echo view('extended/main_form', $data);

        } else {
            echo view('extended/index', $data);

        }
        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('extended/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_profiles()
    {
        $Users = new ExtendedModel();
        $PharmacyModal = new PharmacyModal();
        $Data = $Users->get_datatables();
        $totalfilterrecords = $Users->count_datatables();
//        print_r($totalfilterrecords);exit();
//      echo '<pre>';
//      print_r($Data);exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $city = $PharmacyModal->getcitybyid($record['City']);
//            $StatusUrl = SeoUrl('module/extended_profiles/status/'.$record['UID']);
            if ($_SERVER['HTTP_HOST'] != 'localhost'){
//                $InvoiceDateTime = $this->Modules->GetExtendedLastInvoiceDateTime( $EP['DatabaseName'] );
//                $PharmacyInvoiceDateTime = $this->Modules->GetExtendedLastPharmacyInvoiceDateTime( $EP['DatabaseName'] );

                $PharmacyInvoiceDateTime='';
                $InvoiceDateTime='';
            }
//

            $cnt++;
            $data = array();
            $data[] = $cnt;

            $data[] = isset($record['FullName']) ? htmlspecialchars($record['FullName']) : '';
            $data[] = isset($city[0]['FullName']) ? htmlspecialchars($city[0]['FullName']) : '';
            $data[] = isset($record['DatabaseName']) ? htmlspecialchars($record['DatabaseName']) : '';
            $data[] = isset($InvoiceDateTime) ? date("d M, Y h:i A", strtotime($InvoiceDateTime)): '';
            $data[] = isset($PharmacyInvoiceDateTime) ? date("d M, Y h:i A", strtotime($PharmacyInvoiceDateTime)): '';
            $data[] = isset($record['SubDomainUrl']) ? htmlspecialchars($record['SubDomainUrl']) : '';
            $data[] = isset($record['Status']) ? htmlspecialchars($record['Status']) : '';
            $data[] = isset($record['ExpireDate']) ? htmlspecialchars($record['ExpireDate']) : '';

            $smsCredits = isset($record['SMSCredits']) && $record['SMSCredits'] != ''
                ? '<strong>' . $record['SMSCredits'] . '</strong> SMS Credits<br>
                <button  class="btn btn-gradient-warning" onclick="AddSmsCredits(' . $record['UID'] . ', 250);"><strong>250</strong></button>
                <button  class="btn btn-gradient-warning" onclick="AddSmsCredits(' . $record['UID'] . ', 500);"><strong>500</strong></button>'
                : '<button  class="btn btn-gradient-warning" onclick="AddSmsCredits(' . $record['UID'] . ', 100);"><strong>Free Credits</strong></button>';
            $data[] = $smsCredits;

            $data[] = '
<td class="text-end">
    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Actions
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" onclick="EditDoctors(' . $record['UID'] . ');">Edit</a>
            <a class="dropdown-item" onclick="DeleteHospital(' . htmlspecialchars($record['UID']) . ')">Delete</a>';

            $data[] .= '
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


}
