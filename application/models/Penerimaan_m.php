<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Penerimaan_m extends CI_Model {
	var $table = 'tb_transaksi';
    var $column_order = array(null, 'kode', 'tanggal', 'uraian', 'satuan', 'keterangan');
    var $column_search = array('tanggal', 'uraian', 'satuan', 'keterangan');
    var $order = array('tanggal' => 'desc');
    var $jenis = 'd';

    public function get($tahun1, $bulanawal, $bulanakhir)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('YEAR(tanggal) = "'.$tahun1.'" AND MONTH(tanggal) BETWEEN "'.$bulanawal.'" AND "'.$bulanakhir.'"');
        $this->db->like('jenis', $this->jenis);
        $this->db->order_by('tanggal', 'ASC');

        return $this->db->get()->result();
    }

    public function get_tahun()
    {
        $this->db->select('YEAR(tanggal) AS tahun');
        $this->db->from($this->table);
        $this->db->like('jenis', $this->jenis);
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'ASC');

        return $this->db->get()->result();
    }
    public function get_bulan()
    {
        $this->db->select('DATE_FORMAT(tanggal, "%M") AS bulan, MONTH(tanggal) AS value');
        $this->db->from($this->table);
        $this->db->like('jenis', $this->jenis);
        $this->db->group_by('bulan');
        $this->db->order_by('value', 'asc');

        return $this->db->get()->result();
    }

    public function get_sum($tahun1, $bulanawal, $bulanakhir)
    {
        $this->db->select('SUM(satuan * volume) AS sum');
        $this->db->from($this->table);
        $this->db->where('YEAR(tanggal) = "'.$tahun1.'" AND MONTH(tanggal) BETWEEN "'.$bulanawal.'" AND "'.$bulanakhir.'"');
        $this->db->like('jenis', $this->jenis);
        return $this->db->get()->row();
    }

    public function get_sumByBulan()
    {
        $tahun = date('Y');
        $this->db->select('SUM(satuan * volume) AS sum, DATE_FORMAT(tanggal, "%M") AS bulan, MONTH(tanggal) AS value');
        $this->db->from($this->table);
        $this->db->where('YEAR(tanggal) = "'.$tahun.'" AND jenis = "'.$this->jenis.'"', );
        $this->db->group_by('value');
        $this->db->order_by('value', 'asc');

        return $this->db->get()->result();
    }

    public function get_count()
    {
        $this->db->select('COUNT(kode) AS count');
        $this->db->from($this->table);
        $this->db->like('jenis', $this->jenis);

        return $this->db->get()->row();
    }

    private function _get_datatables_query($tahun1, $bulanawal, $bulanakhir)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('YEAR(tanggal) = "'.$tahun1.'" AND MONTH(tanggal) BETWEEN "'.$bulanawal.'" AND "'.$bulanakhir.'"');
        $this->db->like('jenis', $this->jenis);

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

    function get_datatables($tahun1, $bulanawal, $bulanakhir)
    {
        $this->_get_datatables_query($tahun1, $bulanawal, $bulanakhir);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($tahun1, $bulanawal, $bulanakhir)
    {
        $this->_get_datatables_query($tahun1, $bulanawal, $bulanakhir);
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

    public function get_data_by_id($id)
    {
        return $this->db->get_where($this->table, ['kode' => $id]);
    }

    public function edit($data, $id)
    {
        $this->db->where('kode', $id);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id)
    {
        return $this->db->delete($this->table, ['kode' => $id]);
    }
}

/* End of file Penerimaan_m.php */
