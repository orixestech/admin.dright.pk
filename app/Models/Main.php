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

    public

    function RandFileName() {
        $key = substr( md5( rand( 100, 9999999 ) . "|" . date( "U" ) ), 10, 10 );
        return $key;
    }
}
