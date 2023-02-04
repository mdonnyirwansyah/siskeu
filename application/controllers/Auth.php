<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_m');
    }

	public function index() 
	{
		$this->goToDefaultPage();
		$data['judul'] = 'Login';
		$this->load->view('auth/login/index', $data);
		
		
	}

	public function login()
    {
    	$this->goToDefaultPage();
        if ($this->input->post() == true) {
      
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[16]');

			if( $this->form_validation->run() == true ) {

				$this->_login();
	        } else {
	        	$data['judul'] = 'Login';
	        	
				$this->load->view('auth/login/index', $data);
			}
        } else {
            redirect('error_');
        }
    }

	private function _login() 
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
		

		// jika usernya ada
		if( $user ) {
			// jika usernya aktif
			if( $user['is_active'] == 1 ) {
				if( password_verify($password, $user['password']) ) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'time_login' => time(),
					];
					$this->session->set_userdata($data);
					if($user['role_id'] == 2) {
						redirect('admin/dashboard');
					} else {
						redirect('pimpinan/dashboard');
					}
					
				} else {
					$this->session->set_flashdata('message',   '<div class="alert alert-danger alert-has-icon">
							                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
							                                      <div class="alert-body">
							                                        <div class="alert-title">Peringatan!</div>
							                                        Password salah.
							                                      </div>
							                                    </div>');
					redirect('auth');
				}
			} elseif ($user['is_active'] == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-has-icon">
							                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
							                                      <div class="alert-body">
							                                        <div class="alert-title">Peringatan!</div>
							                                        Akun anda belum diverifikasi, silahkan periksa email dan aktivasi akun anda.
							                                      </div>
							                                    </div>');
				redirect('auth');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-has-icon">
							                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
							                                      <div class="alert-body">
							                                        <div class="alert-title">Peringatan!</div>
							                                        Akun dinonaktifkan, anda telah lebih dari 3 kali salah password. Klik lupa password untuk mereset password anda.
							                                      </div>
							                                    </div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message',   '<div class="alert alert-danger alert-has-icon">
					                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
					                                      <div class="alert-body">
					                                        <div class="alert-title">Peringatan!</div>
					                                        Email tidak terdaftar.
					                                      </div>
					                                    </div>');
			redirect('auth');
		}
	}

	public function verifikasi()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('tb_token', ['email' => $email])->row();

		if ($user) {
			if ($user->token == $token) {
				if (time() - $user->date_created < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('tb_user');
					$this->db->delete('tb_token', ['email' => $email]);
					
					$this->session->set_flashdata('message',   '<div class="alert alert-success alert-has-icon">
					                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
					                                      <div class="alert-body">
					                                        <div class="alert-title">Pemberitahuan!</div>
					                                        Akun anda berhasil diverifikasi, silahkan login untuk mengakses akun anda.
					                                      </div>
					                                    </div>');
					redirect('auth');
				} else {
					$this->db->delete('tb_token', ['email' => $email]);

					$this->session->set_flashdata('message',   '<div class="alert alert-danger alert-has-icon">
					                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
					                                      <div class="alert-body">
					                                        <div class="alert-title">Peringatan!</div>
					                                        Waktu verifikasi akun anda telah habis, silahkan hubungi Pimpinan.
					                                      </div>
					                                    </div>');
					redirect('auth');
				}
			}
			else {
				redirect('error_');
			}
		} else {
			redirect('error_');
		}
	}

	public function reset_password()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('tb_token', ['email' => $email])->row();

		if ($user) {
			if ($user->token == $token) {
				if (time() - $user->date_created < (60 * 60 * 24)) {
		
					$data['judul'] = 'Reset Password';
					$data['email'] = $email;
					$this->load->view('auth/reset-password/index', $data);
				} else {
					$this->db->delete('tb_token', ['email' => $email]);

					$this->session->set_flashdata('message',   '<div class="alert alert-danger alert-has-icon">
					                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
					                                      <div class="alert-body">
					                                        <div class="alert-title">Peringatan!</div>
					                                        Waktu verifikasi akun anda telah habis, silahkan hubungi Pimpinan.
					                                      </div>
					                                    </div>');
					redirect('auth');
				}
			}
			else {
				redirect('error_');
			}
		} else {
			redirect('error_');
		}
	}

	public function ganti_password()
    {
        if ($this->input->is_ajax_request() == true) {

            $this->form_validation->set_rules('password', 'password baru', 'required|min_length[8]|max_length[16]');
            $this->form_validation->set_rules('password1', 'ketik ulang password', 'required|matches[password]');
            if ($this->form_validation->run() == true) {
            	$email = $this->input->post('email');
                $password = $this->input->post('password');
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                        $this->db->set('password', $password_hash);
                        $this->db->set('is_active', 1);
                        $this->db->where('email', $email);
                        $this->db->update('tb_user');

                        $this->db->delete('tb_token', ['email' => $email]);
                        $msg = [
                                'sukses' => 'Password berhasil diganti.'
                        ];
            } else {
                $msg = [
                        'error' => '<div class="alert alert-danger alert-has-icon">
                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                      <div class="alert-body">
                                        <div class="alert-title">Peringatan!</div>
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

	public function logout() 
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-info alert-has-icon">
						                            <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
						                            <div class="alert-body">
						                              <div class="alert-title">Pemberitahuan!</div>
						                                Anda telah logout.
			                                        </div>
			                                      </div>');
		redirect('auth');
	}
	public function lupa_password()
	{
		$this->goToDefaultPage();
		$data['judul'] = 'Lupa Password';
		$this->load->view('auth/lupa-password/index', $data);
	}

	public function lupa()
    {
        if ($this->input->is_ajax_request() == true) {
            
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[tb_token.email]');
            if ($this->form_validation->run() == true) {
            	$email = htmlspecialchars($this->input->post('email', true));
            	$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
                if ($user) {
                	$token = base64_encode(random_bytes(32));
			        $user_token = [
			                            'email' => $email,
			                            'token' => $token,
			                            'date_created' => time()
			        ];
			        
			        $this->_sendEmail($token, 'reset');
			        $this->User_m->tambah_token($user_token);
                	$msg = [
                        'sukses' => 'Periksa email anda dan klik tautan untuk mengatur ulang password.'
                	];
                } else {
                	$msg = [
                        'error' => '<div class="alert alert-danger alert-has-icon">
                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                      <div class="alert-body">
                                        <div class="alert-title">Peringatan!</div>
                                        Email anda tidak terdaftar.
                                      </div>
                                    </div>'
                	];
                }
                
            } else {
                $msg = [
                        'error' => '<div class="alert alert-danger alert-has-icon">
                                      <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                      <div class="alert-body">
                                        <div class="alert-title">Peringatan!</div>
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
        if ($type == 'reset') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik tautan ini untuk reset password anda : <a href="'. site_url() .'auth/reset_password?email=' . htmlspecialchars($this->input->post('email', true)) . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die();
        }
    }

	public function goToDefaultPage() {
		if( $this->session->userdata('role_id') == 1 ) {
			redirect('pimpinan/dashboard');
		} else if ( $this->session->userdata('role_id') == 2 ) {
			redirect('admin/dashboard');
		}
	}
}

/* End of file Auth.php */