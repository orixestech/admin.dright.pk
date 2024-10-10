<?php

namespace App\Controllers;

use App\Models\Main;

class Home extends BaseController
{
    var $data = array();

    public function __construct()
    {
        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
    }

    public function testing()
    {
        $data = $this->data;

        $UserData = new Main();
        $data['Med'] = $UserData->AllMED();
//        echo view('header');

    }

    public function index()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('home', $data);
        echo view('footer', $data);

    }
    public function fruit_search_filter()
    {
        $session = session();
        $Categories = $this->request->getVar( 'Categories' );


        $AllFilter = array (
            'Categories' => $Categories,

        );


//        print_r($AllCVFilter);exit;
        $session->set( 'FruitFilters', $AllFilter );

        $response[ 'status' ] = "success";
        $response[ 'message' ] = "Filters Updated Successfully";

        echo json_encode( $response );
    }


    public
    function clear_session()
    {
        $session = session();
        $SessionName = $this->request->getVar( 'SessionName' );

        $session->set( $SessionName, array () );

        $response = array ();
        $response[ 'status' ] = 'success';
        $response[ 'message' ] = "Filters Updated Successfully";
        echo json_encode( $response );
    }

    public function login()
    {
        $data = $this->data;
        echo view('login', $data);
    }

    public function table()
    {
        $data = $this->data;
        echo view('header', $data);
        echo view('table', $data);
        echo view('footer', $data);

    }
}
