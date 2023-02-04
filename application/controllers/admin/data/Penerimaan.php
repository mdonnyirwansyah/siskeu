<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Penerimaan extends Admin_Controller {
	public function __construct()
    {
        parent::__construct();
        admin_logged_in();
        $this->load->model('Penerimaan_m');
    }

    public function index()
    {
        $this->vars['user']     = user();
        $this->vars['judul']    = 'Data Penerimaan';
        $this->vars['tahun']    = $this->Penerimaan_m->get_tahun();
        $this->vars['bulan']    = $this->Penerimaan_m->get_bulan();
        $this->load->view('admin/data/penerimaan/index', $this->vars);
    }

    public function cetak()
    {   if ($this->input->post() == true) {   
            $tahun1 = $this->input->post('tahun1', true);
            $bulanawal = $this->input->post('bulanawal', true);
            $bulanakhir = $this->input->post('bulanakhir', true);

            if($bulanawal != 'Pilih bulan' && $bulanakhir != 'Pilih bulan' && $tahun1 != 'Pilih tahun' && $bulanawal <= $bulanakhir){
                if ($tahun1 == 0 && $bulanawal == 0 && $bulanakhir == 0) {
                $tahun1 = date('Y');
                $bulanawal = date('m');
                $bulanakhir = date('m');
                } 
                $data['judul']    = 'Laporan Penerimaan';
                $data['penerimaan'] = $this->Penerimaan_m->get($tahun1, $bulanawal, $bulanakhir);
                $data['total'] = $this->Penerimaan_m->get_sum($tahun1, $bulanawal, $bulanakhir);
                $data['bulanawal'] = $bulanawal;
                $data['bulanakhir'] = $bulanakhir; 
                $data['tahun'] = $tahun1;
                $filename = 'Laporan-Penerimaan-Bulan-'.date('F').'-Tahun-'.date('Y');
                $html1 = $this->load->view('admin/cetak/penerimaan/index', $data, true);
                generatePdf($html1, $filename);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                                          <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                          <div class="alert-body">
                                            <div class="alert-title">Peringatan!</div><button class="close" data-dismiss="alert"><span>&times;</span></button>
                                            Gagal mencetak periksa kembali inputan filter.
                                          </div>
                                        </div>');
                redirect('admin/data/penerimaan');
            }
        } else {
            redirect('error_');
        }
        
    }

    public function form_impor()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            if ($id > 0) {
                $data = [
                    'id' => $id,
                ];
            }
            $msg = [
                    'sukses' => $this->load->view('admin/modal/impor-penerimaan', $data, true)
            ];
            echo json_encode($msg);
        } else{
            redirect('error_');
        }
    }

    public function form_view()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            $ambil_data = $this->Penerimaan_m->get_data_by_id($id);
            if ($ambil_data->num_rows() > 0) {
                $row = $ambil_data->row_array();
                $data = [
                    'id' => $id,
                    'tanggal' => $row['tanggal'],
                    'uraian' => $row['uraian'],
                    'satuan' => $row['satuan'],
                    'volume' => $row['volume'],
                    'keterangan' => $row['keterangan'],
                    'bukti_transaksi' => $row['bukti_transaksi'],
                ];
            }
            $msg = [
                    'sukses' => $this->load->view('admin/modal/view-penerimaan', $data, true)
            ];
            echo json_encode($msg);
        } else{
            redirect('error_');
        }
    }

    public function tambah()
    {
        if ($this->input->is_ajax_request() == true) {
            
            $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
            $this->form_validation->set_rules('uraian', 'uraian', 'required');
            $this->form_validation->set_rules('satuan', 'satuan', 'required|max_length[10]|is_natural_no_zero|numeric|is_numeric');
            $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
            if ($this->form_validation->run() == true) {
                $this->_tambah();
                $msg = [
                        'sukses' => 'Data Penerimaan berhasil ditambah.'
                ];
            } else {
                $msg = [
                        'error' => '<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                      <div class="alert-body">
                                        <div class="alert-title">Peringatan!</div><button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        '. validation_errors() .'
                                      </div>
                                    </div>' 
                ];
            }
            echo json_encode($msg);
        } else{
            redirect('error_');
        }
    }

    private function _tambah()
    {
        $tanggal = $this->input->post('tanggal', true);
        $uraian = $this->input->post('uraian', true);
        $satuan = $this->input->post('satuan', true);
        $keterangan = $this->input->post('keterangan', true);

        $data        = [
                        'tanggal' => $tanggal,
                        'jenis' => 'd',
                        'uraian' => ucwords($uraian),
                        'penerima' => '-',
                        'kebutuhan' => '-',
                        'satuan' => $satuan,
                        'volume' => 1,
                        'keterangan' => ucwords($keterangan),
                        'bukti_transaksi' => 'struk.png'
                        ];
        $this->Penerimaan_m->tambah($data);
        
    }

    public function form_edit()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            $ambil_data = $this->Penerimaan_m->get_data_by_id($id);
            if ($ambil_data->num_rows() > 0) {
                $row = $ambil_data->row_array();
                $data = [
                    'id' => $id,
                    'tanggal' => $row['tanggal'],
                    'uraian' => $row['uraian'],
                    'satuan' => $row['satuan'],
                    'keterangan' => $row['keterangan'],
                    'bukti_transaksi' => $row['bukti_transaksi'],
                ];
            }
            $msg = [
                    'sukses' => $this->load->view('admin/modal/edit-penerimaan', $data, true)
            ];
            echo json_encode($msg);
        } else{
            redirect('error_');
        }
    }

    public function edit()
    {
        if ($this->input->is_ajax_request() == true) {

            $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
            $this->form_validation->set_rules('uraian', 'uraian', 'required');
            $this->form_validation->set_rules('satuan', 'satuan', 'required|max_length[10]|is_natural_no_zero|numeric|is_numeric');
            $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
            if ($this->form_validation->run() == true) {
                // cek jika ada file yg diupload
                $id = $_POST['id'];
                $ambil_data = $this->Penerimaan_m->get_data_by_id($id)->row();
                $upload_invoice = $_FILES['invoice']['name'];

                if( $upload_invoice ) {
                    $config['allowed_types'] = 'jpeg|jpg|png';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './assets/uploads/invoice';

                    $this->load->library('upload', $config);

                    if( $this->upload->do_upload('invoice') ) {
                        $old_invoice = $ambil_data->bukti_transaksi;
                        if($old_invoice != 'struk.png') {
                            unlink(FCPATH . 'assets/uploads/invoice/' . $old_invoice);
                        }
                        $new_invoice = $this->upload->data('file_name');
                        $this->_edit($new_invoice);
                        $msg = [
                                'sukses' => 'Data Penerimaan berhasil diedit.'
                        ];
                    } else {
                        $msg = [
                                    'error' => '<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                                                  <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                                  <div class="alert-body">
                                                    <div class="alert-title">Peringatan!</div><button class="close" data-dismiss="alert"><span>&times;</span></button>
                                                    '.$this->upload->display_errors().'
                                                  </div>
                                                </div>'
                            ];
                    }
                } else {
                    $new_invoice = $ambil_data->bukti_transaksi;
                    $this->_edit($new_invoice);
                    $msg = [
                            'sukses' => 'Data Penerimaan berhasil diedit.'
                    ];
                } 
            } else {
                $msg = [
                        'error' => '<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                      <div class="alert-body">
                                        <div class="alert-title">Peringatan!</div><button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        '. validation_errors() .'
                                      </div>
                                    </div>'
                ];
            }
                echo json_encode($msg);
        } else {
            redirect('error_');
        }
    }

    private function _edit($new_invoice)
    {
        $id = $this->input->post('id', true);
        $tanggal = $this->input->post('tanggal', true);
        $uraian = $this->input->post('uraian', true);
        $satuan = $this->input->post('satuan', true);
        $keterangan = $this->input->post('keterangan', true);


        $data        = [
                        'tanggal' => $tanggal,
                        'uraian' => ucwords($uraian),
                        'satuan' => $satuan,
                        'keterangan' => ucwords($keterangan),
                        'bukti_transaksi' => $new_invoice,
                        ];
        $this->Penerimaan_m->edit($data, $id);
    }

    public function impor()
    {
        if ($this->input->is_ajax_request() == true) {
            // cek jika ada file yg diupload
            $upload_csv = $_FILES['csv']['name'];

            if( $upload_csv ) {
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/uploads/csv';

                $this->load->library('upload', $config);

                if( $this->upload->do_upload('csv') ) {

                    $file_csv = $this->upload->data('file_name');
                    $file = FCPATH.'assets/uploads/csv/'.$file_csv;
                    $csv = array_map('str_getcsv', file($file));
                    unset($csv[0]);
                    foreach ($csv as $row) {
                        $data = [
                                'tanggal' => $row[0],
                                'jenis' => 'd',
                                'uraian' => ucwords($row[1]),
                                'penerima' => '-',
                                'kebutuhan' => '-',
                                'satuan' => $row[2],
                                'volume' => 1,
                                'keterangan' => ucwords($row[3]),
                                'bukti_transaksi' => 'struk.png'
                        ];
                        $this->Penerimaan_m->tambah($data);
                        
                        $msg = [
                                'sukses' => 'Data Penerimaan berhasil di impor.'
                        ];
                    }

                    unlink($file);
                } else {
                    $msg = [
                                'error' => '<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                                              <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                              <div class="alert-body">
                                                <div class="alert-title">Peringatan!</div><button class="close" data-dismiss="alert"><span>&times;</span></button>
                                                '.$this->upload->display_errors().'
                                              </div>
                                            </div>'
                        ];
                }
            } else {
                $msg = [
                        'error' => '<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                      <div class="alert-body">
                                        <div class="alert-title">Peringatan!</div><button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        Bidang file csv dibutuhkan.
                                      </div>
                                    </div>'
                ];
            }
                
            echo json_encode($msg);
        } else{
            redirect('error_');
        }
    }

    public function hapus() {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            $ambil_data = $this->Penerimaan_m->get_data_by_id($id)->row();
            $invoice = $ambil_data->bukti_transaksi;
            $this->db->where('kode',$id);
            $this->Penerimaan_m->hapus($id); 
            if($invoice != 'struk.png') {
                unlink(FCPATH . 'assets/uploads/invoice/' . $invoice);
            }
            $msg = [
                    'sukses' => 'Data Penerimaan berhasil dihapus.'
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
            $data = $this->Penerimaan_m->get_sum($tahun1, $bulanawal, $bulanakhir);
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
            } 

            $list = $this->Penerimaan_m->get_datatables($tahun1, $bulanawal, $bulanakhir);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
                
                $no++;
                $row = array();

                $tombol_edit = "<button type=\"button\" class=\"btn btn-sm btn-info ml-1 mr-1\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\" onclick=\"edit('" . $field->kode . "')\"><i class=\"fas fa-pen\"></i></button>";
                $tombol_hapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus\" onclick=\"hapus('" . $field->kode . "')\"><i class=\"fas fa-trash\"></i></button>";
                $view = "<button type=\"button\" class=\"btn btn-sm btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Lihat\" onclick=\"view('" . $field->kode . "')\"><i class=\"fas fa-eye\"></i></button>";

                $row[] = $no;
                $row[] = $field->tanggal;
                $row[] = $field->uraian;
                $row[] = $field->satuan;
                $row[] = $field->keterangan;
                $row[] = $view.''.$tombol_edit.''.$tombol_hapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Penerimaan_m->count_all(),
                "recordsFiltered" => $this->Penerimaan_m->count_filtered($tahun1, $bulanawal, $bulanakhir),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            redirect('error_');
        }
    }
}

/* End of file Penerimaan.php */
