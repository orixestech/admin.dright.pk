<?php

namespace App\Models;
use CodeIgniter\Files\File;
use CodeIgniter\Images\Image;
use Config\Services;

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

        if ($data['segment_a'] != 'use-login-submit' && $data['segment_a'] != 'login') {
            if (!isset($data['session']['logged_in'])) {
                $session->destroy();
                header("Location: " . $data['path'] . "login");
                exit;
            }
        }
        $rolls_permissions = $this->GetRollsPermissions();
        $data['rolls_permissions'] = $rolls_permissions;
        return $data;
    }
    public function GetRollsPermissions()
    {
        $Crud = new Crud();
        $settings = $Crud->ListRecords('admin_access', [], ['Module' => 'ASC', 'AccessKey' => 'ASC']);

        $final = [];
        foreach ($settings as $setting) {
            $TEMP = [];
            $TEMP['uid'] = $setting['UID'];
            $TEMP['key'] = $setting['AccessKey'];
            $TEMP['title'] = $setting['Description'];

            $final[$setting['Module']][] = $TEMP;
        }
        return $final;
    }
    public
    function GenAccessKey( $ExpireString = null ) {
        $key = array();

        $strpart = array();
        $str = md5( "Clinta-" . rand( 111111, 9999999 ) );
        //$strpart[] = substr( $str, rand( 5, 25 ), 5 );
        $strpart[] = rand( 100, 999 );

        $str = md5( "Clinta-" . rand( 111111, 9999999 ) );
        //$strpart[] = substr( $str, rand( 5, 25 ), 5 );
        $strpart[] = rand( 100, 999 );

        $str = md5( "Clinta-" . rand( 111111, 9999999 ) );
        //$strpart[] = substr( $str, rand( 5, 25 ), 5 );
        $strpart[] = rand( 100, 999 );

        $str = md5( "Clinta-" . rand( 111111, 9999999 ) );
        //$strpart[] = substr( $str, rand( 5, 25 ), 5 );
        $strpart[] = rand( 100, 999 );

        $str = md5( "Clinta-" . rand( 111111, 9999999 ) );
        //$strpart[] = substr( $str, rand( 5, 25 ), 5 );
        $strpart[] = rand( 100, 999 );

        $key[ "key" ] = strtoupper( implode( "-", $strpart ) );
        $key[ "created" ] = date( "Y-m-d" );
        $key[ "expire" ] = ( ( is_null( $ExpireString ) ) ? date( "Y-m-d", strtotime( "+4 Months" ) ) : date( "Y-m-d", strtotime( $ExpireString ) ) );

        return $key;
    }

    public function image_uploader($file, $newWidth = 1024, $newHeight = 800)
    {
        $fileName = str_replace(' ', '_', $file->getName());

        // Define the upload path
        $uploadPath = WRITEPATH . 'uploads/temp/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Move the file to the upload path
        $file->move($uploadPath, $fileName);

        $sourcePath = $uploadPath . $fileName;
        if (!file_exists($sourcePath)) {
            throw new \RuntimeException("File path is invalid or file does not exist: {$sourcePath}");
        }

        // Resize the image
        $resizedPath = $uploadPath . 'resized_' . $fileName;
        $this->resize_image($sourcePath, $resizedPath, $newWidth, $newHeight);

        // Encode the resized image to Base64
        return $this->encode_image_to_base64($resizedPath);
    }

    public function resize_image($sourcePath, $resizedPath, $newWidth, $newHeight)
    {
        $image = \Config\Services::image()
            ->withFile($sourcePath)
            ->resize($newWidth, $newHeight, true, 'auto')
            ->save($resizedPath);
    }
    public function encode_image_to_base64($filePath)
    {
        $imageData = file_get_contents($filePath);
        return base64_encode($imageData);
    }
//    function GetCEConfigItem($item)
//    {
//        $config = array();
//        $path = config_item('clinta_extended_core_config');
//        include($path);
//        $path = config_item('clinta_extended_config');
//        include($path);
//
//        //print_r($config);
//
//        return $config[$item];
//    }

//<-- Ci3 Image uploader function

