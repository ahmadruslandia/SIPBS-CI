<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class CripsModel extends Model
{
    protected $table = 'tb_crips';
    protected $primaryKey = 'kode_crips';
    protected $allowedFields = ['kode_crips', 'kode_criteria', 'nama_crips', 'nilai'];

    public function getArray()
    {
        $rows = $this->findAll();
        $arr = [];
        foreach ($rows as $row) {
            $arr[$row['kode_crips']] = $row;
        }
        return $arr;
    }

    public function tampil($search = '')
    {
        return $this->select('tb_crips.*, tb_criteria.nama_criteria')
            ->join('tb_criteria', 'tb_criteria.kode_criteria = tb_crips.kode_criteria')
            ->like('tb_criteria.nama_criteria', $search)
            ->orLike('tb_crips.nama_crips', $search)
            ->orderBy('tb_criteria.kode_criteria')
            ->orderBy('nilai')
            ->findAll();
    }

    public function getCripsByCriteria($kode_criteria)
    {
        return $this->where('kode_criteria', $kode_criteria)
            ->orderBy('nilai')
            ->findAll();
    }

    public function getCrips($ID = null)
    {
        return $this->where('kode_crips', $ID)->first();
    }

    public function tambah($fields)
    {
        $this->insert($fields);
    }

    public function ubah($fields, $ID)
    {
        $this->update($ID, $fields);
    }

    public function hapus($ID)
    {
        $this->delete($ID);
        $this->db->table('tb_rel_alternative')
            ->where('kode_crips', $ID)
            ->delete();
    }
}
