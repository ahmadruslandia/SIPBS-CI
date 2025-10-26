<?php
class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->helper('text');
		$this->load->model('backend/alternative_model');
	}
	function index()
	{
		$data['rows'] = $this->alternative_model->tampil();
		$this->load->view('backend/v_dashboard', $data);
	}
	public function chart_data()
	{
		$data = $this->chart_model->chart_database();
		echo json_encode($data);
	}
}
