<?php
class Criteria extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('backend/criteria_model');
	}

	function index()
	{
		$data['rows'] = $this->criteria_model->tampil();
		$this->load->view('backend/criteria/v_read', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('kode', 'Kode', 'required|is_unique[tb_criteria.kode_criteria]');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('atribut', 'Atribut', 'required');
		$this->form_validation->set_rules('bobot', 'Bobot', 'required');

		$data['title'] = 'Tambah Kriteria';

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('backend/criteria/v_add', $data);
		} else {
			$fields = array(
				'kode_criteria' => $this->input->post('kode'),
				'nama_criteria' => $this->input->post('nama'),
				'atribut' => $this->input->post('atribut'),
				'bobot' => $this->input->post('bobot'),
			);
			$this->criteria_model->tambah($fields);
			echo $this->session->set_flashdata('msg', 'success');
			redirect('backend/criteria');
		}
	}

	public function edit($ID = null)
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('atribut', 'Atribut', 'required');
		$this->form_validation->set_rules('bobot', 'Bobot', 'required');

		$data['title'] = 'Ubah Kriteria';

		if ($this->form_validation->run() === FALSE) {
			$data['rowl'] = $this->criteria_model->get_criteria($ID);
			$this->load->view('backend/criteria/v_edit', $data);
		} else {
			$fields = array(
				'nama_criteria' => $this->input->post('nama'),
				'atribut' => $this->input->post('atribut'),
				'bobot' => $this->input->post('bobot'),
			);
			$this->criteria_model->ubah($fields, $ID);
			echo $this->session->set_flashdata('msg', 'success-ubah');
			redirect('backend/criteria');
		}
	}

	public function delete($ID = null)
	{
		$this->criteria_model->hapus($ID);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('backend/criteria');
	}

	public function cetak($search = '')
	{
		$data['rows'] = $this->criteria_model->tampil($search);
		view_cetak('backend/criteria/cetak', $data);
	}
}
