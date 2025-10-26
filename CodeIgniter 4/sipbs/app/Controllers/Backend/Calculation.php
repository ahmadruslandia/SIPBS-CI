<?php

namespace App\Controllers\Backend;

use App\Models\Backend\AlternativeModel;
use App\Models\Backend\CalculationModel;
use App\Models\Backend\CriteriaModel;
use App\Models\Backend\CripsModel;
use App\Models\Backend\RelationModel;

use CodeIgniter\Controller;

class Calculation extends Controller
{
	protected $alternativeModel;
	protected $calculationModel;
	protected $criteriaModel;
	protected $cripsModel;
	protected $relationModel;

	protected $session;

	protected $crips = [];
	protected $alternative = [];
	protected $criteria = [];
	protected $matriks = [];
	protected $normal = [];
	protected $hasil = [];
	protected $total = [];
	protected $rank = [];

	public function __construct()
	{
		helper(['url', 'text', 'my']);

		$this->alternativeModel = new AlternativeModel();
		$this->calculationModel = new CalculationModel();
		$this->criteriaModel = new CriteriaModel();
		$this->cripsModel = new CripsModel();
		$this->relationModel = new RelationModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function topsis()
	{
		$data['title'] = 'Perhitungan TOPSIS';
		$data['rows'] = $this->calculationModel->getData();
		$data['criteria'] = $this->criteriaModel->getArray();
		$data['alternative'] = $this->alternativeModel->getArray();
		$data['crips'] = $this->cripsModel->getArray();
		$data['rel_alternative'] = $this->relationModel->getArray();

		$data['atribut'] = [];
		$data['bobot'] = [];

		foreach ($data['criteria'] as $row) {
			$data['atribut'][$row['kode_criteria']] = $row['atribut'];
			$data['bobot'][$row['kode_criteria']] = $row['bobot'];
		}

		$data['rel_nilai'] = $this->relationModel->getRelNilai($data['rel_alternative'], $data['crips']);
		$data['topsis'] = new \App\Helpers\TOPSIS($data['rel_nilai'], $data['atribut'], $data['bobot']);

		return view('Backend/methods/v_topsis', $data);
	}

	public function vikor()
	{
		$data['title'] = 'Perhitungan VIKOR';
		$data['rows'] = $this->calculationModel->getData();
		$data['criteria'] = $this->criteriaModel->getArray();
		$data['alternative'] = $this->alternativeModel->getArray();
		$data['crips'] = $this->cripsModel->getArray();
		$data['rel_alternative'] = $this->relationModel->getArray();

		$data['atribut'] = [];
		$data['bobot'] = [];

		foreach ($data['criteria'] as $row) {
			$data['atribut'][$row['kode_criteria']] = $row['atribut'];
			$data['bobot'][$row['kode_criteria']] = $row['bobot'];
		}

		$data['rel_nilai'] = $this->relationModel->getRelNilai($data['rel_alternative'], $data['crips']);
		$data['vikor'] = new \App\Helpers\VIKOR($data['rel_nilai'], $data['atribut'], $data['bobot']);

		echo view('Backend/methods/v_vikor', $data);
	}

	public function topsis_cetak()
	{
		$data['title'] = 'Perhitungan TOPSIS';
		$data['criteria'] = $this->criteriaModel->getArray();
		$data['alternative'] = $this->alternativeModel->getArray();
		$data['crips'] = $this->cripsModel->getArray();
		$data['rel_alternative'] = $this->relationModel->getArray();

		$data['atribut'] = [];
		$data['bobot'] = [];

		foreach ($data['criteria'] as $row) {
			$data['atribut'][$row['kode_criteria']] = $row['atribut'];
			$data['bobot'][$row['kode_criteria']] = $row['bobot'];
		}

		$data['rel_nilai'] = $this->relationModel->getRelNilai($data['rel_alternative'], $data['crips']);
		$data['topsis'] = new \App\Helpers\TOPSIS($data['rel_nilai'], $data['atribut'], $data['bobot']);

		return \App\Helpers\view_cetak('Backend/methods/topsis_cetak', $data);
	}

	public function vikor_cetak()
	{
		$data['title'] = 'Perhitungan VIKOR';
		$data['criteria'] = $this->criteriaModel->getArray();
		$data['alternative'] = $this->alternativeModel->getArray();
		$data['crips'] = $this->cripsModel->getArray();
		$data['rel_alternative'] = $this->relationModel->getArray();

		$data['atribut'] = [];
		$data['bobot'] = [];

		foreach ($data['criteria'] as $row) {
			$data['atribut'][$row['kode_criteria']] = $row['atribut'];
			$data['bobot'][$row['kode_criteria']] = $row['bobot'];
		}

		$data['rel_nilai'] = $this->relationModel->getRelNilai($data['rel_alternative'], $data['crips']);
		$data['vikor'] = new \App\Helpers\VIKOR($data['rel_nilai'], $data['atribut'], $data['bobot']);

		return \App\Helpers\view_cetak('Backend/methods/vikor_cetak', $data);
	}

	public function hasil_cetak()
	{
		$data['rows'] = $this->alternativeModel->tampil();
		$data['title'] = 'Hasil Perbandingan Metode';

		return \App\Helpers\view_cetak('Backend/methods/hasil_cetak', $data);
	}
}
