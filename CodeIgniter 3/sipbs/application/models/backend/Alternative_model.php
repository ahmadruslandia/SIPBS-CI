<?php
class Alternative_model extends CI_Model
{

    protected $table = 'tb_alternative';
    protected $kode = 'kode_alternative';

    public function getArray()
    {
        $rows = $this->tampil();
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->kode_alternative] = $row;
        }
        return $arr;
    }

    public function tampil()
    {
        $this->db->like($this->kode);
        $this->db->or_like('nama_alternative');
        $this->db->order_by($this->kode);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_alternative($ID = null)
    {
        $query = $this->db->get_where($this->table, array($this->kode => $ID));
        return $query->row();
    }

    public function tambah($fields)
    {
        $this->db->insert($this->table, $fields);
        $this->db->query("INSERT INTO tb_rel_alternative(kode_criteria, kode_alternative, kode_crips) SELECT kode_criteria, '$fields[kode_alternative]', 0  FROM tb_criteria");
    }

    public function ubah($fields, $ID)
    {
        $this->db->update($this->table, $fields, array($this->kode => $ID));
    }

    public function hapus($ID)
    {
        $this->db->delete($this->table, array($this->kode => $ID));
        $this->db->delete('tb_rel_alternative', array($this->kode => $ID));
    }
}
