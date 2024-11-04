<?php

namespace App\Models;

use CodeIgniter\Model;

class HealthcareModel extends Model
{

    var $data = array();

    public function __construct()
    {
//        $this->data = $this->DefaultVariable();
    }

    public function DefaultVariable()
    {
//        helper('main');
//        $session = session();
        $data = $this->data;
        $data['path'] = PATH;
        $data['template'] = TEMPLATE;
        $page = getSegment(1);
        $data['segment_a'] = getSegment(1);
        $data['segment_b'] = getSegment(2);
        $data['segment_c'] = getSegment(3);
//        $data['session'] = $session->get();
//        $data['page'] = ($page == '') ? 'home' : $page;
//
        return $data;
    }

    public function Diet($item,$keyword)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `public_diet` where `Category`=\'' . $item . '\'  ';
        if($keyword!=''){
            $SQL .= ' AND  `Name` LIKE \'%' . $keyword . '%\'   ';
//            $SQL .= ' AND  ( `Name` LIKE \'%' . $keyword . '%\'  OR `Tag` LIKE \'%' . $keyword . '%\') ';
        }
        $SQL .= ' ORDER BY `Name` ASC';

//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }

    public function DietCategory()
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `public_diet_category` Order By `OrderID` ASC';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }

    public function support_videos()
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `support_videos` Order By `OrderID` ASC';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public function representatives()
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `representatives` Order By `FullName` ASC';
//        $Admin = $Crud->ExecuteSQL($SQL);
        return $SQL;
    }
    public function GenerateBranchesOptions()
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `public_branches` Order By `FullName` ASC';
        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }

    public function GetDietDataByID($item)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `public_diet` where `UID`=\'' . $item . '\'  ';
        $Admin = $Crud->ExecuteSQL($SQL);
//        $Admin=$Admin[0];
        return $Admin;
    }    public function get_rcc_receipts_data_by_id($item)
    {
        $Crud = new Crud();
        $SQL = 'SELECT * FROM `representative_receipts` where `RepresentativeUID`=\'' . $item . '\'  ';
        $Admin = $Crud->ExecuteSQL($SQL);
//        $Admin=$Admin[0];
        return $Admin;
    }

    public function GetNutritionalValue($item, $option)
    {
        $Crud = new Crud();
        $SQL = 'SELECT `Value` FROM `public_diet_facts` where `DietID`=\'' . $item . '\' AND `OptionID`=\'' . $option . '\'  ';
        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin;
    }


    public function NutritionalArray()
    {
        $Crud = new Crud();
//        $finalArray='';
        $sql = "SELECT * FROM `public_diet_category` ORDER BY FIELD(`Category`, 'Energy','Carbohydrates','Fat', 'Protein', 'Vitamins', 'Minerals', 'Others')";
        $Admin = $Crud->ExecuteSQL($sql);
//        echo '<pre>';
//        print_r($Admin);exit();
        foreach ($Admin as $row) {
            $finalArray[$row['Category']][] = array(
                "id" => $row['UID'],
                "title" => $row['SubCategory'],
                "unit" => $row['Unit'],
                "description" => $row['Description'],
                "EAR" => $row['EAR'],
                "RDA" => $row['RDA'],
                "UL" => $row['UL']
            );
        }
        return $finalArray;
    }

    public function GetNutritionalCountByItem($item)
    {
        $Crud = new Crud();
        $SQL = 'SELECT COUNT(`UID`) as CNT FROM `public_diet_facts` WHERE `DietID` = \'' . $item . '\'';
        $Admin = $Crud->ExecuteSQL($SQL);
        return $Admin[0]['CNT'];
    }

    public
    function get_support_videos_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->support_videos();
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_support_videos_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->support_videos();
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }
  public
    function get_representatives_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->representatives();
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_representatives_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->representatives();
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }

    public
    function get_diet_datatables($item,$keyword)
    {
        $Crud = new Crud();

        $SQL = $this->Diet($item,$keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_diet_datatables($item,$keyword)
    {
        $Crud = new Crud();

        $SQL = $this->Diet($item,$keyword);
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }

    public
    function get_diet_category_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->DietCategory();
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_diet_category_datatables()
    {
        $Crud = new Crud();

        $SQL = $this->DietCategory();
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }

    public
    function get_vegetable_datatables($keyword)
    {
        $Crud = new Crud();
        $food = 'vegetables';

        $SQL = $this->Diet($food,$keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_vegetable_datatables($keyword )
    {
        $Crud = new Crud();
        $food = 'vegetables';

        $SQL = $this->Diet($food,$keyword);
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }

    public
    function get_miscellaneous_datatables($keyword)
    {
        $Crud = new Crud();
        $food = 'miscellaneous';

        $SQL = $this->Diet($food,$keyword);
        if ($_POST['length'] != -1)
            $SQL .= ' limit ' . $_POST['length'] . ' offset  ' . $_POST['start'] . '';
//        echo nl2br($SQL); exit;
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();

        return $records;
    }

    public
    function count_miscellaneous_datatables($keyword)
    {
        $Crud = new Crud();
        $food = 'miscellaneous';

        $SQL = $this->Diet($food,$keyword);
        $records = $Crud->ExecuteSQL($SQL);
//        print_r($records);exit();
        return count($records);
    }

}
