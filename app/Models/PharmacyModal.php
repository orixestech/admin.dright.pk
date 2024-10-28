<?php

namespace App\Models;

use CodeIgniter\Model;

class PharmacyModal extends Model
{

    var $data = array();

    public function __construct()
    {
        $this->data = $this->DefaultVariable();
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

    public function pharmacy_profiles()
    {
        $Crud = new Crud();
        $SQL = "SELECT * FROM `pharmacy_profiles` ORDER BY `pharmacy_profiles`.`FullName` ASC";
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public function citites()
    {
        $Crud = new Crud();
        $SQL = "SELECT * FROM `cities` ORDER BY `cities`.`FullName` ASC";
        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }

    public
    function get_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->pharmacy_profiles();
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->pharmacy_profiles();
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }


}
