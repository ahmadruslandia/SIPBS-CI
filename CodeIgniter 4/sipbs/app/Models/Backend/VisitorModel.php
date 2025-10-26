<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'tbl_visitors';

    public function visitorStatistics()
    {
        $query = $this->db->query("SELECT DATE_FORMAT(visit_date,'%d') AS tgl, COUNT(visit_ip) AS jumlah FROM tbl_visitors WHERE MONTH(visit_date) = MONTH(CURDATE()) GROUP BY DATE(visit_date)");
        return $query->getResultObject();
    }

    public function countAllVisitors()
    {
        return $this->db->table('tbl_visitors')->countAllResults();
    }

    public function countAllPageViews()
    {
        return $this->db->table('tbl_post_views')->countAllResults();
    }

    public function countAllPosts()
    {
        return $this->db->table('tbl_post')->countAllResults();
    }

    public function countAllComments()
    {
        return $this->db->table('tbl_comment')->countAllResults();
    }

    public function topFiveArticles()
    {
        $query = $this->db->query("SELECT * FROM tbl_post ORDER BY post_views DESC LIMIT 5");
        return $query->getResultObject();
    }

    public function countVisitorThisMonth()
    {
        $query = $this->db->query("SELECT COUNT(*) AS tot_visitor FROM tbl_visitors WHERE MONTH(visit_date) = MONTH(CURDATE())");
        return $query->getRowObject();
    }

    public function countChromeVisitors()
    {
        $query = $this->db->query("SELECT COUNT(*) AS chrome_visitor FROM tbl_visitors WHERE visit_platform = 'Chrome' AND MONTH(visit_date) = MONTH(CURDATE())");
        return $query->getRowObject();
    }

    public function countFirefoxVisitors()
    {
        $query = $this->db->query("SELECT COUNT(*) AS firefox_visitor FROM tbl_visitors WHERE (visit_platform = 'Firefox' OR visit_platform = 'Mozilla') AND MONTH(visit_date) = MONTH(CURDATE())");
        return $query->getRowObject();
    }

    public function countExplorerVisitors()
    {
        $query = $this->db->query("SELECT COUNT(*) AS explorer_visitor FROM tbl_visitors WHERE visit_platform = 'Internet Explorer' AND MONTH(visit_date) = MONTH(CURDATE())");
        return $query->getRowObject();
    }

    public function countSafariVisitors()
    {
        $query = $this->db->query("SELECT COUNT(*) AS safari_visitor FROM tbl_visitors WHERE visit_platform = 'Safari' AND MONTH(visit_date) = MONTH(CURDATE())");
        return $query->getRowObject();
    }

    public function countOperaVisitors()
    {
        $query = $this->db->query("SELECT COUNT(*) AS opera_visitor FROM tbl_visitors WHERE visit_platform = 'Opera' AND MONTH(visit_date) = MONTH(CURDATE())");
        return $query->getRowObject();
    }

    public function countRobotVisitors()
    {
        $query = $this->db->query("SELECT COUNT(*) AS robot_visitor FROM tbl_visitors WHERE (visit_platform = 'YandexBot' OR visit_platform = 'Googlebot' OR visit_platform = 'Yahoo') AND MONTH(visit_date) = MONTH(CURDATE())");
        return $query->getRowObject();
    }

    public function countOtherVisitors()
    {
        $query = $this->db->query("SELECT COUNT(*) AS other_visitor FROM tbl_visitors WHERE (NOT visit_platform = 'YandexBot' AND NOT visit_platform = 'Googlebot' AND NOT visit_platform = 'Yahoo' AND NOT visit_platform = 'Chrome' AND NOT visit_platform = 'Firefox' AND NOT visit_platform = 'Mozilla' AND NOT visit_platform = 'Internet Explorer' AND NOT visit_platform = 'Safari' AND NOT visit_platform = 'Opera') AND MONTH(visit_date) = MONTH(CURDATE())");
        return $query->getRowObject();
    }
}
