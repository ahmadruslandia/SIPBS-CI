<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class AlternativeModel extends Model
{
    protected $table = 'tb_alternative';
    protected $primaryKey = 'kode_alternative';

    public function getArray()
    {
        $rows = $this->tampil();
        $arr = [];
        foreach ($rows as $row) {
            $arr[$row->kode_alternative] = $row;
        }
        return $arr;
    }

    public function tampil()
    {
        return $this->db->table($this->table)
            ->like($this->primaryKey)
            ->orLike('nama_alternative')
            ->orderBy($this->primaryKey)
            ->get()
            ->getResult();
    }

    public function getAlternative($ID = null)
    {
        return $this->db->table($this->table)
            ->where($this->primaryKey, $ID)
            ->get()
            ->getRow();
    }

    public function tambah($fields)
    {
        $this->db->table($this->table)->insert($fields);
        $this->db->query("INSERT INTO tb_rel_alternative (kode_criteria, kode_alternative, kode_crips) SELECT kode_criteria, '{$fields['kode_alternative']}', 0 FROM tb_criteria");
    }

    public function ubah($fields, $ID)
    {
        $this->db->table($this->table)
            ->update($fields, [$this->primaryKey => $ID]);
    }

    public function hapus($ID)
    {
        $this->db->table($this->table)
            ->delete([$this->primaryKey => $ID]);
        $this->db->table('tb_rel_alternative')
            ->delete([$this->primaryKey => $ID]);
    }
}
