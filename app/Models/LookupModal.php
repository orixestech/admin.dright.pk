<?php

namespace App\Models;

use CodeIgniter\Model;

class LookupModal extends Model
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

    public function Lookup()
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `lookups` where `Archive`=\'0\' Order By `Name` ASC';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public function LookupOption($LookupID)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `lookups_options` where `Archive`=\'0\' AND  `LookupUID`=\'' . $LookupID . '\' Order By `Name` ASC';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public
    function get_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->Lookup();
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

        $SQL = $this->Lookup();
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }
    public
    function get_lookup_option_datatables($LookupID)
    {
        $Crud = new Crud();

        $SQL = $this->LookupOption($LookupID);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_lookup_optiondatatables($LookupID)
    {
        $Crud = new Crud();

        $SQL = $this->LookupOption($LookupID);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }


}
