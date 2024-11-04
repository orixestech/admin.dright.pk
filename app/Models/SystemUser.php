<?php

namespace App\Models;

use CodeIgniter\Model;

class SystemUser extends Model
{

    var $data = array();

    public function __construct()
    {
//        $this->data = $this->DefaultVariable();
    }



    public function systemusers($keyword)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `system_users` where `Archive`=\'0\' AND `Email`!=\'info@orixestech.com\' ';
        if($keyword!=''){
            $SQL .= ' AND  ( `FullName` LIKE \'%' . $keyword . '%\'  OR `Email` LIKE \'%' . $keyword . '%\' OR `AccessLevel` LIKE \'%' . $keyword . '%\') ';
        }
        $SQL .= ' ORDER BY `SystemDate` DESC';
        return $SQL;
    }
    public
    function get_users_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->systemusers($keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_users_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->systemusers($keyword);
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }


}
