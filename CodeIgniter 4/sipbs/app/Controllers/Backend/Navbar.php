<?php

namespace App\Controllers\Backend;

use App\Models\Backend\NavbarModel;

use CodeIgniter\Controller;

class Navbar extends Controller
{
	protected $navbarModel;

	protected $session;


	public function __construct()
	{
		$this->navbarModel = new NavbarModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['data'] = $this->navbarModel->getNavbar();
		return view('Backend/v_navbar', $data);
	}

	public function insert()
	{
		$name = htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES);
		$slug = htmlspecialchars(trim($this->request->getPost('slug')), ENT_QUOTES);
		$this->navbarModel->insertNavbar($name, $slug);
		session()->setFlashdata('msg', 'success');
		return redirect()->to('Backend/navbar');
	}

	public function update()
	{
		$id = $this->request->getPost('navbar_id');
		$name = htmlspecialchars($this->request->getPost('name_edit'), ENT_QUOTES);
		$slug = htmlspecialchars(trim($this->request->getPost('slug_edit')), ENT_QUOTES);
		$this->navbarModel->updateNavbar($id, $name, $slug);
		session()->setFlashdata('msg', 'info');
		return redirect()->to('Backend/navbar');
	}

	public function delete()
	{
		$id = $this->request->getPost('id_delete');
		$this->navbarModel->deleteNavbar($id);
		session()->setFlashdata('msg', 'success-hapus');
		return redirect()->to('Backend/navbar');
	}

	public function insertSubmenu()
	{
		$id = $this->request->getPost('id_submenu');
		$name = htmlspecialchars($this->request->getPost('name_submenu'), ENT_QUOTES);
		$slug = htmlspecialchars(trim($this->request->getPost('slug_submenu')), ENT_QUOTES);
		$this->navbarModel->insertSubNavbar($name, $slug, $id);
		session()->setFlashdata('msg', 'success');
		return redirect()->to('Backend/navbar');
	}
}
