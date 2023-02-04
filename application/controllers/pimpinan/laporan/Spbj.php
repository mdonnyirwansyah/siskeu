<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Spbj extends Pimpinan_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Spbj_m');
        pimpinan_logged_in();
    }

    public function index()
    {
        $this->vars['user']     = user();
        $this->vars['judul']    = 'Laporan Pembayaran SPBJ';
        $this->vars['tahun']    = $this->Spbj_m->get_tahun();
        $this->vars['bulan']    = $this->Spbj_m->get_bulan();
	    $this->load->view('pimpinan/laporan/spbj/index', $this->vars);
    }

    public function form_view()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            $ambil_data = $this->Spbj_m->get_data_by_id($id);
            if ($ambil_data->num_rows() > 0) {
                $row = $ambil_data->row_array();
                $data = [
                    'id' => $id,
                    'tanggal' => $row['tanggal'],
                    'penerima' => $row['penerima'],
                    'no_spbj' => $row['no_spbj'],
                    'area' => $row['area'],
                    'nilai_spbj' => $row['nilai_spbj'],
                    'pemasukkan' => $row['pemasukkan'],
                    'pengiriman' => $row['pengiriman'],
                    'keterangan' => $row['keterangan'],
                    'bukti_transaksi' => $row['bukti_transaksi'],
                ];
            }
            $msg = [
                    'sukses' => $this->load->view('pimpinan/modal/view-spbj', $data, true)
            ];
            echo json_encode($msg);
        } else{
            redirect('error_');
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
            $data = $this->Spbj_m->get_sum($tahun1, $bulanawal, $bulanakhir);
            $pengiriman = number_format($data->sum,0,',','.');
            $nilai = number_format($data->nilai,0,',','.');
            $fee = number_format($data->nilai * 0.10,0,',','.');
            $pemasukkan = number_format($data->pemasukkan,0,',','.');
            $sum = array('pengiriman'=>$pengiriman, 'nilai'=>$nilai, 'fee'=>$fee, 'pemasukkan'=>$pemasukkan);
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

            $list = $this->Spbj_m->get_datatables($tahun1, $bulanawal, $bulanakhir);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
                
                $no++;
                $row = array();

                $view = "<button type=\"button\" class=\"btn btn-sm btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Lihat\" onclick=\"view('" . $field->kode . "')\"><i class=\"fas fa-eye\"></i></button>";
                $fee = $field->nilai_spbj * 0.10;
                

                $row[] = $no;
                $row[] = $field->tanggal;
                $row[] = $field->no_spbj;
                $row[] = $field->nilai_spbj;
                $row[] = $fee;
                $row[] = $field->pemasukkan;
                $row[] = $field->pengiriman;
                $row[] = $view;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Spbj_m->count_all(),
                "recordsFiltered" => $this->Spbj_m->count_filtered($tahun1, $bulanawal, $bulanakhir),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            redirect('error_');
        }
    }
}

/* End of file Spbj.php */
