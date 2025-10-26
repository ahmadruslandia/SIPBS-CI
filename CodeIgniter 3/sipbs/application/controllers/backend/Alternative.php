<?php
class Alternative extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('backend/alternative_model');
	}

	function index()
	{
		$data['rows'] = $this->alternative_model->tampil();
		$this->load->view('backend/alternative/v_read', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('kode_alternative', 'Kode Alternatif', 'required|is_unique[tb_alternative.kode_alternative]');
		$this->form_validation->set_rules('nama_alternative', 'Nama Alternatif', 'required');

		$data['title'] = 'Tambah Alternatif';

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('backend/alternative/v_add', $data);
		} else {
			$fields = array(
				'kode_alternative' => $this->input->post('kode_alternative'),
				'nama_alternative' => $this->input->post('nama_alternative'),
				'keterangan' => $this->input->post('keterangan'),
				'alamat' => $this->input->post('alamat'),
				'nama_pengelola' => $this->input->post('nama_pengelola'),
				'nomor_telepon' => $this->input->post('nomor_telepon'),

			);
			$this->alternative_model->tambah($fields);
			echo $this->session->set_flashdata('msg', 'success');
			redirect('backend/alternative');
		}
	}

	public function edit($ID = null)
	{
		$this->form_validation->set_rules('kode_alternative', 'Kode Alternatif', 'required');
		$this->form_validation->set_rules('nama_alternative', 'Nama Alternatif', 'required');

		$data['title'] = 'Ubah Alternatif';

		if ($this->form_validation->run() === FALSE) {
			$data['rowl'] = $this->alternative_model->get_alternative($ID);
			$this->load->view('backend/alternative/v_edit', $data);
		} else {
			$fields = array(
				'kode_alternative' => $this->input->post('kode_alternative'),
				'nama_alternative' => $this->input->post('nama_alternative'),
				'keterangan' => $this->input->post('keterangan'),
				'alamat' => $this->input->post('alamat'),
				'nama_pengelola' => $this->input->post('nama_pengelola'),
				'nomor_telepon' => $this->input->post('nomor_telepon'),
			);
			$this->alternative_model->ubah($fields, $ID);
			echo $this->session->set_flashdata('msg', 'success-ubah');
			redirect('backend/alternative');
		}
	}


	public function detail($ID = null)
	{
		$data['row'] = $this->alternative_model->get_alternative($ID);
		$data['title'] = $data['row']->nama_alternative;
		load_view('alternative/detail', $data);
	}

	public function delete($ID = null)
	{
		$this->alternative_model->hapus($ID);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('backend/alternative');
	}

	public function cetak($search = '')
	{
		$data['rows'] = $this->alternative_model->tampil($search);
		view_cetak('backend/alternative/cetak', $data);
	}
}
