<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Akun extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		admin_logged_in();
        $this->load->model('Akun_m');
	}

    public function index()
    {
    	$this->vars['user']    = user();
    	$this->vars['judul']   = 'Pengaturan Akun';
        $this->load->view('admin/pengaturan/akun/index', $this->vars);
    }

    public function profil()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            $profil = $this->Akun_m->get_data_by_id($id);

            echo json_encode($profil);
        } else {
            redirect('error_');
        }
    }

    public function edit()
    {
        if ($this->input->is_ajax_request() == true) {

            $this->form_validation->set_rules('name', 'name', 'required');
            if ($this->form_validation->run() == true) {
                // cek jika ada file yg diupload
                $id = $_POST['id'];
                $ambil_data = $this->Akun_m->get_data_by_id($id);
                $upload_profil = $_FILES['image']['name'];

                if( $upload_profil ) {
                    $config['allowed_types'] = 'jpeg|jpg|png';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './assets/uploads/profil';

                    $this->load->library('upload', $config);

                    if( $this->upload->do_upload('image') ) {
                        $old_profil = $ambil_data->image;
                        if($old_profil != 'default.png') {
                            unlink(FCPATH . 'assets/uploads/profil/' . $old_profil);
                        }
                        $new_profil = $this->upload->data('file_name');
                        $this->_edit($new_profil);
                        $msg = [
                                'sukses' => 'Data Profil berhasil diedit.'
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
                    $new_profil = $ambil_data->image;
                    $this->_edit($new_profil);
                    $msg = [
                            'sukses' => 'Data Profil berhasil diedit.'
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

    private function _edit($new_profil)
    {
        $id = $this->input->post('id', true);
        $name = $this->input->post('name', true);


        $data        = [
                        'name' => ucwords($name),
                        'image' => $new_profil,
                        ];
        $this->Akun_m->edit($data, $id);
    }

    public function ganti_password()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->vars['user'] = user();

            $this->form_validation->set_rules('current_password', 'password saat ini', 'required|min_length[8]|max_length[16]');
            $this->form_validation->set_rules('new_password1', 'password baru', 'required|min_length[8]|max_length[16]');
            $this->form_validation->set_rules('new_password2', 'ketik ulang password', 'required|matches[new_password1]');
            if ($this->form_validation->run() == true) {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');
                if( !password_verify($current_password, $this->vars['user']['password']) ) {
                    $msg = [
                        'error' => 'Password yang anda masukkan salah!'
                    ];
                } else {
                    if( $current_password == $new_password) {
                        $msg = [
                        'error' => 'Password baru tidak boleh sama dengan password lama!'
                         ];
                    } else {
                        // password sudah ok
                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        $this->db->set('password', $password_hash);
                        $this->db->where('email', $this->session->userdata('email'));
                        $this->db->update('tb_user');
                        $msg = [
                                'sukses' => 'Password berhasil diganti.'
                        ];
                    }
                }
            } else {
                $msg = [
                        'validasi' => '<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
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

}

/* End of file Akun.php */
