<?php
class Crips extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('backend/crips_model');
		$this->load->model('backend/criteria_model');
	}

	function index()
	{
		$data['rows'] = $this->crips_model->tampil();
		$this->load->view('backend/crips/v_read', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('kode_criteria', 'Kriteria', 'required');
		$this->form_validation->set_rules('nama_crips', 'Nama Crips', 'required');
		$this->form_validation->set_rules('nilai', 'Nilai', 'required|is_natural_no_zero');

		$data['title'] = 'Tambah Crips';

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('backend/crips/v_add', $data);
		} else {
			$fields = array(
				'kode_criteria' => $this->input->post('kode_criteria'),
				'nama_crips' => $this->input->post('nama_crips'),
				'nilai' => $this->input->post('nilai'),
			);
			$this->crips_model->tambah($fields);
			echo $this->session->set_flashdata('msg', 'success');
			redirect('backend/crips');
		}
	}

	public function edit($ID = null)
	{
		$this->form_validation->set_rules('kode_criteria', 'Kriteria', 'required');
		$this->form_validation->set_rules('nama_crips', 'Nama Crips', 'required');
		$this->form_validation->set_rules('nilai', 'Nilai', 'required|is_natural_no_zero');

		$data['title'] = 'Ubah Crips';

		if ($this->form_validation->run() === FALSE) {
			$data['rowl'] = $this->crips_model->get_crips($ID);
			$this->load->view('backend/crips/v_edit', $data);
		} else {
			$fields = array(
				'kode_criteria' => $this->input->post('kode_criteria'),
				'nama_crips' => $this->input->post('nama_crips'),
				'nilai' => $this->input->post('nilai'),
			);
			$this->crips_model->ubah($fields, $ID);
			echo $this->session->set_flashdata('msg', 'success-ubah');
			redirect('backend/crips');
		}
	}

	public function delete($ID = null)
	{
		$this->crips_model->hapus($ID);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('backend/crips');
	}

	public function cetak($search = '')
	{
		$data['rows'] = $this->crips_model->tampil($search);
		view_cetak('backend/crips/cetak', $data);
	}
}
