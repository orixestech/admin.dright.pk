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
    }   public function invoice($keyword)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `invoices` where `Archive`=\'0\'  ';
        if($keyword!=''){
            $SQL .= ' AND  ( `Name` LIKE \'%' . $keyword . '%\'  OR `Email` LIKE \'%' . $keyword . '%\' OR `PhoneNumber` LIKE \'%' . $keyword . '%\') ';
        }
        $SQL .= ' ORDER BY `SystemDate` DESC';
        return $SQL;
    } public function items()
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `items` where 1=1  ';

        $SQL .= ' ORDER BY `Name` DESC';
        $records = $Crud->ExecuteSQL($SQL);

        return $records;
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
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_users_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->systemusers($keyword);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }    public
    function get_invoice_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->invoice($keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_invoice_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->invoice($keyword);
        $records = $Crud->ExecuteSQL($SQL);
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
    public function checkAcccessKey($key)
    {
        $db = \Config\Database::connect(); // Connect to the database
        $builder = $db->table('admin_access'); // Table for access levels

        // Start a transaction
        $db->transStart();

        // Fetch UID based on the provided key
        $builder->select('UID')
            ->where('AccessKey', $key);
        $accessLevel = $builder->get()->getRowArray();

        if (!$accessLevel || !isset($accessLevel['UID'])) {
            $db->transComplete();
            return 0; // Return 0 if no UID found for the key
        }

        $UID = $accessLevel['UID'];

        // Check if an entry exists in system_users_access with the same UID and UserID
        $systemAccessBuilder = $db->table('system_users_access');
        $systemAccessBuilder->select('1') // We only need to check existence
        ->where('AccessID', $UID)
            ->where('UserID', $_SESSION['UID']); // Replace this with the actual UserID input
        $exists = $systemAccessBuilder->get()->getRowArray();
        print_r($exists);
        $db->transComplete();

        // Return 1 if an entry exists, otherwise return 0
        return ($exists) ? 1 : 0;
    }
    public function checkAccessKey($key)
    {
        $Crud = new Crud();

        // SQL query to get the UID from the lookups table based on the key
        $SQL = 'SELECT UID FROM admin_access WHERE `AccessKey` = \'' . $key . '\'';

        // Execute the query and get the result
        $sqlResult1 = $Crud->ExecuteSQL($SQL);

        // Get the lookup UID
        if (!empty($sqlResult1)) {
            $Id = $sqlResult1[0]['UID'];
        } else {
            return []; // Return an empty array if no result found
        }

        // SQL query to get the lookup options using the lookup UID
        $SQL2 = 'SELECT * FROM system_users_access WHERE AccessID = \'' . $Id . '\' And UserID = \'' . $_SESSION['UID'] . '\' ';

        // Execute the second query and get the results
        $Admin = $Crud->ExecuteSQL($SQL2);
        if(count($Admin)>0){
            $Admin=1;
        }else{
            $Admin=0;
        }
        return $Admin;
    }

}
