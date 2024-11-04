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

    public function get_speciality_images_by_id($id)
    {
        $Crud = new Crud();
        $SQL = "SELECT * FROM `speciality_metas` WHERE `SpecialityUID` = '" . $id . "' AND `Option` != 'heading' AND `Option` != 'short_message'";

        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }
    public function get_profile_options_data_by_id_option($id, $option)
    {
        $Crud = new Crud();
        $SQL = 'SELECT *
        FROM "public"."options"  
        where "public"."options"."ProfileUID" = \'' . $id . '\' And "public"."options"."Name" = \'' . $option . '\'; ';
        $Admin = $Crud->ExecutePgSQL($SQL);
        return $Admin;
    }
    public function general_banners()
    {
        $Crud = new Crud();
        $SQL = 'SELECT `general_banners`.*, `specialities`.`Name` AS Title FROM `general_banners` 
    LEFT JOIN `specialities` ON `general_banners`.`Speciality` = `specialities`.`UID`
       ORDER BY `general_banners`.`SystemDate` ASC

';
        return $SQL;
    }
    public function specialities()
    {
        $Crud = new Crud();
        $SQL = "SELECT * FROM `specialities` ORDER BY `specialities`.`Name` ASC";
        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }
    public function extended_profiles()
    {
        $Crud = new Crud();
        $SQL = "SELECT * FROM  `extended_profiles` ORDER BY `extended_profiles`.`FullName` ASC";
        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }
    public function get_all_sponsors()
    {
        $Crud = new Crud();
        $SQL = "SELECT * FROM `sponsors` WHERE `Archive` = '0' ORDER BY `sponsors`.`OrderID` ASC";
        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }
    public function specialitiess()
    {
        $Crud = new Crud();
        $SQL   = "SELECT * FROM `specialities` WHERE `Archive` = '0' ORDER BY `Name` ASC";
//        print_r($SQL);exit();
        return $SQL;
    }
    public function Allprofiless($ID)
    {
        $Crud = new Crud();
        $SQL = 'SELECT "public"."profiles".*
        FROM "public"."profiles"  
        WHERE "public"."profiles"."Type" =\'' . $ID . '\' 
        ORDER BY "public"."profiles"."Name" ASC ';
        return $SQL;
    }
  
    public function websites_images()
    {
        $Crud = new Crud();
        $SQL = "SELECT * FROM `websites_images` ORDER BY `websites_images`.`SystemDate` DESC";
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
        return count($records);
    }
  public
    function get_images_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->websites_images();
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
        $records = $Crud->ExecuteSQL($SQL);

        return $records;
    }

    public
    function count_image_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->websites_images();
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }
    public
    function get_specialities_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->specialitiess();
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
        $records = $Crud->ExecuteSQL($SQL);

        return $records;
    }
 public
    function count_specialities_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->specialitiess();
        $SQL = 'select count(*) as `UID` from ( '.$SQL.' ) as `MASTERTABLE`';
        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin[0]['UID'];
    }


}
