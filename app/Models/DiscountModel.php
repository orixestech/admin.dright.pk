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
    }    public function investigation_parameter($keyword,$ID)
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
    function get_datatables_investigation_parameter($keyword,$ID)
    {
        $Crud = new Crud();

        $SQL = $this->investigation_parameter($keyword,$ID);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_datatables_investigation_parameter($keyword,$ID)
    {
        $Crud = new Crud();

        $SQL = $this->investigation_parameter($keyword,$ID);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }

}
