<?php

namespace App\Controllers\Backend;

use App\Models\Backend\RelationModel;
use App\Models\Backend\CriteriaModel;
use App\Models\Backend\CripsModel;

use CodeIgniter\Controller;

class Relation extends Controller
{
	protected $relationModel;
	protected $criteriaModel;
	protected $cripsModel;

	protected $session;

	public function __construct()
	{
		$this->relationModel = new RelationModel();
		$this->criteriaModel = new CriteriaModel();
		$this->cripsModel = new CripsModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['rows'] = $this->relationModel->tampil($this->request->getGet('search'));
		$data['title'] = 'Bobot';
		$data['criteria'] = $this->getCriteria();

		return view('Backend/relation/v_read', $data);
	}

	public function edit($ID = null)
	{
		$data['title'] = 'Ubah Bobot ';

		if (!$this->validate([
			'kode_crips.*' => 'required|is_natural'
		])) {
			$data['rows'] = $this->relationModel->getRelation($ID);

			if ($data['rows']) {
				$data['title'] .= $data['rows'][0]->nama_alternative;
			}

			return view('backend/relation/v_edit', $data);
		} else {
			$this->relationModel->ubah($this->request->getPost('kode_crips'));
			session()->setFlashdata('msg', 'success-ubah');

			return redirect()->to(base_url('backend/relation'));
		}
	}

	public function getCriteria()
	{
		$arr = [];
		$rows = $this->criteriaModel->tampil();
		foreach ($rows as $row) {
			$arr[$row['kode_criteria']] = $row;
		}
		return $arr;
	}
}
