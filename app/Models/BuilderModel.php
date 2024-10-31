<?php

namespace App\Models;

use CodeIgniter\Model;

class BuilderModel extends Model
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
    public function get_profile_options_data_by_id_option($id, $option)
    {
        $Crud = new Crud();
        $SQL = 'SELECT *
        FROM "public"."options"  
        where "public"."options"."ProfileUID" = \'' . $id . '\' And "public"."options"."Name" = \'' . $option . '\'; ';

        $Admin = $Crud->ExecutePgSQL($SQL);
//        print_r($Admin);exit(
//    );
        return $Admin;
    }
    public function general_banners()
    {
        $Crud = new Crud();
        $SQL = 'SELECT `general_banners`.*, `specialities`.`Name` AS Title FROM `general_banners` 
    LEFT JOIN `specialities` ON `general_banners`.`Speciality` = `specialities`.`UID`
       ORDER BY `general_banners`.`SystemDate` ASC

';
//        $Admin = $Crud->ExecuteSQL($SQL);
//        print_r($Admin);exit();
        return $SQL;
    }
    public function specialities()
    {
        $Crud = new Crud();
        $SQL = "SELECT * FROM `specialities` ORDER BY `specialities`.`Name` ASC";
        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
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
  
    public function websites_images()
    {
        $Crud = new Crud();
        $SQL = "SELECT * FROM `websites_images` ORDER BY `websites_images`.`SystemDate` DESC";
//        $Admin = $Crud->ExecuteSQL($SQL);
//        print_r($Admin);exit();
        return $SQL;
    }

    public
    function get_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->general_banners();
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

        $SQL = $this->general_banners();
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }
  public
    function get_images_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->websites_images();
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_image_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->websites_images();
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }
    public
    function get_doct_datatables($id)
    {
        $Crud = new Crud();

        $SQL = $this->Allprofiless($id);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecutePgSQL($SQL);
//        print_r($records);exit();

        return $records;
    }
 public
    function count_doct_datatables($id)
    {
        $Crud = new Crud();

        $SQL = $this->Allprofiless($id);
        $SQL = 'select count(*) from ( '.$SQL.' ) as "MASTERTABLE"';
        $Admin = $Crud->ExecutePgSQL($SQL);
        return $Admin[0]['count'];
    }


}
