<?php

namespace App\Controllers;

use App\Models\VisitorModel;
use App\Models\SiteModel;

use CodeIgniter\Controller;

class Login extends Controller
{
	protected $visitorModel;
	protected $siteModel;

	public function __construct()
	{
		$this->visitorModel = new VisitorModel();
		$this->siteModel = new SiteModel();

		$this->visitorModel->countVisitor();
	}

	public function index()
	{
		$db = \Config\Database::connect();

		$siteInfo = $db->table('tbl_site')->get()->getRow();
		$v['logo'] = $siteInfo->site_logo_header;
		$data['icon'] = $siteInfo->site_favicon;
		$data['header'] = view('Header', $v);
		$data['footer'] = view('Footer');

		$session = session();
		$data['msg'] = $session->getFlashdata('msg');

		return view('LoginView', $data);
	}
}
