<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Pimpinan extends Pimpinan_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Pimpinan_m');
        pimpinan_logged_in();
    }

    public function index()
    {
        $this->vars['user']     = user();
        $this->vars['judul']    = 'Laporan Pengeluaran Pimpinan';
        $this->vars['tahun']    = $this->Pimpinan_m->get_tahun();
        $this->vars['bulan']    = $this->Pimpinan_m->get_bulan();
	    $this->load->view('pimpinan/laporan/pimpinan/index', $this->vars);
    }

    public function form_view()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            $ambil_data = $this->Pimpinan_m->get_data_by_id($id);
            if ($ambil_data->num_rows() > 0) {
                $row = $ambil_data->row_array();
                $data = [
                    'id' => $id,
                    'tanggal' => $row['tanggal'],
                    'uraian' => $row['uraian'],
                    'penerima' => $row['penerima'],
                    'kebutuhan' => $row['kebutuhan'],
                    'satuan' => $row['satuan'],
                    'volume' => $row['volume'],
                    'keterangan' => $row['keterangan'],
                    'bukti_transaksi' => $row['bukti_transaksi'],
                ];
            }
            $msg = [
                    'sukses' => $this->load->view('pimpinan/modal/view-pimpinan', $data, true)
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
            $data = $this->Pimpinan_m->get_sum($tahun1, $bulanawal, $bulanakhir);
            $sum = number_format($data->sum,0,',','.');
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

            $list = $this->Pimpinan_m->get_datatables($tahun1, $bulanawal, $bulanakhir);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
                
                $no++;
                $row = array();

                $view = "<button type=\"button\" class=\"btn btn-sm btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Lihat\" onclick=\"view('" . $field->kode . "')\"><i class=\"fas fa-eye\"></i></button>";
                $jumlah = $field->satuan * $field->volume;
                

                $row[] = $no;
                $row[] = $field->tanggal;
                $row[] = $field->uraian;
                $row[] = $field->penerima;
                $row[] = $jumlah;
                $row[] = $field->keterangan;
                $row[] = $view;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Pimpinan_m->count_all(),
                "recordsFiltered" => $this->Pimpinan_m->count_filtered($tahun1, $bulanawal, $bulanakhir),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            redirect('error_');
        }
    }
}

/* End of file Pimpinan.php */
