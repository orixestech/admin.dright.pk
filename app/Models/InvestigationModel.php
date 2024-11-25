<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestigationModel extends Model
{

    var $data = array();


    public function investigation($keyword,$ID)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `investigation` where `Archive`=\'0\'  AND `Parent`=\'' . $ID . '\'
                      ';
        if($keyword!=''){
            $SQL .= ' AND  `Name` LIKE \'%' . $keyword . '%\'   ';
        }
        $SQL .=' Order By `Name` ASC';
//        $Admin = $Crud->ExecuteSQL($SQL);
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
    function get_datatables($keyword,$ID)
    {
        $Crud = new Crud();

        $SQL = $this->investigation($keyword,$ID);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_datatables($keyword,$ID)
    {
        $Crud = new Crud();

        $SQL = $this->investigation($keyword,$ID);
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
