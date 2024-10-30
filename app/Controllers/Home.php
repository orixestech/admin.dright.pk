<?php

namespace App\Controllers;

use App\Models\Crud;
use App\Models\Main;

class Home extends BaseController
{
    var $data = array();
    var $MainModel;

    public function __construct()
    {
        $this->MainModel = new Main();
        $this->data = $this->MainModel->DefaultVariable();
    }

    public function testing()
    {
        $data = $this->data;
        echo '<pre>';
        $Crud = new Crud();
        // $Query = 'SELECT "UID", "Heading" FROM public."banner"';
        // $records = $Crud->ExecutePgSQL($Query);
        // print_r($records);


        $Main = new Main();
        echo $Main->CRYPT("Shaheryar", "hide");
        echo $Main->CRYPT("U2hhaGVyeWFy", "show");
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
        $Categories = $this->request->getVar('Categories');
        $AllFilter = array(
            'Categories' => $Categories,

        );


        //        print_r($AllCVFilter);exit;
        $session->set('FruitFilters', $AllFilter);

        $response['status'] = "success";
        $response['message'] = "Filters Updated Successfully";

        echo json_encode($response);
    }


    /**
     * Clears the given session variable.
     *
     * @return JSON
     */
    public
    function clear_session()
    {
        $session = session();
        $SessionName = $this->request->getVar('SessionName');

        $session->set($SessionName, array());

        $response = array();
        $response['status'] = 'success';
        $response['message'] = "Filters Updated Successfully";
        echo json_encode($response);
    }

    /**
     * Displays the login view.
     *
     * Loads the login view and passes the necessary data to it for rendering.
     */
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

    /**
     * Handles the login process for the system users
     *
     * Retrieves the input email and password from the request object, encrypts the password, and then
     * checks for a matching record in the system_users table. If a match is found, sets the session
     * variables and returns a success response, otherwise returns a fail response.
     *
     * @return mixed
     */
    public function system_user_login_submit()
    {
        $Email = $this->request->getVar('inputEmail');
        $password = $this->request->getVar('Password');

        $Crud = new Crud();
        $Main = new Main();

        $response = array();
        $table = 'system_users';
        $password = $Main->CRYPT($password, 'hide');
        $where = array("Email" => $Email, "Password" => $password);

        $Record = $Crud->SingleRecord($table, $where);

        if (!empty($Record['UID'])) {
            $SessionArray = [
                'UID' => $Record['UID'],
                'Email' => $Record['Email'],
                'FullName' => $Record['FullName'],
                'AccessLevel' => $Record['AccessLevel'],
                'UserType' => '',
                'logged_in' => TRUE
            ];
            //  print_r($SessionArray);exit();
            $session = session();

            $session->set("Profile", $SessionArray);
            $_SESSION['Profile'] = $SessionArray;
            // $session->set("Profile", $SessionArray);

            $response['status'] = "success";
            $response['message'] = "You are successfully logged";
            $response['session'] = $session->get();
        } else {
            $response['status'] = "fail";
            $response['message'] = "Invalid Login Credentials, Please Try again...";
        }
        // $response['status'] = "fail";
        // $response['message'] = "Invalid Login Credentials, Please Try again...";
        echo json_encode($response);
    }

    /**
     * Destroys the session and redirects to the login page
     *
     * @return void
     */
    public function logout()
    {
        $data = $this->data;
        // $session = session();
        // $session->destroy();
        header("Location: " . $data['path'] . "login");
        exit;
    }
}
