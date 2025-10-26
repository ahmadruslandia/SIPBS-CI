<?php

namespace App\Controllers\Backend;

use App\Models\Backend\CripsModel;
use App\Models\Backend\CriteriaModel;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Controller;

class Crips extends Controller
{
	protected $cripsModel;
	protected $criteriaModel;

	protected $session;


	public function __construct()
	{
		$this->cripsModel = new CripsModel();
		$this->criteriaModel = new CriteriaModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['rows'] = $this->cripsModel->tampil();
		return view('Backend/crips/v_read', $data);
	}

	public function add()
	{
		$data['title'] = 'Tambah Crips';

		if (!$this->validate([
			'kode_criteria' => 'required',
			'nama_crips' => 'required',
			'nilai' => 'required|is_natural_no_zero',
		])) {
			return view('Backend/crips/v_add', $data);
		}

		$fields = [
			'kode_criteria' => $this->request->getPost('kode_criteria'),
			'nama_crips' => $this->request->getPost('nama_crips'),
			'nilai' => $this->request->getPost('nilai'),
		];

		$this->cripsModel->tambah($fields);
		session()->setFlashdata('msg', 'success');
		return redirect()->to(base_url('Backend/crips'));
	}

	public function edit($ID = null)
	{
		$data['title'] = 'Ubah Crips';

		if (!$this->validate([
			'kode_criteria' => 'required',
			'nama_crips' => 'required',
			'nilai' => 'required|is_natural_no_zero',
		])) {
			$data['rowl'] = $this->cripsModel->getCrips($ID);
			if (!$data['rowl']) {
				throw PageNotFoundException::forPageNotFound();
			}
			return view('Backend/crips/v_edit', $data);
		}

		$fields = [
			'kode_criteria' => $this->request->getPost('kode_criteria'),
			'nama_crips' => $this->request->getPost('nama_crips'),
			'nilai' => $this->request->getPost('nilai'),
		];

		$this->cripsModel->ubah($fields, $ID);
		session()->setFlashdata('msg', 'success-ubah');
		return redirect()->to(base_url('Backend/crips'));
	}

	public function delete($ID = null)
	{
		$this->cripsModel->hapus($ID);
		session()->setFlashdata('msg', 'success-hapus');
		return redirect()->to(base_url('Backend/crips'));
	}

	public function cetak($search = '')
	{
		$data['rows'] = $this->cripsModel->tampil($search);
		return \App\Helpers\view_cetak('Backend/crips/cetak', $data);
	}
}
