<?php

namespace App\Models;

use CodeIgniter\Model;

class Main extends Model
{

    var $data = array();

    public function __construct()
    {
        $this->data = $this->DefaultVariable();
    }

    public function DefaultVariable()
    {
        helper('main');
//        $session = session();
        $data = $this->data;
        $data['path'] = PATH;
        $data['template'] = TEMPLATE;
        $page = getSegment(1);
        $data['segment_a'] = getSegment(1);
        $data['segment_b'] = getSegment(2);
        $data['segment_c'] = getSegment(3);

        return $data;
    }
    public function LookupsOption($key, $id)
    {
        $Crud = new Crud();

        // SQL query to get the UID from the lookups table based on the key
        $SQL = 'SELECT UID FROM lookups WHERE `Key` = \'' . $key . '\'';

        // Execute the query and get the result
        $sqlResult1 = $Crud->ExecuteSQL($SQL);

        // Get the lookup UID
        if (!empty($sqlResult1)) {
            $lookupId = $sqlResult1[0]['UID'];
        } else {
            return []; // Return an empty array if no result found
        }

        // SQL query to get the lookup options using the lookup UID
        $SQL2 = 'SELECT * FROM lookups_options WHERE LookupUID = \'' . $lookupId . '\' And Archive = \'' . $id . '\' ORDER BY Name';

        // Execute the second query and get the results
        $Admin = $Crud->ExecuteSQL($SQL2);

        return $Admin;
    }

    public

    function RandFileName() {
        $key = substr( md5( rand( 100, 9999999 ) . "|" . date( "U" ) ), 10, 10 );
        return $key;
    }
}
