<?php

namespace App\Controllers;

use App\Models\BuilderModel;
use App\Models\Crud;
use App\Models\HealthcareModel;
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

    public function fetch_frenchises()
    {
        $Healthcare = new HealthcareModel();
        $keyword = ((isset($_POST['search']['value'])) ? $_POST['search']['value'] : '');

        $Data = $Healthcare->get_frenchises_datatables($keyword);
        $totalfilterrecords = $Healthcare->count_frenchises_datatables($keyword);
//        print_r($Data);
//        exit();

        $dataarr = array();
        $cnt = $_POST['start'];
        foreach ($Data as $record) {
            $cnt++;
            $data = array();
            $data[] = $cnt;
            $data[] = (isset($record['ProfileImage']) && $record['ProfileImage'] != '')
                ? '<img src="' . PATH . 'upload/franchise/' . $record['ProfileImage'] . '" class="img-thumbnail" style="height:80px;">'
                : '<img class="img-thumbnail" style="height:40px;" src="' . PATH . 'upload/franchise/no-images.png">';
            $data[] = isset($record['FullName']) ? htmlspecialchars($record['FullName']) : '';
            $data[] = isset($record['Email']) ? htmlspecialchars($record['Email']) : '';
            $data[] = isset($record['ShortProfile']) ? htmlspecialchars($record['ShortProfile']) : '';
            $data[] = isset($record['ShortBusinessDesc']) ? htmlspecialchars($record['ShortBusinessDesc']) : '';
            $data[] = isset($record['Status'])
                ? ($record['Status'] == 2
                    ? 'requested'
                    : ($record['Status'] == 1
                        ? 'active'
                        : 'block'))
                : '';
//            echo 'fff00';exit();

            $data[] = '
    <td class="text-end">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="UpdateBranches(' . htmlspecialchars($record['UID']) . ')">Update</a>
                <a class="dropdown-item" onclick="DeleteBranches(' . htmlspecialchars($record['UID']) . ')">Delete</a>
            </div>
        </div>
    </td>';

            $dataarr[] = $data;
        }

        $response = array(
            "draw" => intval($this->request->getPost('draw')),
            "recordsTotal" => count($Data),
            "recordsFiltered" => $totalfilterrecords,
            "data" => $dataarr
        );

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
        echo view('login1', $data);
    }

    public function load_image()
    {
        $Code = getSegment(2);
        $Code = base64_decode($Code);
        list($driver, $table, $uid) = explode('|', $Code);
        $Crud = new Crud();
        header('Content-Type: image');


        if ($driver == 'mysql') {
            $record = $Crud->SingleRecord($table, array('UID' => $uid));

            if ($table == 'general_banners') {
                $column = 'Image';
            }
            if ($table == 'sponsors') {
                $column = 'Image';
            }

            $image = base64_decode($record[$column]);
            echo $image;
        }
        if ($driver == 'pgsql') {
            $record = $Crud->SingleeRecord($table, array('UID' => $uid));

            if ($table == '') {
                $column = 'Image';
            }
            if ($table == 'profiles') {
                $column = 'Profile';
            }

            $image = base64_decode($record[$column]);
            echo $image;
        }
        exit;
    } public function promotion_material_file_download()
    {
        $code = getSegment(3);
        $code = explode("_", base64_decode($code));
        $table = $code[0];
        $id = $code[1];
        $extension = $code[2];

        if ($extension == 'pdf' || $extension == 'PDF') {
            header('Content-Type: pdf');
        } else if ($extension == 'jpeg' || $extension == 'jpg' || $extension == 'png' || $extension == 'PNG' || $extension == 'JPG' || $extension == 'JPEG') {
            header('Content-Type: image');
        } else if ($extension == 'doc' || $extension == 'docx' || $extension == 'DOC' || $extension == 'DOCX') {
            header('Content-Type: application/msword');
        } else if ($extension == 'xls' || $extension == 'xlsx') {
            header('Content-Type: application/vnd.ms-excel');
        }
        header('Content-Disposition: attachment; filename="temp.' . $extension . '"');

        switch ($table) {

            case 'product-material';
                $dbtable = 'sponsors_products_promotional_material';
                $column = 'File';
                $defaultimg = 'no-sponsors.jpg';

                $data = $this->Modules->get_image_data($dbtable, $id);
                if ($data[$column] == '') {
                    $fileURL = ROOT . "/upload/discount/" . $defaultimg;
                    echo file_get_contents($fileURL);
                } else {
                    echo base64_decode($data[$column]);
                }
                break;
            case'task-attachments';
                $dbtable = 'taskattachments';
                $column = 'File';
                $defaultimg = 'no-image.png';
                $data = $this->Modules->get_image_data($dbtable, $id);
                if ($data[$column] == '') {
                    $fileURL = ROOT . "/upload/" . $defaultimg;
                    echo file_get_contents($fileURL);
                } else {
                    echo base64_decode($data[$column]);
                }
                break;
        }
        ;
    }public function load_image_meta()
    {
        $Code = getSegment(2);
        $Code = base64_decode($Code);
        list($driver, $table, $uid) = explode('|', $Code);
        $Crud = new Crud();
        $BuilderModel = new BuilderModel();
        header('Content-Type: image');


        $record= $BuilderModel->get_website_profile_meta_data_by_id_option($uid,'initatived_logo');
//        print_r($record);exit;
        if ($driver == 'pgsql') {
            if ($table == '') {
                $column = '';
            }
            if ($table == 'profile_metas') {
                $column = 'Value';

            }
            $image = base64_decode($record[$column]);
            echo $image;
        }


        exit;

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

    public function use_login_submit()
    {
        //{           echo 'ffff' ;exit();
        $inputEmail = $this->request->getVar('UserName');
        $password = $this->request->getVar('Password');

        $Crud = new Crud();
        $Main = new Main();

        $password = $Main->CRYPT($password, 'hide');

        $Crud = new Crud();
        $session = session();
        $response = array();
        $table = 'system_users';
        $where = array("Email" => $inputEmail, "Password" => $password);
        $Record = $Crud->SingleRecord($table, $where);
        //    print_r($Record);exit();

        if (isset($Record['UID'])) {
            $SessionArray = [
                'UID' => $Record['UID'],
                'Email' => $Record['Email'],
                'FullName' => $Record['FullName'],
                'AccessLevel' => $Record['AccessLevel'],
                //                'status' => $Record['Status'],
                'logged_in' => TRUE
            ];

            $session->set($SessionArray);
            $response['status'] = "success";
            $response['message'] = "You are successfully logged";
        } else {
            $response['status'] = "fail";
            $response['message'] = "Invalid Login Credentials, Please Try again...";
        }

        echo json_encode($response);
    }
}
