<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Tentang extends Pimpinan_Controller {
	public function __construct() {
		parent::__construct();
		pimpinan_logged_in();
	}

    public function index()
    {
        $this->vars['user']     = user();
    	$this->vars['judul']    = 'Tentang';
        $this->load->view('pimpinan/tentang/index', $this->vars);
    }

}

/* End of file Tentang.php */
