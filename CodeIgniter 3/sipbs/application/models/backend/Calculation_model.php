<?php
class Calculation_model extends CI_Model
{

    public function get_relation()
    {
        $query = $this->db->query("SELECT * FROM tb_rel_alternative ORDER BY kode_alternative, kode_criteria");
        return $query->result();
    }

    public function get_data()
    {
        $rows = $this->db->get('tb_alternative')->result();
        foreach ($rows as $row) {
            $data['alternative'][$row->kode_alternative] = $row;
        }
        $rows = $this->db->get('tb_criteria')->result();
        foreach ($rows as $row) {
            $data['criteria'][$row->kode_criteria] = $row;
        }
        $data['relation'] = $this->db->query("SELECT * FROM tb_rel_alternative ORDER BY kode_alternative, kode_criteria")->result();

        return $data;
    }

    public function simpan_bobot($data)
    {
        foreach ($data['bobot'] as $key => $value) {
            $this->db->update('criteria', array('bobot' => $value), array('kode_criteria' => $key));
        }
        $this->db->update('paket_beasiswa', array('nilai_min' => $data['nilai_min']), array('id_beasiswa' => $data['id_beasiswa']));
    }

    public function cetak()
    {
        $query = $this->db->query("SELECT * FROM pelamar_beasiswa p INNER JOIN mahasiswa m ON m.nim=p.nim ORDER BY p.total DESC");
        return $query->result();
    }

    public function simpan_hasil($rank = array(), $total = array())
    {
        foreach ($rank as $key => $value) {
            $this->db->update(
                'pelamar_beasiswa',
                array('total' => $total[$key], 'rank' => $value),
                array('id_pelamar' => $key)
            );
        }
    }
}
