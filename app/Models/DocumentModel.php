<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
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


    public function document($item)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `public_documents` where `Archive`=\'0\' AND `Category`=\'' . $item . '\' Order By `SystemDate` DESC';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public
    function get_datatables($item)
    {
        $Crud = new Crud();

        $SQL = $this->document($item);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_datatables($item)
    {
        $Crud = new Crud();

        $SQL = $this->document($item);
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }

}
