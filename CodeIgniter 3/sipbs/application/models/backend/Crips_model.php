<?php
class Crips_model extends CI_Model
{

    protected $table = 'tb_crips';
    protected $kode = 'kode_crips';

    public function getArray()
    {
        $rows = $this->tampil();
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->kode_crips] = $row;
        }
        return $arr;
    }

    public function tampil($search = '')
    {
        $this->db->like('nama_criteria', $search . '');
        $this->db->or_like('nama_crips', $search . '');
        $this->db->join('tb_criteria', 'tb_criteria.kode_criteria=tb_crips.kode_criteria');
        $this->db->order_by('tb_criteria.kode_criteria');
        $this->db->order_by('nilai');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_crips_by_criteria($kode_criteria)
    {
        $this->db->where(array('kode_criteria' => $kode_criteria));
        $this->db->order_by('nilai');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_crips($ID = null)
    {
        $query = $this->db->get_where($this->table, array($this->kode => $ID));
        return $query->row();
    }

    public function tambah($fields)
    {
        $this->db->insert($this->table, $fields);
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
