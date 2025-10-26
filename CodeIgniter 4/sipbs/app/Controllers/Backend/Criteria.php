<?php

namespace App\Controllers\Backend;

use App\Models\Backend\CriteriaModel;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Controller;


class Criteria extends Controller
{
	protected $criteriaModel;

	protected $session;

	public function __construct()
	{
		$this->criteriaModel = new CriteriaModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['rows'] = $this->criteriaModel->tampil();
		return view('Backend/criteria/v_read', $data);
	}

	public function add()
	{
		$data['title'] = 'Tambah Kriteria';

		if (!$this->validate([
			'kode' => 'required|is_unique[tb_criteria.kode_criteria]',
			'nama' => 'required',
			'atribut' => 'required',
			'bobot' => 'required',
		])) {
			return view('Backend/criteria/v_add', $data);
		}

		$fields = [
			'kode_criteria' => $this->request->getPost('kode'),
			'nama_criteria' => $this->request->getPost('nama'),
			'atribut' => $this->request->getPost('atribut'),
			'bobot' => $this->request->getPost('bobot'),
		];

		$this->criteriaModel->tambah($fields);
		session()->setFlashdata('msg', 'success');
		return redirect()->to(base_url('Backend/criteria'));
	}

	public function edit($ID = null)
	{
		$data['title'] = 'Ubah Kriteria';

		if (!$this->validate([
			'nama' => 'required',
			'atribut' => 'required',
			'bobot' => 'required',
		])) {
			$data['rowl'] = $this->criteriaModel->getCriteria($ID);
			if (!$data['rowl']) {
				throw PageNotFoundException::forPageNotFound();
			}
			return view('Backend/criteria/v_edit', $data);
		}

		$fields = [
			'nama_criteria' => $this->request->getPost('nama'),
			'atribut' => $this->request->getPost('atribut'),
			'bobot' => $this->request->getPost('bobot'),
		];

		$this->criteriaModel->ubah($fields, $ID);
		session()->setFlashdata('msg', 'success-ubah');
		return redirect()->to(base_url('Backend/criteria'));
	}

	public function delete($ID = null)
	{
		$this->criteriaModel->hapus($ID);
		session()->setFlashdata('msg', 'success-hapus');
		return redirect()->to(base_url('Backend/criteria'));
	}

	public function cetak($search = '')
	{
		$data['rows'] = $this->criteriaModel->tampil($search);
		return \App\Helpers\view_cetak('Backend/criteria/cetak', $data);
	}
}
