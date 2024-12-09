<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
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

    public function Customers()
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `customers` where `Archive`=\'0\' Order By `CreateDate` DESC';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public function get_customer_lab_data($ID)
    {
        $Crud = new Crud();

        // Sanitizing the input to prevent SQL injection
        $ID = intval($ID); // Assuming CustomerID is an integer

        $SQL = "SELECT `LabID` FROM `customer_labs` WHERE `CustomerID` = '$ID'";
        $Admin = $Crud->ExecuteSQL($SQL);

        return $Admin;
    }

    public function LaboratoryDropDown()
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `laboratories`  Order By `FullName` DESC';
        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }
    public
    function get_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->Customers();
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->Customers();
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }


}
