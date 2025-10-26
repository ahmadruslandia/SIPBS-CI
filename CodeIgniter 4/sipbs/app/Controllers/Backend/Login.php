<?php

namespace App\Controllers\Backend;

use App\Models\Backend\LoginModel;
use App\Models\VisitorModel;

use CodeIgniter\Controller;

class Login extends Controller
{
	protected $loginModel;
	protected $visitorModel;

	protected $session;

	public function __construct()
	{
		$this->loginModel = new LoginModel();
		$this->visitorModel = new VisitorModel();

		$this->session = \Config\Services::session();

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

	public function auth()
	{
		$username = htmlspecialchars($this->request->getPost('username'), ENT_QUOTES);
		$password = htmlspecialchars($this->request->getPost('password'), ENT_QUOTES);

		$validateUs = $this->loginModel->validasiUsername($username);
		if (!empty($validateUs)) {
			$validatePs = $this->loginModel->validasiPassword($username, $password);
			if (!empty($validatePs)) {
				$this->session->set('logged', TRUE);
				$x = $validatePs;

				if ($x['user_level'] == '1') {
					$this->session->set('access', '1');
				} else {
					$this->session->set('access', '2');
				}

				$this->session->set('id', $x['user_id']);
				$this->session->set('name', $x['user_name']);

				return redirect()->to('/Backend/dashboard');
			} else {
				session()->setFlashdata('msg', '<div class="alert alert-warning">Password Salah</div>');
				return redirect()->to('/administrator');
			}
		} else {
			session()->setFlashdata('msg', '<div class="alert alert-warning">Username Salah</div>');
			return redirect()->to('/administrator');
		}
	}

	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/administrator');
	}
}
