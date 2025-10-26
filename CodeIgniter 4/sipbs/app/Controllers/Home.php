<?php

namespace App\Controllers;

use App\Models\VisitorModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\Backend\AlternativeModel;

class Home extends BaseController
{
    protected $visitorModel;
    protected $homeModel;
    protected $siteModel;
    protected $alternativeModel;

    protected $db;

    public function __construct()
    {
        helper('text');

        $this->visitorModel = new VisitorModel();
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->alternativeModel = new AlternativeModel();

        $this->visitorModel->countVisitor();
    }

    public function index()
    {
        $db = \Config\Database::connect();

        $query = $db->table('tbl_navbar')
            ->where('navbar_parent_id', 0)
            ->get();
        $navbar_items = $query->getResult();

        foreach ($navbar_items as $item) {
            $sub_query = $db->table('tbl_navbar')
                ->where('navbar_parent_id', $item->navbar_id)
                ->get();
            $item->sub_items = $sub_query->getResult();
        }

        $data['navbar_items'] = $navbar_items;

        $site = $this->siteModel->getSiteData();
        $data['site_name'] = $site['site_name'];
        $data['site_title'] = $site['site_title'];
        $data['site_desc'] = $site['site_description'];
        $data['site_image'] = $site['site_logo_big'];

        $data['post_header'] = $this->homeModel->getPostHeader();
        $data['post_header_2'] = $this->homeModel->getPostHeader2();
        $data['post_header_3'] = $this->homeModel->getPostHeader3();
        $data['latest_post'] = $this->homeModel->getLatestPost();
        $data['popular_post'] = $this->homeModel->getPopularPost();

        $this->db = \Config\Database::connect();
        $home = $this->db->table('tbl_home')->limit(1)->get()->getRow();
        $data['caption_1'] = $home->home_caption_1;
        $data['caption_2'] = $home->home_caption_2;
        $data['bg_header'] = $home->home_bg_heading;
        $data['bg_testimoni'] = $home->home_bg_testimonial;


        $data['testimonial'] = $this->db->table('tbl_testimonial')->get();

        $db = \Config\Database::connect();
        $siteInfo = $db->table('tbl_site')->get(1)->getRow();
        $v['logo'] = $siteInfo->site_logo_header;
        $data['icon'] = $siteInfo->site_favicon;
        $data['header'] = view('Header', $v);
        $data['footer'] = view('Footer');

        $data['rows'] = $this->alternativeModel->tampil();

        return view('HomeView', $data);
    }
}
