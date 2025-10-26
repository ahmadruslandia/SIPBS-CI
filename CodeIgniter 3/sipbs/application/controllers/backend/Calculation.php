<?php
class Calculation extends CI_Controller
{

	protected $crips = array();
	protected $alternative = array();
	protected $criteria = array();
	protected $matriks = array();
	protected $normal = array();
	protected $hasil = array();
	protected $total = array();
	protected $rank = array();

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('backend/alternative_model');
		$this->load->model('backend/calculation_model');
		$this->load->model('backend/criteria_model');
		$this->load->model('backend/alternative_model');
		$this->load->model('backend/crips_model');
		$this->load->model('backend/relation_model');
	}

	public function topsis()
	{
		$data['title'] = 'Perhitungan TOPSIS';
		$data['rows'] = $this->calculation_model->get_data();
		$data['criteria'] = $this->criteria_model->getArray();
		$data['alternative'] = $this->alternative_model->getArray();
		$data['crips'] = $this->crips_model->getArray();
		$data['rel_alternative'] = $this->relation_model->getArray();
		$data['atribut'] = array();
		$data['bobot'] = array();
		foreach ($data['criteria'] as $row) {
			$data['atribut'][$row->kode_criteria] = $row->atribut;
			$data['bobot'][$row->kode_criteria] = $row->bobot;
		}
		$data['rel_nilai'] = $this->relation_model->getRelNilai($data['rel_alternative'], $data['crips']);
		$data['topsis'] = new TOPSIS($data['rel_nilai'], $data['atribut'], $data['bobot']);

		$this->load->view('backend/methods/v_topsis', $data);
	}

	public function vikor()
	{
		$data['title'] = 'Perhitungan VIKOR';
		$data['rows'] = $this->calculation_model->get_data();
		$data['criteria'] = $this->criteria_model->getArray();
		$data['alternative'] = $this->alternative_model->getArray();
		$data['crips'] = $this->crips_model->getArray();
		$data['rel_alternative'] = $this->relation_model->getArray();
		$data['atribut'] = array();
		$data['bobot'] = array();
		foreach ($data['criteria'] as $row) {
			$data['atribut'][$row->kode_criteria] = $row->atribut;
			$data['bobot'][$row->kode_criteria] = $row->bobot;
		}
		$data['rel_nilai'] = $this->relation_model->getRelNilai($data['rel_alternative'], $data['crips']);
		$data['vikor'] = new VIKOR($data['rel_nilai'], $data['atribut'], $data['bobot']);

		$this->load->view('backend/methods/v_vikor', $data);
	}

	public function topsis_cetak()
	{
		$data['title'] = 'Perhitungan TOPSIS';
		$data['criteria'] = $this->criteria_model->getArray();
		$data['alternative'] = $this->alternative_model->getArray();
		$data['crips'] = $this->crips_model->getArray();
		$data['rel_alternative'] = $this->relation_model->getArray();
		$data['atribut'] = array();
		$data['bobot'] = array();
		foreach ($data['criteria'] as $row) {
			$data['atribut'][$row->kode_criteria] = $row->atribut;
			$data['bobot'][$row->kode_criteria] = $row->bobot;
		}
		$data['rel_nilai'] = $this->relation_model->getRelNilai($data['rel_alternative'], $data['crips']);
		$data['topsis'] = new TOPSIS($data['rel_nilai'], $data['atribut'], $data['bobot']);

		view_cetak('backend/methods/topsis_cetak', $data);
	}

	public function vikor_cetak()
	{
		$data['title'] = 'Perhitungan VIKOR';
		$data['criteria'] = $this->criteria_model->getArray();
		$data['alternative'] = $this->alternative_model->getArray();
		$data['crips'] = $this->crips_model->getArray();
		$data['rel_alternative'] = $this->relation_model->getArray();
		$data['atribut'] = array();
		$data['bobot'] = array();
		foreach ($data['criteria'] as $row) {
			$data['atribut'][$row->kode_criteria] = $row->atribut;
			$data['bobot'][$row->kode_criteria] = $row->bobot;
		}
		$data['rel_nilai'] = $this->relation_model->getRelNilai($data['rel_alternative'], $data['crips']);
		$data['vikor'] = new VIKOR($data['rel_nilai'], $data['atribut'], $data['bobot']);

		view_cetak('backend/methods/vikor_cetak', $data);
	}

	public function hasil_cetak()
	{
		$data['rows'] = $this->alternative_model->tampil();
		$data['title'] = 'Hasil Perbandingan Metode';
		view_cetak('backend/methods/hasil_cetak', $data);
	}
}
