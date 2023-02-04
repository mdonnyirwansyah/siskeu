<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Saldo extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();
        admin_logged_in();
        $this->load->model('Saldo_m');
        $this->load->model('Penerimaan_m');
        $this->load->model('Pengeluaran_m');
        $this->load->model('Spbj_m');
        $this->load->model('Pimpinan_m');
    }

    public function index()
    {
        $this->vars['user']     = user();
        $this->vars['judul']    = 'Data Saldo';
        $this->vars['tahun']    = $this->Saldo_m->get_tahun();
        $this->vars['bulan']    = $this->Saldo_m->get_bulan();
	    $this->load->view('admin/data/saldo/index', $this->vars);
    }

    public function cetak()
    {      
        $tahun1 = $this->input->post('tahun1', true);
        $bulanawal = $this->input->post('bulanawal', true);
        $bulanakhir = $this->input->post('bulanakhir', true);

        if($bulanawal != 'Pilih bulan' && $bulanakhir != 'Pilih bulan' && $tahun1 != 'Pilih tahun' && $bulanawal <= $bulanakhir){
            if ($tahun1 == 0 && $bulanawal == 0 && $bulanakhir == 0) {
            $tahun1 = date('Y');
            $bulanawal = date('m');
            $bulanakhir = date('m');
            } 
            $data['judul']    = 'Laporan Saldo';
            $data['Saldo'] = $this->Saldo_m->get($tahun1, $bulanawal, $bulanakhir);
            $data['sumDebit'] = $this->Penerimaan_m->get_sum($tahun1, $bulanawal, $bulanakhir);
            $data['sumKredit'] = $this->Pengeluaran_m->get_sum($tahun1, $bulanawal, $bulanakhir);
            $data['bulanawal'] = $bulanawal;
            $data['bulanakhir'] = $bulanakhir; 
            $data['tahun'] = $tahun1;
            $filename = 'Laporan-Saldo-Bulan-'.$bulanawal.'-Tahun-'.$tahun1;
            $html1 = $this->load->view('admin/cetak/saldo/index', $data, true);
            generatePdf($html1, $filename);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                      <div class="alert-body">
                                        <div class="alert-title">Peringatan!</div><button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        Gagal mencetak periksa kembali inputan filter.
                                      </div>
                                    </div>');
            redirect('admin/data/saldo');
        }

        
    }

    function get_sum()
    {
        if ($this->input->is_ajax_request() == true) {
            $tahun1 = $this->input->post('tahun1', true);
            $bulanawal = $this->input->post('bulanawal', true);
            $bulanakhir = $this->input->post('bulanakhir', true);

            if ($tahun1 == null && $bulanawal == null && $bulanakhir == null) {
                $tahun1 = date('Y');
                $bulanawal = date('m');
                $bulanakhir = date('m');
            } 
            $dataDebit = $this->Penerimaan_m->get_sum($tahun1, $bulanawal, $bulanakhir);
            $dataKredit = $this->Pengeluaran_m->get_sum($tahun1, $bulanawal, $bulanakhir);
            $dataSpbj = $this->Spbj_m->get_sum($tahun1, $bulanawal, $bulanakhir);
            $dataPimpinan = $this->Pimpinan_m->get_sum($tahun1, $bulanawal, $bulanakhir);
            $Debit = $dataDebit->sum;
            $Kredit = $dataKredit->sum;
            $Spbj = $dataSpbj->sum;
            $Pimpinan = $dataPimpinan->sum;
            $Saldo = $Debit - $Kredit;
            $sumDebit = number_format($Debit,0,',','.');            
            $sumKredit = number_format($Kredit,0,',','.');
            $sumSaldo = number_format($Saldo,0,',','.'); 
            $sumSpbj = number_format($Spbj,0,',','.'); 
            $sumPimpinan = number_format($Pimpinan,0,',','.'); 
            
            $sum = array('debit'=>$sumDebit, 'kredit'=>$sumKredit, 'saldo'=>$sumSaldo, 'spbj'=>$sumSpbj, 'pimpinan'=>$sumPimpinan);
            echo json_encode($sum);
        } else {
        redirect('error_');
        }
    }

    function get_tabel()
    {
        if ($this->input->is_ajax_request() == true) {
            $tahun1 = $this->input->post('tahun1', true);
            $bulanawal = $this->input->post('bulanawal', true);
            $bulanakhir = $this->input->post('bulanakhir', true);

            if ($tahun1 == null && $bulanawal == null && $bulanakhir == null) {
                $tahun1 = date('Y');
                $bulanawal = date('m');
                $bulanakhir = date('m');
            } else {
                $tahun1 = $this->input->post('tahun1', true);
                $bulanawal = $this->input->post('bulanawal', true);
                $bulanakhir = $this->input->post('bulanakhir', true);
            }

            $list = $this->Saldo_m->get_datatables($tahun1, $bulanawal, $bulanakhir);
            $data = array();
            $no = $_POST['start'];
            $saldo = 0;
            foreach ($list as $field) {
                $no++;
                $row = array();
                
                if ($field->jenis == 'd') {
                    $debit = $field->satuan * $field->volume;
                    $kredit = 0;
                }elseif ($field->jenis == 'k') {
                    $debit = 0;
                    $kredit = $field->satuan * $field->volume;
                }

                $saldo_akhir = 0 + $debit - $kredit;
                $saldo = $saldo + $saldo_akhir;
                

                $row[] = $no;
                $row[] = $field->tanggal;
                $row[] = $field->uraian;
                $row[] = $debit;
                $row[] = $kredit;
                $row[] = $saldo;
                $row[] = $field->keterangan;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Saldo_m->count_all(),
                "recordsFiltered" => $this->Saldo_m->count_filtered($tahun1, $bulanawal, $bulanakhir),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            redirect('error_');
        }
    }
}

/* End of file Saldo.php */
