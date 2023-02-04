<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Dashboard extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		admin_logged_in();
		$this->load->model('Penerimaan_m');
		$this->load->model('Pengeluaran_m');
		$this->load->model('Saldo_m');
		$this->load->model('Spbj_m');
		$this->load->model('Pimpinan_m');
	}

    public function index()
    {
        $this->vars['user']              = user();
    	$this->vars['judul']             = 'Dashboard';
    	$this->vars['debitCount']        = $this->Penerimaan_m->get_count();
    	$this->vars['kreditCount']       = $this->Pengeluaran_m->get_count();
    	$this->vars['spbjCount']         = $this->Spbj_m->get_count();
    	$this->vars['pimpinanCount']     = $this->Pimpinan_m->get_count();
    	$this->vars['debitSumByBulan']   = $this->Penerimaan_m->get_sumByBulan();
    	$this->vars['kreditSumByBulan']  = $this->Pengeluaran_m->get_sumByBulan();
    	$this->vars['bulan']             = $this->Saldo_m->get_bulan();
    	$this->vars['tahun']             = $this->Saldo_m->get_tahun();
    	$this->vars['pie']               = $this->Pengeluaran_m->get_pie();
        $this->load->view('admin/dashboard/index', $this->vars);
    }

}

/* End of file Dashboard.php */
