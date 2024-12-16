<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscountModel extends Model
{

    var $data = array();


    public function ListDiscountCenter($keyword)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `discount_center` where 1=1 
                      ';
        if($keyword!=''){
            $SQL .= ' AND  `Title` LIKE \'%' . $keyword . '%\'   ';
        }
        $SQL .=' Order By `OrderID` ASC';
        return $SQL;
    }
    public function ListDiscountCenterOffers($id,$keyword)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `discount_center_offers`  where `DiscountCenterID`=\'' . $id . '\'
                      ';
        if($keyword!=''){
            $SQL .= ' AND  `Name` LIKE \'%' . $keyword . '%\'   ';
        }
        return $SQL;
    }  public function discount_center_doctors($id,$keyword)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `discount_center_doctors`  where `DiscountCenterUID`=\'' . $id . '\'
                      ';
        if($keyword!=''){
            $SQL .= ' AND  `Name` LIKE \'%' . $keyword . '%\'   ';
        }
        return $SQL;
    }
    public function get_speciality_data()
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `specialities` where `Archive`=\'0\'
                      ';

        $SQL .=' Order By `Name` ASC';
        $records = $Crud->ExecuteSQL($SQL);

        return $records;
    }
    public function GetDiscountCenterImagesByID($id)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `discount_center_images` where `DiscountCenterID`=\'' . $id . '\'
                      ';

        $SQL .=' Order By `SortOrder` ';
        $records = $Crud->ExecuteSQL($SQL);

        return $records;
    }
    public function get_discount_center_Specialities_by_id($id)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `discount_center_specialities` where `DiscountCenterUID`=\'' . $id . '\'
                      ';

        $records = $Crud->ExecuteSQL($SQL);

        return $records;
    }
    public function get_discount_center_timings_by_doct_id($id)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `discount_center_timings` where `DiscountCenterID`=\'' . $id . '\'
                      ';
        $records = $Crud->ExecuteSQL($SQL);

        return $records;
    }
    public function get_doct_timings_by_doct_id($id)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `discount_center_doctors_timings` where `DiscountDoctUID`=\'' . $id . '\'
                      ';
        $records = $Crud->ExecuteSQL($SQL);

        return $records;
    }
    public function investigation_parameter($keyword,$ID)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `investigation_parameters` where `Archive`=\'0\'  AND `InvestigationUID`=\'' . $ID . '\'
                      ';
        if($keyword!=''){
            $SQL .= ' AND  `Parameters` LIKE \'%' . $keyword . '%\'   ';
        }
        $SQL .=' Order By `Parameters` ASC';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public
    function get_discount_datatables($keyword)
    {
        $Crud = new Crud();
        $SQL = $this->ListDiscountCenter($keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_discount_datatables($keyword)
    {
        $Crud = new Crud();
        $SQL = $this->ListDiscountCenter($keyword);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }
  public
    function get_datatables_discount_offer($ID,$keyword)
    {
        $Crud = new Crud();
        $SQL = $this->ListDiscountCenterOffers($ID,$keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_datatables_discount_offer($ID,$keyword)
    {
        $Crud = new Crud();
        $SQL = $this->ListDiscountCenterOffers($ID,$keyword);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }public
    function get_datatables_discount_doctor($ID,$keyword)
    {
        $Crud = new Crud();
        $SQL = $this->discount_center_doctors($ID,$keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_datatables_discount_doctor($ID,$keyword)
    {
        $Crud = new Crud();
        $SQL = $this->discount_center_doctors($ID,$keyword);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }

}
