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

    public function Lookup($keyword)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `lookups` where `Archive`=\'0\' 
                      ';
        if($keyword!=''){
            $SQL .= ' AND  `Name` LIKE \'%' . $keyword . '%\'   ';
        }
        $SQL .=' Order By `Name` ASC';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public function LookupOption($LookupID,$keyword)
    {
        $Crud = new Crud();
        $session = session();
        $SessionFilters = $session->get('LookupFilters');
        $SQL = 'SELECT * FROM `lookups_options` where `Archive`=\'0\' AND  `LookupUID`=\'' . $LookupID . '\' ';
        if (isset($SessionFilters['Name']) && $SessionFilters['Name'] != '') {
            $Name = $SessionFilters['Name'];
            $SQL .= ' AND  `Name` LIKE \'%' . $Name . '%\'';
        }
        if($keyword!=''){
            $SQL .= ' AND  `Name` LIKE \'%' . $keyword . '%\'   ';
        }
        $SQL .=' Order By `Name` ASC';
//        print_r($SQL);exit();
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public function LookupOptionBYID($LookupID)
    {
        $Crud = new Crud();
        $sql = 'SELECT * FROM lookups_options WHERE UID =\'' . $LookupID . '\'';  // Use a parameterized query to avoid SQL injection
        $Admin = $Crud->ExecuteSQL($sql);
        return $Admin;
    }
    public
    function get_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->Lookup($keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->Lookup($keyword);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }
    public
    function get_lookup_option_datatables($LookupID,$keyword)
    {
        $Crud = new Crud();

        $SQL = $this->LookupOption($LookupID,$keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_lookup_optiondatatables($LookupID,$keyword)
    {
        $Crud = new Crud();

        $SQL = $this->LookupOption($LookupID,$keyword);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }


}
