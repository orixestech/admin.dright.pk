<?php

namespace App\Models;

use CodeIgniter\Model;

class SupportTicketModel extends Model
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

    public function GetAllClinTaExtendedSupportTicketsData()
    {
        $Crud = new Crud();
        $key='ClinTa_Extended';
        $session = session();
        $SessionFilters = $session->get('ExtendedFilters');
        $SQL = 'SELECT * FROM `tasks` where `Product` = \'' . $key . '\'';
//        $Admin = $Crud->ExecuteSQL($SQL);
        if (isset($SessionFilters['profiles']) && $SessionFilters['profiles'] != '') {
            $ProductProfielID = $SessionFilters['ProductProfielID'];
            $SQL .= ' AND  `ProductProfielID` LIKE \'%' . $ProductProfielID . '%\'';
        }if (isset($SessionFilters['Status']) && $SessionFilters['Status'] != '') {
        $Status = $SessionFilters['Status'];
        $SQL .= ' AND  `Status` LIKE \'%' . $Status . '%\'';
    }

        $SQL .=' Order By `SystemDate` DESC';
        return $SQL;
    }

    public
    function get_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->GetAllClinTaExtendedSupportTicketsData();
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

        $SQL = $this->GetAllClinTaExtendedSupportTicketsData();
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }

    public function GetExtendedUserDataByDBOrID($DBName, $uid)
    {
        // Set database name for localhost
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $DBName = 'clinta_extended';
        }

        // Custom database configuration
        $custom = [
            'DSN'          => '',
            'hostname'     => PGDB_HOST,
            'username'     => 'clinta_postgre',
            'password'     => 'PostgreSql147',
            'database'     => $DBName,
            'DBDriver'     => 'Postgre',
            'DBPrefix'     => '',
            'pConnect'     => false,
            'DBDebug'      => true,
            'charset'      => 'utf8',
            'DBCollat'     => 'utf8_general_ci',
            'swapPre'      => '',
            'encrypt'      => false,
            'compress'     => false,
            'strictOn'     => false,
            'failover'     => [],
            'port'         => 5432,
            'numberNative' => false,
        ];

        try {
            // Connect to the custom database
            $ExtendedDb = \Config\Database::connect($custom);

            // Query builder for the table
            $builder = $ExtendedDb->table('clinta.AdminUsers');

            // Fetch records with specified conditions
            $builder->select('*');
            $builder->where([
                'UID' => $uid,
                'Archive' => 0
            ]);

            $query = $builder->get();
            $records = $query->getResultArray();

            if (!is_array($records)) {
                $records = [];
            }

            return $records;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            log_message('error', 'Database connection or query failed: ' . $e->getMessage());
            return [];
        }
    }

    public function GetLatestCommentDataByTicketID($key)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `taskcomments` where `TaskID` = \'' . $key . '\'';

        $SQL .= ' ORDER BY `SystemDate` DESC';
        //        print_r($SQL);exit();
                $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }
    public function GetExtendedProfielDataByID($key)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `extended_profiles` where `UID` = \'' . $key . '\'';

        //        print_r($SQL);exit();
                $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }
    public function GetTicketDataByID($key)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `tasks` where `UID` = \'' . $key . '\'';
         $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }
    public function GetTicketAllCommentsData($key)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `taskcomments` where `TaskID` = \'' . $key . '\' Order by `SystemDate` DESC';
        $Admin = $Crud->ExecuteSQL($SQL);
//        print_r($SQL);exit();

        return $Admin;
    }
    public function GetAllAttachmentsByCommentID($key)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `taskattachments` where `CommentID` = \'' . $key . '\' Order by `SystemDate` DESC';
         $Admin = $Crud->ExecuteSQL($SQL);
//         print_r($SQL);exit();
        return $Admin;
    }
}
