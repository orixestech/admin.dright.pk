<?php

namespace App\Controllers;

use App\Models\Crud;
use App\Models\ExtendedModel;
use App\Models\Main;
use App\Models\SupportTicketModel;

class SupportTickets extends BaseController
{
    var $data = array();

    public function __construct()
    {

        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
    }

    public function index()
    {        $Crud = new Crud();

        $data = $this->data;
        $data['page'] = getSegment(2);
        $data['PAGE'] = array();
        $SupportTicketModel= new SupportTicketModel();
        $ExtendedModel= new ExtendedModel();
        $SQL = $ExtendedModel->extended_profiles();
        $data['extended_profiles'] = $Crud->ExecuteSQL($SQL);

        echo view('header', $data);
        if ($data['page'] == 'pending') {
            echo view('support_ticket/pending', $data);
        }elseif ($data['page'] == 'tickets_reply'){
            $UID = getSegment(3);
            $data['TicketID'] = $UID;
            $Crud = new Crud();
            $TicketData = $Crud->SingleRecord('tasks', array("UID" => $UID));
            $data['TicketData'] = $TicketData;
            if ($data['TicketData']['Product'] == 'ClinTa_Extended') {
                $data['Profile'] = $SupportTicketModel->GetExtendedProfielDataByID($data['TicketData']['ProductProfielID']);
//           print_r(   $data['Profile'] );exit();

                $data['CreatedBy'] = $SupportTicketModel->GetExtendedUserDataByDBOrID($data['Profile'][0]['DatabaseName'], $data['TicketData']['CreatedBY']);
//           print_r(   $data['CreatedBy']);exit();
            }
            echo view('support_ticket/tickets_reply', $data);

        }elseif ($data['page'] == 'update'){
            echo view('support_ticket/main_form', $data);

        } else {
            echo view('support_ticket/index', $data);

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
    public function fetch_data()
    {
        $Users = new SupportTicketModel();

        $Data = $Users->get_datatables();
//        print_r($Data);exit();
        $totalfilterrecords = $Users->count_datatables();
        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $Profile = $Users->GetExtendedProfielDataByID($record['ProductProfielID'] );
            $CreatedBy = $Users->GetExtendedUserDataByDBOrID($Profile[0]['DatabaseName'], $record['CreatedBY'] );
//            print_r($CreatedBy);exit();

            $LatestCommentData = $Users->GetLatestCommentDataByTicketID( $record['UID'] );
//            $CreatedBy['FullName']='';
//            $LatestCommentData[0]['SystemDate']='';
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = isset($Profile[0]['FullName']) ? htmlspecialchars($Profile[0]['FullName']) : '';
            $data[] = isset($record['ModuleID']) ? htmlspecialchars($record['ModuleID']) : '';
            $data[] = isset($record['ModuleID'])
                ? '<a href="' . PATH . 'support-ticket/tickets_reply/' . $record['UID'] . '">#' . $record['UID'] . ' - ' . $record['Subject'] . '</a>'
                : '';
            $data[] = isset($CreatedBy[0]['FullName']) ? htmlspecialchars($CreatedBy[0]['FullName']) : '';

            $data[] = isset($record['SystemDate']) ? date("d M, Y h:i A", strtotime( $record['SystemDate'] )) : '';
            $data[] = isset($LatestCommentData[0]['SystemDate']) ? date("d M, Y h:i A", strtotime( $LatestCommentData[0]['SystemDate'] )) : '';
            $data[] = isset($record['DeadLine']) ? date("d M, Y h:i A", strtotime( $record['DeadLine'] )) : '';

            $data[] = isset($record['Status']) ? htmlspecialchars($record['Status']) : '';

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

    public function ticket_form_submit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();

        $id = $this->request->getVar('UID');
        $Disease = $this->request->getVar('Disease');
//print_r($Disease);exit();
        if (!empty($Disease['DiseaseName'])) {
            if ($id == 0) {
                foreach ($Disease as $key => $value) {
                    $record[$key] = ((isset($value)) ? $value : '');
                }

                $RecordId = $Crud->AddRecord("diseases", $record);
                if (isset($RecordId) && $RecordId > 0) {
                    $response['status'] = 'success';
                    $response['message'] = 'Added Successfully...!';
                } else {
                    $response['status'] = 'fail';
                    $response['message'] = 'Data Didnt Submitted Successfully...!';
                }
            }
            else {
                foreach ($Disease as $key => $value) {
                    $record[$key] = $value;
                }
                $Crud->UpdateRecord("diseases", $record, array("UID" => $id));
                $response['status'] = 'success';
                $response['message'] = 'Updated Successfully...!';
            }

        }
        else{
            $response['status'] = 'fail';
            $response['message'] = 'Name Cant Be Empty...!';
        }

        echo json_encode($response);
    }
  public function TicketReplyFormSubmit()
    {
        $Crud = new Crud();
        $Main = new Main();
        $response = array();
        $record = array();
        $record2 = array();
        $record3 = array();

        $message = $this->request->getVar('message');
        $TaskID = $this->request->getVar('TaskID');
        $UserID = $_SESSION['UID'];
        $Image = $this->request->getFile('files');
//print_r($Image);exit();
      if ($Image->isValid() && !$Image->hasMoved()) {
          $fileImage = file_get_contents($Image->getTempName());

      }
      if ($message != '') {
          $record['TaskID'] = $TaskID;
          $record['ProjectUserID'] = 0;
          $record['StaffID'] = $UserID;
          $record['Message'] = $message;
          $TaskCommentID = $Crud->AddRecord("taskcomments", $record);
          $record2['Status'] = 'Open';
          $Crud->UpdateRecord("tasks", $record2, array("UID" => $TaskID));

          $record3['CommentID'] = $TaskCommentID;
          $record3['File'] = base64_encode($fileImage);
          ;
          $record3['FileExtension'] = '';

          $RecordId = $Crud->AddRecord("taskattachments", $record3);
          if (isset($RecordId) && $RecordId > 0) {
              $response['status'] = 'success';
              $response['message'] = 'Added Successfully...!';
          } else {
              $response['status'] = 'fail';
              $response['message'] = 'Data Didnt Submitted Successfully...!';
          }


      }

        echo json_encode($response);
    }


    public
    function UpdateDeadLineFormSubmit()
    {
        $Crud = new Crud();
       $TaskID = $_POST['TaskID'];
        $Date = $_POST['edit_deadline'];
        $record=array();
//        print_r($TaskID);exit();
        $record['DeadLine']=date("Y-m-d H:i:s", strtotime($Date));
        $Crud->UpdateRecord("tasks", $record, array("UID" => $TaskID));
        $response = array();
        $response['status'] = 'success';
        $response['msg'] = "DeadLine Updated SuccessFully";
        echo json_encode($response);
    }
    public
    function load_tickets_comments(){
        $SupportTicketModel = new SupportTicketModel();
        $html ='';
        $TicketID = $_POST['TicketID'];

        $Data = $SupportTicketModel->GetTicketAllCommentsData( $TicketID );
        $TicketData = $SupportTicketModel->GetTicketDataByID( $TicketID );
//                print_r($TicketData);exit();

        if( count( $Data ) > 0 ){

            $html ='';$User = '';
            //echo'<pre>';print_r( $Data );

            $html.='<div class="card"><div class="card-header"><h4>Comments</h4></div>  
                        <div class="card-body">';

            foreach( $Data as $D ){

                $Attachments = $SupportTicketModel->GetAllAttachmentsByCommentID( $D['UID'] );

                $Profile = $SupportTicketModel->GetExtendedProfielDataByID( $TicketData[0]['ProductProfielID'] );
                $CreatedBy = $SupportTicketModel->GetExtendedUserDataByDBOrID( $Profile[0]['DatabaseName'], $TicketData[0]['CreatedBY']  );
//                    print_r($CreatedBy);exit();
                if( $D['ProjectUserID'] > 0 && $D['StaffID'] == 0 ){

                    $html.='<div class="ks-comment">
                                <div class="ks-body">
                                    <div class="ks-comment-box">
                                        <div class="ks-name">
                                            <a href="javascript:void(0);" style="color: blue;">'.(!empty($CreatedBy) && isset($CreatedBy[0]['FullName'])) ? $CreatedBy[0]['FullName'] : ''.'</a>
                                        </div>
                                        <div class="ks-message">'.$D['Message'].'</div >
                                    </div >
                                </div>';

                    if( count( $Attachments ) > 0 ){
                        $cnt = 0;

                        foreach( $Attachments as $A ){
                            $cnt++;
                            $html.=' <a downlaod="download" href="'.promotion_material_file_download( 'task-attachments_'.$A['UID'].'_'.$A['FileExtension'].'' ).'"><span  class="ks-status badge badge-'.( ( $cnt % 2 > 0 )? 'info' : 'success' ).'"><i class="fa fa-download"> Download '.$cnt.'</i></span></a>';
                        }
                    }

                    $html.='<footer class="blockquote-footer" > '. (!empty($CreatedBy) && isset($CreatedBy[0]['FullName'])) ? $CreatedBy[0]['FullName'] : ''
.'
                                <cite title = "Source Title" >'.date("d M, Y h:i A", strtotime( $D['SystemDate'] )).' </cite>
                                </footer>
                            </div><hr>';


                }else{

                    $User = 'Support Team';
                    $html.='<div class="ks-comment">
                                            <div class="ks-body">
                                                <div class="ks-comment-box">
                                                    <div class="ks-name">
                                                        <a  href="javascript:void(0);" style="color: green; font-weight: bold;">'.$User.'</a>
                                                    </div>
                                                    <div class="ks-message">'.$D['Message'].'</div >
                                                </div >
                                            </div >';

                    if( count( $Attachments ) > 0 ){
                        $cnt = 0;
                        foreach( $Attachments as $A ){
                            $cnt++;
                            $html.=' <a downlaod="download" href="'.promotion_material_file_download( 'task-attachments_'.$A['UID'].'_'.$A['FileExtension'].'' ).'"><span  class="ks-status badge badge-'.( ( $cnt % 2 > 0 )? 'info' : 'success' ).'"><i class="fa fa-download"> Download '.$cnt.'</i></span></a>';
                        }
                    }

                    $html.='<footer class="blockquote-footer" > '.$User.'
                                            <cite title = "Source Title" > '.date("d M, Y h:i A", strtotime( $D['SystemDate'] )).' </cite>
                                            </footer >
                                        </div><hr>';

                }


            }

            $html.='</div>
                            </div>';
        }

        echo $html;
    }
    public
    function search_filter()
    {
        $session = session();
//        $Key = $this->request->getVar( 'Key' );
        $city = $this->request->getVar('Profile');


        $AllFilter = array(
//            'Key' => $Key,
            'Profile' => $city,

        );


//        print_r($AllFilter);exit();
        $session->set('ExtendedFilters', $AllFilter);

        $response['status'] = "success";
        $response['message'] = "Filters Updated Successfully";

        echo json_encode($response);
    }
}
