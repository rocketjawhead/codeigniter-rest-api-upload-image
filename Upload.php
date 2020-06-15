<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Upload extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('M_upload','up');
    }
    

    function uploadimage_post() 
    {

        $imageurl = $this->post('imageurl');
        //proses upload image
        $path="assets/document/";
        $roomPhotoList = $this->post('imageurl');
        $random_digit=md5(date('Y_m_d_h_i_s'));
        $filename=$random_digit.'.jpg';
        $decoded=base64_decode($roomPhotoList);
        file_put_contents($path.$filename,$decoded);
        //end

        //proses insert to database
        $postdata = $this->up->profil_pic($filename);
        //end

        if($postdata['ResponCode'] == '00')
        {
            $this->response($postdata, 200);
        }else{
            $this->response($postdata);
        }
    }
    
}
?>
