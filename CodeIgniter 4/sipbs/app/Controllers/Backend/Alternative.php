<?php

namespace App\Controllers\Backend;

use App\Models\Backend\AlternativeModel;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Controller;

class Alternative extends Controller
{
	protected $alternativeModel;

	protected $session;

	public function __construct()
	{
		helper('my');

		$this->alternativeModel = new AlternativeModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['rows'] = $this->alternativeModel->tampil();
		return view('Backend/alternative/v_read', $data);
	}

	public function add()
	{
		$data['title'] = 'Tambah Alternatif';

		if (!$this->validate([
			'kode_alternative' => 'required|is_unique[tb_alternative.kode_alternative]',
			'nama_alternative' => 'required',
		])) {
			return view('Backend/alternative/v_add', $data);
		}

		$fields = [
			'kode_alternative' => $this->request->getPost('kode_alternative'),
			'nama_alternative' => $this->request->getPost('nama_alternative'),
			'keterangan' => $this->request->getPost('keterangan'),
			'alamat' => $this->request->getPost('alamat'),
			'nama_pengelola' => $this->request->getPost('nama_pengelola'),
			'nomor_telepon' => $this->request->getPost('nomor_telepon'),
		];

		$this->alternativeModel->tambah($fields);
		session()->setFlashdata('msg', 'success');
		return redirect()->to(base_url('Backend/alternative'));
	}

	public function edit($ID = null)
	{
		$data['title'] = 'Ubah Alternatif';

		if (!$this->validate([
			'kode_alternative' => 'required',
			'nama_alternative' => 'required',
		])) {
			$data['rowl'] = $this->alternativeModel->getAlternative($ID);
			if (!$data['rowl']) {
				throw PageNotFoundException::forPageNotFound();
			}
			return view('Backend/alternative/v_edit', $data);
		}

		$fields = [
			'kode_alternative' => $this->request->getPost('kode_alternative'),
			'nama_alternative' => $this->request->getPost('nama_alternative'),
			'keterangan' => $this->request->getPost('keterangan'),
			'alamat' => $this->request->getPost('alamat'),
			'nama_pengelola' => $this->request->getPost('nama_pengelola'),
			'nomor_telepon' => $this->request->getPost('nomor_telepon'),
		];

		$this->alternativeModel->ubah($fields, $ID);
		session()->setFlashdata('msg', 'success-ubah');
		return redirect()->to(base_url('Backend/alternative'));
	}

	public function detail($ID = null)
	{
		$data['row'] = $this->alternativeModel->getAlternative($ID);
		if (!$data['row']) {
			throw PageNotFoundException::forPageNotFound();
		}
		$data['title'] = $data['row']->nama_alternative;
		return view('Backend/alternative/detail', $data);
	}

	public function delete($ID = null)
	{
		$this->alternativeModel->hapus($ID);
		session()->setFlashdata('msg', 'success-hapus');
		return redirect()->to(base_url('Backend/alternative'));
	}

	public function cetak($search = '')
	{
		$data['rows'] = $this->alternativeModel->tampil($search);
		return \App\Helpers\view_cetak('Backend/alternative/cetak', $data);
	}
}
