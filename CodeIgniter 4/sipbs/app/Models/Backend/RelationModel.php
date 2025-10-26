<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class RelationModel extends Model
{
    public function getRelNilai($rel_alternative, $crips)
    {
        $arr = [];
        foreach ($rel_alternative as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$key][$k] = isset($crips[$v]['nilai']) ? $crips[$v]['nilai'] : 0;
            }
        }
        return $arr;
    }

    public function getArray()
    {
        $rows =  \App\Helpers\get_results("SELECT * FROM tb_rel_alternative ORDER BY kode_alternative, kode_criteria");

        $arr = [];
        foreach ($rows as $row) {
            $arr[$row->kode_alternative][$row->kode_criteria] = $row->kode_crips;
        }
        return $arr;
    }

    public function tampil($search = '')
    {
        $sql = "SELECT r.*, a.nama_alternative, c.nama_crips
                FROM tb_rel_alternative r
                INNER JOIN tb_criteria k ON k.kode_criteria = r.kode_criteria
                INNER JOIN tb_alternative a ON a.kode_alternative = r.kode_alternative
                LEFT JOIN tb_crips c ON c.kode_crips = r.kode_crips
                WHERE (a.kode_alternative LIKE ? OR a.nama_alternative LIKE ?)
                ORDER BY r.kode_alternative, r.kode_criteria";
        $query = $this->db->query($sql, ['%' . $search . '%', '%' . $search . '%']);

        return $query->getResult();
    }

    public function getRelation($ID)
    {
        $query = $this->db->query("SELECT
        r.*, a.nama_alternative, k.nama_criteria
    FROM tb_rel_alternative r 
        INNER JOIN tb_criteria k ON k.kode_criteria=r.kode_criteria
        INNER JOIN tb_alternative a ON a.kode_alternative=r.kode_alternative
        LEFT JOIN tb_crips c ON c.kode_crips = r.kode_crips
    WHERE a.kode_alternative='$ID' 
    ORDER BY r.kode_criteria");

        return $query->getResult();
    }

    public function ubah(array $kode_crips): void
    {
        $db = \Config\Database::connect();
        foreach ($kode_crips as $key => $val) {
            $db->table('tb_rel_alternative')
                ->where('ID', $key)
                ->update(['kode_crips' => $val]);
        }
    }
}
