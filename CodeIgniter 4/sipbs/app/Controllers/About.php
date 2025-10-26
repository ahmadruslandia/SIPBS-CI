<?php

namespace App\Controllers;

use App\Models\VisitorModel;

use CodeIgniter\Controller;

class About extends Controller
{
	protected $visitorModel;

	public function __construct()
	{
		helper('text');

		$this->visitorModel = new VisitorModel();

		$this->visitorModel->countVisitor();
	}

	public function index()
	{
		$db = \Config\Database::connect();

		$siteInfo = $db->table('tbl_site')->get(1)->getRow();
		$v['logo'] = $siteInfo->site_logo_header;
		$data['icon'] = $siteInfo->site_favicon;
		$data['header'] = view('Header', $v);
		$data['footer'] = view('Footer');

		$about = $db->table('tbl_about')->get(1)->getRow();
		$data['about_img'] = $about->about_image;
		$data['about_desc'] = $about->about_description;

		return view('AboutView', $data);
	}
}
