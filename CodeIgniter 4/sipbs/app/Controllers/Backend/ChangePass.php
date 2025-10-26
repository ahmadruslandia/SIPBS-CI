<?php

namespace App\Controllers\Backend;

use App\Models\Backend\ChangePassModel;

use CodeIgniter\Controller;

class ChangePass extends Controller
{
	protected $changepassModel;

	protected $session;

	public function __construct()
	{
		helper('text');

		$this->changepassModel = new ChangePassModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		return view('Backend/v_change_pass');
	}

	public function change()
	{
		$user_id = session()->get('id');

		if (!empty($user_id)) {
			$old_password = htmlspecialchars($this->request->getPost('old_password'), ENT_QUOTES);
			$new_password = htmlspecialchars($this->request->getPost('new_password'), ENT_QUOTES);
			$conf_password = htmlspecialchars($this->request->getPost('conf_password'), ENT_QUOTES);

			$old_pass = md5($old_password);
			$new_pass = md5($new_password);

			$checking_old_password = $this->changepassModel->checkingOldPassword($user_id, $old_pass);

			if ($checking_old_password && $checking_old_password->countAllResults() > 0) {
				if ($new_password === $conf_password) {
					$this->changepassModel->changePassword($user_id, $new_pass);
					session()->setFlashdata('msg', 'success');
				} else {
					session()->setFlashdata('msg', 'error-notmatch');
				}
			} else {
				session()->setFlashdata('msg', 'error-notfound');
			}
			return redirect()->to('Backend/changepass');
		} else {
			session()->setFlashdata('msg', 'error');
			return redirect()->to('Backend/changepass');
		}
	}
}
