<?php
class Relation_model extends CI_Model
{
    public function getRelNilai($rel_alternative, $crips)
    {
        $arr = array();
        foreach ($rel_alternative as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$key][$k] =  (isset($crips[$v]->nilai)) ? $crips[$v]->nilai : 0;
            }
        }
        return $arr;
    }
    public function getArray()
    {
        $rows = get_resuslts("SELECT * FROM tb_rel_alternative ORDER BY kode_alternative, kode_criteria");
        $arr = array();
        foreach ($rows as $row) {
            $arr[$row->kode_alternative][$row->kode_criteria] = $row->kode_crips;
        }
        return $arr;
    }

    public function tampil($search = '')
    {
        $query = $this->db->query("SELECT r.*, a.nama_alternative, c.nama_crips
        FROM tb_rel_alternative r
            INNER JOIN tb_criteria k ON k.kode_criteria=r.kode_criteria
            INNER JOIN tb_alternative a ON a.kode_alternative=r.kode_alternative
            LEFT JOIN tb_crips c ON c.kode_crips = r.kode_crips
        WHERE (a.kode_alternative LIKE '%" . $search . "%' OR a.nama_alternative LIKE '%" . $search . "%')
        ORDER BY r.kode_alternative, r.kode_criteria");

        return $query->result();
    }

    public function get_relation($ID)
    {
        $query = $this->db->query("SELECT
            r.*, a.nama_alternative, k.nama_criteria
        FROM tb_rel_alternative r 
        	INNER JOIN tb_criteria k ON k.kode_criteria=r.kode_criteria
            INNER JOIN tb_alternative a ON a.kode_alternative=r.kode_alternative
            LEFT JOIN tb_crips c ON c.kode_crips = r.kode_crips
        WHERE a.kode_alternative='$ID' 
        ORDER BY r.kode_criteria");

        return $query->result();
    }

    public function ubah($kode_crips)
    {
        foreach ($kode_crips as $key => $val) {
            $this->db->update('tb_rel_alternative', array('kode_crips' => $val), array('ID' => $key));
        }
    }
}
