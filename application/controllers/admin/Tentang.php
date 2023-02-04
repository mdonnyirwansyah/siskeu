<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Tentang extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		admin_logged_in();
	}

    public function index()
    {
        $this->vars['user']     = user();
    	$this->vars['judul']    = 'Tentang';
        $this->load->view('admin/tentang/index', $this->vars);
    }

}

/* End of file Tentang.php */
