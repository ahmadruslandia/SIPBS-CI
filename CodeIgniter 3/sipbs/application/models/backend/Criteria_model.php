<?php
class Criteria_model extends CI_Model
{

    protected $table = 'tb_criteria';
    protected $kode = 'kode_criteria';

    public function getArray()
    {
        $rows = $this->tampil();
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->kode_criteria] = $row;
        }
        return $arr;
    }

    public function tampil($search = '')
    {
        $this->db->like($this->kode, $search . '');
        $this->db->or_like('nama_criteria', $search . '');
        $this->db->order_by($this->kode);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_criteria($ID = null)
    {
        $query = $this->db->get_where($this->table, array($this->kode => $ID));
        return $query->row();
    }

    public function tambah($fields)
    {
        $this->db->insert($this->table, $fields);
        $this->db->query("INSERT INTO tb_rel_alternative(kode_criteria, kode_alternative, kode_crips) SELECT '$fields[kode_criteria]', kode_alternative, 0  FROM tb_alternative");
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
