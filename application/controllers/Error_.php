<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_ extends CI_Controller {

    public function index()
    {
    	$data['judul'] = '403';

        $this->load->view('error', $data);
    }

}

/* End of file Error.php */
