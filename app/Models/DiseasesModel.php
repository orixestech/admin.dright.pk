<?php

namespace App\Models;

use CodeIgniter\Model;

class DiseasesModel extends Model
{

    var $data = array();

    public function __construct()
    {
//        $this->data = $this->DefaultVariable();
    }

    public function diseases($keyword)
    {

        $Crud = new Crud();
//        $SQL = 'SELECT * FROM `diseases` where `Archive`=\'0\' Order By `DiseaseName` ASC';

        $SQL = 'SELECT diseases.*, lookups_options.Name AS Title FROM diseases 
    LEFT JOIN lookups_options ON diseases.BodySystem = lookups_options.UID
        WHERE diseases.`Archive`=\'0\'

';
        if($keyword!=''){
            $SQL .= ' AND  diseases.`DiseaseName` LIKE \'%' . $keyword . '%\'   ';
//            $SQL .= ' AND  ( `Name` LIKE \'%' . $keyword . '%\'  OR `Tag` LIKE \'%' . $keyword . '%\') ';
        }
        $SQL .= ' ORDER BY diseases.`DiseaseName` ASC';

//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }

    public
    function get_diseases_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->diseases($keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
        return $records;
    }

    public
    function count_diseases_datatables($keyword)
    {
        $Crud = new Crud();

        $SQL = $this->diseases($keyword);
        $records = $Crud->ExecuteSQL($SQL);
        return count($records);
    }


}
