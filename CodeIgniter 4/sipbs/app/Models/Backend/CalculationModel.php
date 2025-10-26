<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class CalculationModel extends Model
{
    protected $table = 'tb_rel_alternative';
    protected $primaryKey = 'id';
    protected $allowedFields = ['bobot', 'nilai_min'];

    public function getRelation()
    {
        return $this->db->table('tb_rel_alternative')
            ->orderBy('kode_alternative, kode_criteria')
            ->get()
            ->getResult();
    }

    public function getData()
    {
        $data = [];
        $alternatives = $this->db->table('tb_alternative')
            ->get()
            ->getResult();
        foreach ($alternatives as $row) {
            $data['alternative'][$row->kode_alternative] = $row;
        }

        $criteria = $this->db->table('tb_criteria')
            ->get()
            ->getResult();
        foreach ($criteria as $row) {
            $data['criteria'][$row->kode_criteria] = $row;
        }

        $data['relation'] = $this->db->table('tb_rel_alternative')
            ->orderBy('kode_alternative, kode_criteria')
            ->get()
            ->getResult();

        return $data;
    }

    public function simpanBobot($data)
    {
        foreach ($data['bobot'] as $key => $value) {
            $this->db->table('criteria')
                ->where('kode_criteria', $key)
                ->update(['bobot' => $value]);
        }

        $this->db->table('paket_beasiswa')
            ->where('id_beasiswa', $data['id_beasiswa'])
            ->update(['nilai_min' => $data['nilai_min']]);
    }

    public function cetak()
    {
        return $this->db->table('pelamar_beasiswa p')
            ->join('mahasiswa m', 'm.nim = p.nim')
            ->orderBy('p.total', 'DESC')
            ->get()
            ->getResult();
    }

    public function simpanHasil($rank = [], $total = [])
    {
        foreach ($rank as $key => $value) {
            $this->db->table('pelamar_beasiswa')
                ->where('id_pelamar', $key)
                ->update(['total' => $total[$key], 'rank' => $value]);
        }
    }
}