//    public
//    function image_uploader($NAME, $NewWidth = 1024, $NewHeight = 800){
//
//        $NAME = str_replace(' ', '_', $NAME);
//
//        $this->load->library('upload');
//        $IMG = $_FILES[$NAME];
//        $post_data = array();
//        $upload_path = ROOT . "/temp/";
//        $file_content = '';
//
//        $config['upload_path'] = $upload_path;
//        $config['allowed_types'] = '*';
//        $config['max_size'] = '3072'; // 2MB limit
//
//        $this->upload->initialize($config);
//
//        // Perform the upload
//        if (!$this->upload->do_upload($NAME)) {
//            $error = $this->upload->display_errors();
//            echo $error;
//            return;
//        }
//
//        $upload_data = $this->upload->data();
//        $source_path = realpath($upload_data['full_path']);
//
//        // Check if the source path is valid
//        if ($source_path === false || !file_exists($source_path)) {
//            die('File path is invalid or file does not exist: ' . $upload_data['full_path']);
//        }
//
//        // Resize the image
//        $path = $source_path;
//        $resized_path = $upload_path.'resized_' . $upload_data['file_name'];
//        $this->resize_image($source_path, $resized_path, $NewWidth, $NewHeight); // Resize to 800x600
//
//        // Encode the resized image to Base64
//        $file_content = $this->encode_image_to_base64($resized_path);
//
//        return $file_content;
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
    function GetExtendedLastInvoiceDateTime($DBName)
    {
        $ExtendedDb = $this->Postgre->LoadPGDB($DBName);

        $ExtendedDb->trans_start();
        $ExtendedDb->select('max ("InvoiceDateTime") as "MAXInvoice"');
        $ExtendedDb->from('patients."invoice"');
        $query = $ExtendedDb->get();
        $data = $query->row_array();
        $ExtendedDb->trans_complete();

        return $data['MAXInvoice'];
    }

    public
    function GetExtendedLastPharmacyInvoiceDateTime($DBName)
    {
        $ExtendedDb = $this->Postgre->LoadPGDB($DBName);

        $ExtendedDb->trans_start();
        $ExtendedDb->select('max ("CreatedAt") as "MAXInvoice"');
        $ExtendedDb->from('pharmacy."invoices"');
        $query = $ExtendedDb->get();
        $data = $query->row_array();
        $ExtendedDb->trans_complete();

        return $data['MAXInvoice'];
    }

    public
    function send($mobile, $message)
    {
        //        $URL = config_item('base_url');
        $URL = PATH;

        if (strlen($mobile) != 12) {
            if (strlen($mobile) == 11)
                $mobile = 92 . substr($mobile, 1, 10);
        }

        $username = "HOLISTIC";
        $password = "123789";
        $sender = "625";

        $post = "type=text&sender=" . urlencode($sender) . "&mobile=" . urlencode($mobile) . "&message=" . urlencode($message) . "";
        $url = "http://bulksms.dtechnologies.com.pk/web_distributor/api/sms.php?username=" . $username . "&password=" . $password;
        $ch = curl_init();
        $timeout = 0;
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        return $result['success'];
    }
    public
    function upload_image($NAME, $NewWidth = 1024)
    {

        $this->load->library('image_lib');
        $IMG = $_FILES[$NAME];
        $post_data = array();
        $upload_path = ROOT . "/temp/";
        $file_content = '';
print_r($_FILES[$NAME]['name']);exit();
        if (isset($_FILES[$NAME]['name'])) {
            if (is_array($_FILES[$NAME]['name'])) {
                $IMGs = $_FILES[$NAME]['name'];
                $file_content = $post_data = array();
                //echo '<pre>';
                for ($i = 0; $i < count($IMGs); $i++) {
                    $newFileName = explode(".", $_FILES[$NAME]['name'][$i]);
                    $EXT = end($newFileName);
                    $filename = time() . "-" . rand(00, 99) . "." . $EXT;
                    $filename_new = time() . "-" . rand(00, 99) . "_new." . $EXT;

                    if (move_uploaded_file($_FILES[$NAME]['tmp_name'][$i], $upload_path . $filename)) {

                        $fcontent = file_get_contents($upload_path . $filename);
                        $fcontent = base64_encode($fcontent);
                        @unlink($upload_path . $filename);
                        $file_content[$i] = $fcontent;
                    }
                }
            } else {
                $newFileName = explode(".", $_FILES[$NAME]['name']);
                $EXT = end($newFileName);
                $filename = time() . "-" . rand(00, 99) . "." . $EXT;
                             if (move_uploaded_file($_FILES[$NAME]['tmp_name'], $upload_path . $filename)) {

                    $fcontent = file_get_contents($upload_path . $filename);
                    $fcontent = base64_encode($fcontent);
                    @unlink($upload_path . $filename);
                    $file_content = $fcontent;
                }
            }
        }

        return $file_content;
    }

    function SeoUrl($url)
    {
        $url = preg_replace('/[^a-zA-Z0-9_\/]/', '-', trim($url));
        $url = strtolower($url);
        $url = str_replace("--", "-", $url);
        $url = str_replace("--", "-", $url);
        $url = str_replace("--", "-", $url);
        return base_url($url);
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

    function RandFileName()
    {
        $key = substr(md5(rand(100, 9999999) . "|" . date("U")), 10, 10);
        return $key;
    }
    public function adminlog($logID,$message,$ipAddress){


        $Crud = new Crud();
        $record=array();
        $record['LogSegment']=$logID;
        $record['LogNotes']=$message;
        $record['LogIP']=$ipAddress;
        $RecordId = $Crud->AddRecordClinta('public."AdminLog"', $record);
//       print_r($RecordId);exit();


        if (isset($RecordId) && $RecordId > 0) {
            $response['status'] = 'success';
            $response['message'] = 'Added Successfully...!';
        } else {
            $response['status'] = 'fail';
            $response['message'] = 'Data Didnt Submitted Successfully...!';
        }


    }
}
