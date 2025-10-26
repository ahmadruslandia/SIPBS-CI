<?php

namespace App\Controllers\Backend;

use App\Models\Backend\UsersModel;

use CodeIgniter\Controller;

use Config\Services;

class Users extends Controller
{
	protected $usersModel;

	protected $session;

	public function __construct()
	{
		helper(['url', 'form', 'text']);

		$this->usersModel = new UsersModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['data'] = $this->usersModel->get_users()->getResult();
		return view('Backend/v_users', $data);
	}

	public function insert()
	{
		$nama = htmlspecialchars($this->request->getPost('nama', FILTER_SANITIZE_STRING));
		$email = htmlspecialchars($this->request->getPost('email', FILTER_SANITIZE_EMAIL));
		$pass = htmlspecialchars($this->request->getPost('password', FILTER_SANITIZE_STRING));
		$pass2 = htmlspecialchars($this->request->getPost('password2', FILTER_SANITIZE_STRING));
		$level = htmlspecialchars($this->request->getPost('level', FILTER_SANITIZE_STRING));

		$validation = $this->usersModel->validasi_email($email);

		if ($validation->getNumRows() > 0) {
			session()->setFlashdata('msg', 'error-email');
			return redirect()->to('/Backend/users');
		} else {
			if ($pass === $pass2) {
				$imageFile = $this->request->getFile('filefoto');

				if ($imageFile && $imageFile->isValid()) {
					$newName = $imageFile->getRandomName();
					$imageFile->move('assets/images', $newName);

					$image = Services::image()->withFile('assets/images/' . $newName);
					$image->resize(100, 100, true, 'height')->save('assets/images/' . $newName);

					$this->usersModel->insert_user($nama, $email, $pass, $level, $newName);
				} else {
					$this->usersModel->insert_user_noimg($nama, $email, $pass, $level);
				}
				session()->setFlashdata('msg', 'success');
				return redirect()->to('/Backend/users');
			} else {
				session()->setFlashdata('msg', 'error');
				return redirect()->to('/Backend/users');
			}
		}
	}

	public function update()
	{
		$userid = $this->request->getPost('user_id');
		$nama = htmlspecialchars($this->request->getPost('nama', FILTER_SANITIZE_STRING));
		$email = htmlspecialchars($this->request->getPost('email', FILTER_SANITIZE_EMAIL));
		$pass = htmlspecialchars($this->request->getPost('password', FILTER_SANITIZE_STRING));
		$pass2 = htmlspecialchars($this->request->getPost('password2', FILTER_SANITIZE_STRING));
		$level = htmlspecialchars($this->request->getPost('level', FILTER_SANITIZE_STRING));

		$validation = $this->usersModel->validasi_email($email);

		if ($validation->getNumRows() > 0 && $validation->getRow()->user_id !== $userid) {
			session()->setFlashdata('msg', 'error-email');
			return redirect()->to('/Backend/users');
		} else {
			$imageFile = $this->request->getFile('filefoto');

			if (empty($pass) || empty($pass2)) {
				if ($imageFile && $imageFile->isValid()) {
					$newName = $imageFile->getRandomName();
					$imageFile->move('assets/images', $newName);

					$image = Services::image()->withFile('assets/images/' . $newName);
					$image->resize(100, 100, true, 'height')->save('assets/images/' . $newName);

					$this->usersModel->update_user_nopass($userid, $nama, $email, $level, $newName);
				} else {
					$this->usersModel->update_user_nopassimg($userid, $nama, $email, $level);
				}
			} else {
				if ($pass === $pass2) {
					if ($imageFile && $imageFile->isValid()) {
						$newName = $imageFile->getRandomName();
						$imageFile->move('assets/images', $newName);

						$image = Services::image()->withFile('assets/images/' . $newName);
						$image->resize(100, 100, true, 'height')->save('assets/images/' . $newName);

						$this->usersModel->update_user($userid, $nama, $email, $pass, $level, $newName);
					} else {
						$this->usersModel->update_user_noimg($userid, $nama, $email, $pass, $level);
					}
				} else {
					session()->setFlashdata('msg', 'error');
					return redirect()->to('/Backend/users');
				}
			}
			session()->setFlashdata('msg', 'info');
			return redirect()->to('/Backend/users');
		}
	}

	public function lock($user_id)
	{
		$this->usersModel->lock_user($user_id);
		return redirect()->to('/Backend/users');
	}

	public function unlock($user_id)
	{
		$this->usersModel->unlock_user($user_id);
		return redirect()->to('/Backend/users');
	}

	public function delete()
	{
		$userid = $this->request->getPost('kode');
		$this->usersModel->delete_user($userid);
		session()->setFlashdata('msg', 'success-hapus');
		return redirect()->to('/Backend/users');
	}
}
