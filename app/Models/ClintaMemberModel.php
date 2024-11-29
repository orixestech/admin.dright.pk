<?php

namespace App\Models;

use CodeIgniter\Model;

class ClintaMemberModel extends Model
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

    public function members($keyword)
    {
        $session = session();
        $SessionFilters = $session->get('MemberFilters');
        $SQL = "SELECT * FROM public_users 
         WHERE oauth_provider != 'dummy' ";
        if (isset($SessionFilters['Name']) && $SessionFilters['Name'] != '') {
            $Name = $SessionFilters['Name'];
            $SQL .= ' AND  `FirstName` LIKE \'%' . $Name . '%\'';
        }
        if($keyword!=''){
            $SQL .= ' AND  ( `Title` LIKE \'%' . $keyword . '%\'  OR `FirstName` LIKE \'%' . $keyword . '%\' OR `SystemDate` LIKE \'%' . $keyword . '%\' OR `Membership` LIKE \'%' . $keyword . '%\' OR `LastName` LIKE \'%' . $keyword . '%\') ';
        }
        $SQL .= ' ORDER BY `SystemDate` DESC';
//        print_r($SQL);exit();
        return $SQL;
    }


    public
    function get_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->members($keyword);
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

        $SQL = $this->members($keyword);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }


}
