<?php

namespace App\Models;

use CodeIgniter\Model;

class ChartModel extends Model
{
    protected $table = 'tb_alternative';

    public function __construct()
    {
        parent::__construct();
    }

    public function chartDatabase()
    {
        return $this->findAll();
    }
}
