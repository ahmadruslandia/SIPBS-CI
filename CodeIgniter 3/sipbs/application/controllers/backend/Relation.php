<?php
class Relation extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('backend/relation_model');
		$this->load->model('backend/criteria_model');
		$this->load->model('backend/crips_model');
	}

	public function index()
	{
		$this->load->helper('form');
		$data['rows'] = $this->relation_model->tampil($this->input->get('search'));
		$data['title'] = 'Bobot';

		$data['criteria'] = $this->get_criteria();
		$this->load->view('backend/relation/v_read', $data);
	}

	public function edit($ID = null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('kode_crips[]', 'Crips', 'required|is_natural');

		$data['title'] = 'Ubah Bobot ';

		if ($this->form_validation->run() === FALSE) {
			$data['rows'] = $this->relation_model->get_relation($ID);

			if ($data['rows']) {
				$data['title'] .= $data['rows'][0]->nama_alternative;
			}

			$this->load->view('backend/relation/v_edit', $data);
		} else {
			$this->relation_model->ubah($this->input->post('kode_crips'));
			echo $this->session->set_flashdata('msg', 'success-ubah');
			redirect('backend/relation');
		}
	}

	public function get_criteria()
	{
		$arr = array();
		$rows = $this->criteria_model->tampil();
		foreach ($rows as $row) {
			$arr[$row->kode_criteria] = $row;
		}
		return $arr;
	}
}
