<?php

namespace App\Models;

use CodeIgniter\Model;

class Main extends Model
{

    var $data = array();

    public function __construct()
    {
        helper('main');
        $this->data = $this->DefaultVariable();
    }

    public function DefaultVariable()
    {
        helper('main');
        $session = session();
        $data = $this->data;
        $data['path'] = PATH;
        $data['template'] = TEMPLATE;
        $page = getSegment(1);
        $data['segment_a'] = getSegment(1);
        $data['segment_b'] = getSegment(2);
        $data['segment_c'] = getSegment(3);
        $data['session'] = $session->get();
        $data['page'] = ($page == '') ? 'home' : $page;
        CheckLogin($data);
        return $data;
    }
//    public
//
//    function CRYPT( $q, $status ) {
//        if ( $status == 'hide' ) {
//            $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
//            $qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
//            return ( $qEncoded );
//        }
//
//        if ( $status == 'show' ) {
//            $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
//            $qDecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0" );
//            return ( $qDecoded );
//        }
//    }
    function CRYPT($q, $status)
    {
        $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
        $method = 'AES-256-CBC';
        $key = hash('sha256', $cryptKey);

        if ($status === 'hide') {
            $qEncoded = base64_encode(($q));
            return $qEncoded;
        }

        if ($status === 'show') {
            $qDecoded = base64_decode($q);
            return $qDecoded;
        }

        return null; // in case $status is neither 'hide' nor 'show'
    }

    public

    function SeoUrl( $url ) {
        $url = preg_replace( '/[^a-zA-Z0-9_\/]/', '-', trim( $url ) );
        $url = strtolower( $url );
        $url = str_replace( "--", "-", $url );
        $url = str_replace( "--", "-", $url );
        $url = str_replace( "--", "-", $url );
        return base_url( $url );
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
