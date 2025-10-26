<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class CriteriaModel extends Model
{
    protected $table = 'tb_criteria';
    protected $primaryKey = 'kode_criteria';
    protected $allowedFields = ['kode_criteria', 'nama_criteria', 'atribut', 'bobot'];

    public function getArray()
    {
        $rows = $this->findAll();
        $arr = [];
        foreach ($rows as $row) {
            $arr[$row['kode_criteria']] = $row;
        }
        return $arr;
    }

    public function tampil($search = '')
    {
        return $this->like('kode_criteria', $search)
            ->orLike('nama_criteria', $search)
            ->orderBy('kode_criteria')
            ->findAll();
    }

    public function getCriteria($ID = null)
    {
        return $this->where('kode_criteria', $ID)->first();
    }

    public function tambah($fields)
    {
        $this->insert($fields);
        $this->db->query("INSERT INTO tb_rel_alternative(kode_criteria, kode_alternative, kode_crips) 
                          SELECT '{$fields['kode_criteria']}', kode_alternative, 0  
                          FROM tb_alternative");
    }

    public function ubah($fields, $ID)
    {
        $this->update($ID, $fields);
    }

    public function hapus($ID)
    {
        $this->delete($ID);
        $this->db->table('tb_rel_alternative')
            ->where('kode_criteria', $ID)
            ->delete();
    }
}
