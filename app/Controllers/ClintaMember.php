<?php

namespace App\Controllers;


use App\Models\ClintaMemberModel;
use App\Models\Crud;
use App\Models\Main;

class ClintaMember extends BaseController
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
//        $data['page'] = getSegment(2);
//        $LookupOptionData = new Main();

//        $data['city'] = $LookupOptionData->LookupsOption("city", 0);

        echo view('header', $data);

        echo view('clinta_members/index', $data);

        echo view('footer', $data);
    }

    public function dashboard()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('clinta_members/dashboard', $data);
        echo view('footer', $data);
    }

    public function fetch_members()
    {
        $Members = new ClintaMemberModel();
        $Data = $Members->get_datatables();
        $totalfilterrecords = $Members->count_datatables();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $CM) {

            $cnt++;
            $data = array();

            $FullName = $CM['Title'] . ' ' . $CM['FirstName'] . ' ' . $CM['LastName'];
            $data[] = $cnt;
            $data[] = date("d M, Y h:i A", strtotime($CM['SystemDate']));
            $data[] = htmlspecialchars($CM['UID']);
            $data[] = ($CM['Membership'] == 0) ? '<strong>Basic Member</strong>' : 'Premium Member';
            $data[] = htmlspecialchars($FullName);
            $data[] = ($CM['LastLogin'] == null) ? 'No Login Activities' : date("d M, Y h:i A", strtotime($CM['LastLogin']));
            $data[] = '
        <td class="text-end">
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Actions
                </button>
                <div class="dropdown-menu">
                    ' . (($CM['Membership'] == 0) ? '<a class="dropdown-item" onclick="ShiftToPremium(' . htmlspecialchars($CM['UID']) . ')">Shift To Premium</a>' : '') . '
                    <a class="dropdown-item" onclick="CheckUserDetails(' . htmlspecialchars($CM['UID']) . ')"><i class="fa fa-user"></i> View Details</a>
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
        public function check_login_credentials(){
            $Crud = new Crud();
            $Main = new Main();
//            $logedInUserId = $_SESSION['UserID']; // On when session is done
            $logedInUserId = 1;
            $password = $this->request->getVar('password');
            $password = $Main->CRYPT($password, 'hide');


            $system_users = $Crud->SingleRecord("system_users", array("UID" =>$logedInUserId,"Password"=> $password));
            if (isset($system_users['UID'])) {

                $data = array();
                $data['status'] = "success";
                $data['msg'] = "Password Match With Current Login User";
                echo json_encode($data);

            } else {

                $data = array();
                $data['status'] = "fail";
                $data['msg'] = "Password Doesn't Match.....!";
                echo json_encode($data);
            }
        }
        public function get_user_data_by_id(){
            $Crud = new Crud();
            $Main = new Main();
            $member_id = $this->request->getVar('member_id');
            $result = array();


            $Data = $Crud->SingleRecord("public_users", array("UID" =>$member_id));
            $result['UID'] = $Data['UID'];
            $result['MemberID'] = $Data['UID'];
            $result['FullName'] = $Data['Title'] . " " . $Data['FirstName'] . " " . $Data['LastName'];
            $result['Password'] = $Data['Password'];
            $result['AutoLoginCode'] = str_replace("=", "", base64_encode($Data['UID'] . "|#|" . $Data['Password']));
            if ($Data['Membership'] == 1) {
                $result['MemberType'] = 'Premium';
            } else {
                $result['MemberType'] = 'Basic';
            }

            //print_r( $result );
            echo json_encode($result);
        }
    public function shift_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $MemberID = $this->request->getVar('MemberUID');
        $ReceiptNo = $this->request->getVar('reciept_no');
        $record = $Crud->SingleRecord("representative_receipts", array("ReceiptNo" => $ReceiptNo));

        if (isset($record['UID'])) {
            $representatives = $Crud->SingleRecord("representatives", array("UID" => $record['RepresentativeUID']));
            $user = $Crud->SingleRecord("public_users", array("ReceiptID" => $ReceiptNo));


            if (isset($user['UID'])) {

                $data = array();
                $data['status'] = "fail";
                $data['msg'] = "Reciept No Already Assign To <strong>" . $user['Title'] . " " . $user['FirstName'] . " " . $user['LastName'] . "</strong> ";
                echo json_encode($data);

            }
            else {
                $record=array();
                $record['Membership']=1;
                $record['ReceiptID']=$ReceiptNo;
                $record['ReferralID']=$record['RepresentativeUID'];
              $id=  $Crud->UpdateRecord("public_users", $record, array("UID" => $MemberID));

                if ($id>0) {

                    $data = array();
                    $data['status'] = "success";
                    $data['msg'] = "Member Successfully Shifted to Premium through " . $representatives['FullName'];
                    echo json_encode($data);

                } else {

                    $data = array();
                    $data['status'] = "fail";
                    $data['msg'] = "Error.....!";
                    echo json_encode($data);
                }


            }

        }
        else {

            $data = array();
            $data['status'] = "fail";
            $data['msg'] = "Reciept No Does't Assign To Any RCC..!";
            echo json_encode($data);
        }




    }

    public function delete()
    {

        $Crud = new Crud();
        $id = $_POST['id'];
        $Crud->DeleteRecord("public_users", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['message'] = ' Deleted Successfully...!';
        echo json_encode($response);
    }

    public function get_record()
    {
        $Crud = new Crud();
        $id = $_POST['id'];

        $record = $Crud->SingleRecord("public_users", array("UID" => $id));
        $response = array();
        $response['status'] = 'success';
        $response['record'] = $record;
        $response['message'] = 'Record Get Successfully...!';
        echo json_encode($response);
    }
}
