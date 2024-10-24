<?php

namespace App\Models;

use CodeIgniter\Model;

class LaboratoriesModel extends Model
{

    var $data = array();

    public function __construct()
    {
//        $this->data = $this->DefaultVariable();
    }

//    public function DefaultVariable()
//    {
//        helper('main');
//        $session = session();
//        $data = $this->data;
//        $data['path'] = PATH;
//        $data['template'] = TEMPLATE;
//        $data['site_title'] = SITETITLE;
//        $page = getSegment(1);
//        $data['segment_a'] = getSegment(1);
//        $data['segment_b'] = getSegment(2);
//        $data['segment_c'] = getSegment(3);
//        $data['session'] = $session->get();
//        $data['page'] = ($page == '') ? 'home' : $page;
//
//        return $data;
//    }

    public function laboratories()
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `laboratories`  Order By `SystemDate` DESC';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public
    function get_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->laboratories();
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }
    public function GetLabInquiryCount($labID)
    {
        $Crud = new Crud();
        $sql = 'SELECT 
                COUNT(DISTINCT(`lab_inquiries`.`UID`)) AS InquiryCount, 
                COUNT(`lab_inquiries_data`.`UID`) AS LabInquiryCount 
            FROM `lab_inquiries`
            LEFT JOIN `lab_inquiries_data` ON `lab_inquiries`.`UID` = `lab_inquiries_data`.`InquiryID`
            WHERE `lab_inquiries`.`LabID` =\'' . $labID . '\' 
            GROUP BY `lab_inquiries`.`UID`';

        $Admin = $Crud->ExecuteSQL($sql);

        return $Admin;
    }
    public
    function count_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->laboratories();
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }


}
