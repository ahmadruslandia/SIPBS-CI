<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'tbl_visitors';

    public function countVisitor()
    {
        $user_ip = $_SERVER['REMOTE_ADDR'];

        $agent = \Config\Services::request()->getUserAgent();

        if ($agent->isBrowser()) {
            $platform = $agent->getBrowser();
        } elseif ($agent->isRobot()) {
            $platform = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $platform = $agent->getMobile();
        } else {
            $platform = 'Other';
        }

        $cek_ip = $this->db->query("SELECT * FROM tbl_visitors WHERE visit_ip='$user_ip' AND DATE(visit_date)=CURDATE()");

        if ($cek_ip->getNumRows() <= 0) {
            $hsl = $this->db->query("INSERT INTO tbl_visitors (visit_ip, visit_platform) VALUES('$user_ip', '$platform')");
            return $hsl;
        }
    }
}
