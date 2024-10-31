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
        $session = session();
        $data = $this->data;
        $data['path'] = PATH;
        $data['template'] = TEMPLATE;
        $page = getSegment(1);
        $data['segment_a'] = getSegment(1);
        $data['segment_b'] = getSegment(2);
        $data['segment_c'] = getSegment(3);
        $data['session'] = $session->get();
        $data['sessionxxxx'] = $_SESSION;
        //    $data['page'] = ($page == '') ? 'home' : $page;
        CheckLogin($data);
        return $data;
    }
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

                        //Image Resizing
                        $config1 = array();
                        $config1['source_image'] = $upload_path . $filename;
                        $config1['new_image'] = $upload_path . $filename_new;
                        $config1['maintain_ratio'] = TRUE;
                        $config1['width'] = $NewWidth;
                        $config1['quality'] = 90;
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config1);
                        if (!$this->image_lib->resize()) {
                            $post_data['resize_error_msg'] = $this->image_lib->display_errors();
                        } else {
                            $post_data['resize_image'] = $filename_new;
                            $post_data['error'] = false;
                            $post_data['image'] = $filename;

                            $fcontent = file_get_contents($config1['new_image']);
                            $fcontent = base64_encode($fcontent);
                            @unlink($config1['source_image']);
                            @unlink($config1['new_image']);

                            $file_content[$i] = $fcontent;
                        }
                    }
                }
            }
            else {
                $newFileName = explode(".", $_FILES[$NAME]['name']);

                $EXT = end($newFileName);

                $filename = time() . "-" . rand(00, 99) . "." . $EXT;
                $filename_new = time() . "-" . rand(00, 99) . "_new." . $EXT;
                $config['file_name'] = $filename;
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = '*';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload($NAME)) {
                    $upload_data = $this->upload->data();

                    //if ( $upload_data[ 'image_width' ] > $NewWidth ) {
                    //Image Resizing
                    $config1['image_library'] = 'gd2'; // You can use 'imagemagick' or 'gd2'
                    $config1['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                    $config1['new_image'] = $upload_path . $filename_new;
                    $config1['maintain_ratio'] = TRUE;
                    $config1['width'] = $NewWidth;
                    $config1['quality'] = 90;

                    $this->image_lib->initialize($config1);
                    if (!$this->image_lib->resize()) {
                        $post_data['resize_error_msg'] = $this->image_lib->display_errors();
                    }

                    $post_data['resize_image'] = $filename_new;
                    $post_data['error'] = false;
                    $post_data['image'] = $filename;

                    $this->image_lib->clear();

                }
                else {
                    $post_data['error'] = true;
                    $post_data['errormsg'] = $this->upload->display_errors();
                }


                if ($post_data['error'] == true) {
                    $file_content = '';
                }
                else {

                    if (isset($post_data['resize_image'])) {
                        $final_file = $post_data['resize_image'];
                    } else {
                        $final_file = $post_data['image'];
                    }

//					echo $upload_path . $final_file;
                    $file_content = @file_get_contents($upload_path . $final_file);
//					$file_content = @file_get_contents("D:/wamp64/www/clinta-doctprofile/temp/1720433124-27.webp");
                    if($file_content!=''){
                        $file_content = base64_encode($file_content);
                        @unlink($upload_path . $post_data['resize_image']);
                        @unlink($upload_path . $post_data['image']);
                    }

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
}
