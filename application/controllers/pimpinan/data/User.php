<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class User extends Pimpinan_Controller {
	public function __construct()
    {
        parent::__construct();
        pimpinan_logged_in();
        $this->load->model('User_m');
    }

    public function index()
    {
        $this->vars['user']     = user();
        $this->vars['judul']    = 'Data User';
        $this->load->view('pimpinan/data/user/index', $this->vars);
    }

    public function form_view()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            $ambil_data = $this->User_m->get_data_by_id($id);
            if ($ambil_data->num_rows() > 0) {
                $row = $ambil_data->row_array();
                $data = [
                    'id' => $id,
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'role_id' => $row['role_id'],
                    'is_active' => $row['is_active'],
                    'date_created' => $row['date_created'],
                    'image' => $row['image'],
                ];
            }
            $msg = [
                    'sukses' => $this->load->view('pimpinan/modal/view-user', $data, true)
            ];
            echo json_encode($msg);
        } else{
            redirect('error_');
        }
    }

    public function tambah()
    {
        if ($this->input->is_ajax_request() == true) {
            
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('role_id', 'role_id', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[tb_user.email]');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[16]');
            $this->form_validation->set_rules('password1', 'ketik ulang password', 'required|matches[password]');
            if ($this->form_validation->run() == true) {
                $this->_tambah();
                $msg = [
                        'sukses' => 'Data User berhasil ditambah, silahkan periksa email user untuk aktivasi akun.'
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
        $name = htmlspecialchars($this->input->post('name', true));
        $role_id = $this->input->post('role_id', true);
        $email = htmlspecialchars($this->input->post('email', true));
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $data        = [
                        'name' => ucwords($name),
                        'email' => $email,
                        'image' => 'default.png',
                        'password' => $password,
                        'role_id' => $role_id,
                        'is_active' => 1,
                        'date_created' => time()
                        ];
        $token = base64_encode(random_bytes(32));
        $user_token = [
                            'email' => $email,
                            'token' => $token,
                            'date_created' => time()
        ];
        
        // $this->_sendEmail($token, 'verifikasi');
        $this->User_m->tambah($data);  
        // $this->User_m->tambah_token($user_token);
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'siskeu01@gmail.com',
            'smtp_pass' => '@sisteminformasikeuangan01',
            'smtp_port' =>  465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('siskeu01@gmail.com', 'Sistem Informasi Keuangan');
        $this->email->to(htmlspecialchars($this->input->post('email', true)));
        if ($type == 'verifikasi') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Klik link ini untuk verifikasi akun anda : <a href="'. site_url() .'auth/verifikasi?email=' . htmlspecialchars($this->input->post('email', true)) . '&token=' . urlencode($token) . '">Aktivasi</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die();
        }
    }

    public function hapus() {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            $ambil_data = $this->User_m->get_data_by_id($id)->row();
            $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row();
            if ($ambil_data->id == $user->id) {
                $msg = [
                    'gagal' => 'Kamu dilarang menghapus akun mu.'
                ];
            } else {
                $profil = $ambil_data->image;
                $this->db->where('id',$id);
                $this->User_m->hapus($id); 
                if($profil != 'default.png') {
                    unlink(FCPATH . 'assets/uploads/profil/' . $profil);
                }
                $msg = [
                        'sukses' => 'Data User berhasil dihapus.'
                ];
            }
            echo json_encode($msg);
            
        } else{
            redirect('error_');
        }
    }

    function get_tabel()
    {
        if ($this->input->is_ajax_request() == true) {

            $list = $this->User_m->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
                
                $no++;
                $row = array();

                $tombol_hapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus\" onclick=\"hapus('" . $field->id . "')\"><i class=\"fas fa-trash\"></i></button>";
                $view = "<button type=\"button\" class=\"btn btn-sm btn-success mr-1\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Lihat\" onclick=\"view('" . $field->id . "')\"><i class=\"fas fa-eye\"></i></button>";
                $foto = "<img style=\"width: 30px;\" alt=\"image\" src=\"".base_url('assets')."/uploads/profil/".$field->image."\" class=\"img-thumbnail\">";
                if ($field->role_id == 1) {
                    $role = "Pimpinan";
                } else {
                    $role = "Admin";
                }
                if ($field->is_active == 1) {
                    $status = "Aktif";
                } elseif($field->is_active == 0) {
                    $status = "Verifikasi";
                } else {
                    $status = "Non-Aktif";
                }

                $row[] = $no;
                $row[] = $foto;
                $row[] = $field->name;
                $row[] = $field->email;
                $row[] = $role;
                $row[] = date('d/m/Y', $field->date_created);
                $row[] = $status;
                $row[] = $view.''.$tombol_hapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->User_m->count_all(),
                "recordsFiltered" => $this->User_m->count_filtered(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            redirect('error_');
        }
    }
}

/* End of file User.php */
