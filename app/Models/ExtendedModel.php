<?php

namespace App\Models;

use CodeIgniter\Model;

class ExtendedModel extends Model
{

    var $data = array();

    public function __construct()
    {
//        $this->data = $this->DefaultVariable();
    }

    public function extended_profiles()
    {
        $Crud = new Crud();
        $SQL = "SELECT * FROM  `extended_profiles` ORDER BY `extended_profiles`.`FullName` ASC";
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }

    public function Allprofiless($ID)
    {
        $Crud = new Crud();
        $SQL = 'SELECT "public"."profiles".*
        FROM "public"."profiles"  
        LEFT JOIN "public"."profile_metas" 
        ON "public"."profiles"."UID" = "public"."profile_metas"."ProfileUID"  
            LEFT JOIN "public"."visitors" 
        ON "public"."profiles"."UID" = "public"."visitors"."ProfileUID"

        WHERE "public"."profiles"."Type" =\'' . $ID . '\' 
        ORDER BY "public"."profiles"."Name" ASC ';
//        $Admin = $Crud->ExecutePgSQL($SQL);
//        print_r($SQL);exit();
        return $SQL;
    }
  

    public
    function get_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->extended_profiles();
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

        $SQL = $this->extended_profiles();
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }

}
