<?php

namespace App\Models;

use CodeIgniter\Model;

class HealthcareModel extends Model
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

    public function Diet($item)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `public_diet` where `Category`=\'' . $item . '\' Order By `Name` ';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public
    function get_fruit_datatables($keyword='')
    {
        $Crud = new Crud();
        $item='fruits';
        $SQL = $this->Diet($item);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_fruit_datatables($keyword='')
    {
        $Crud = new Crud();
        $item='fruits';

        $SQL = $this->Diet($item);
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }
    public
    function get_vegetable_datatables($keyword='')
    {
        $Crud = new Crud();
        $food='vegetables';

        $SQL = $this->Diet($food);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_vegetable_datatables($keyword='')
    {
        $Crud = new Crud();
        $food='vegetables';

        $SQL = $this->Diet($food);
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }   public
    function get_miscellaneous_datatables($keyword='')
    {
        $Crud = new Crud();
        $food='miscellaneous';

        $SQL = $this->Diet($food);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_miscellaneous_datatables($keyword='')
    {
        $Crud = new Crud();
        $food='miscellaneous';

        $SQL = $this->Diet($food);
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }

}
