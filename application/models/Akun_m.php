<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Akun_m extends CI_Model {
	var $table = 'tb_user';

    public function get_data_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function edit($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
}

/* End of file Akun_m.php */
