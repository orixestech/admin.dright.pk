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
    public function system_user_roll($id)
    {
        $Crud = new Crud();
        $SQL = 'SELECT `AccessID` FROM `system_users_access` where `UserID`=\'' . $id . '\'  ';
        $records = $Crud->ExecuteSQL($SQL);

        return $records;
    }


    public function DietAdminCategoryList($keyword)
    {

        $Crud = new Crud();
//        $SQL = 'SELECT * FROM `admin_log` where `Archive`=\'0\' Order By `DiseaseName` ASC';

        $SQL = 'SELECT admin_updates.*, system_users.FullName as fullname  FROM admin_updates 
    LEFT JOIN system_users ON admin_updates.EditBy = system_users.UID
        WHERE 1=1

';
        if($keyword!=''){
            $SQL .= ' AND  admin_updates.`Description` LIKE \'%' . $keyword . '%\'  ';
//            $SQL .= ' AND  ( `Name` LIKE \'%' . $keyword . '%\'  OR `Tag` LIKE \'%' . $keyword . '%\') ';
        }
        $SQL .= ' ORDER BY admin_updates.`ApprovedBy` DESC';
        return $SQL;
    }
    public function AdminActivityList($keyword)
    {

        $Crud = new Crud();
//        $SQL = 'SELECT * FROM `admin_log` where `Archive`=\'0\' Order By `DiseaseName` ASC';

        $SQL = 'SELECT admin_log.*, system_users.*  FROM admin_log 
    LEFT JOIN system_users ON admin_log.LoggedUserID = system_users.UID
        WHERE 1=1

';
        if($keyword!=''){
            $SQL .= ' AND  admin_log.`Description` LIKE \'%' . $keyword . '%\'  ';
//            $SQL .= ' AND  ( `Name` LIKE \'%' . $keyword . '%\'  OR `Tag` LIKE \'%' . $keyword . '%\') ';
        }
        $SQL .= ' ORDER BY admin_log.`SystemDate` DESC';
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
    public function get_admin_activity_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->AdminActivityList($keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public function count_admin_activity_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->AdminActivityList($keyword);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }
    public function get_diet_admin_category_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->DietAdminCategoryList($keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public function count_diet_admin_category_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->DietAdminCategoryList($keyword);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }


}
