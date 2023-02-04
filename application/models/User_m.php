<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class User_m extends CI_Model {
	var $table = 'tb_user';
    var $column_order = array(null, 'id', 'name', 'email');
    var $column_search = array('name', 'email');
    var $order = array('name' => 'asc');

    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function tambah($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function tambah_token($user_token)
    {
        return $this->db->insert('tb_token', $user_token);
    }

    public function get_data_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id]);
    }

    public function hapus($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}

/* End of file User_m.php */
