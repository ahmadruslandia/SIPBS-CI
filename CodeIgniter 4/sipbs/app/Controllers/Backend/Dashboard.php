<?php

namespace App\Controllers\Backend;

use App\Models\Backend\AlternativeModel;
use App\Models\ChartModel;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
	protected $alternativeModel;
	protected $chartModel;

	protected $session;

	public function __construct()
	{
		$this->alternativeModel = new AlternativeModel();
		$this->chartModel = new ChartModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['rows'] = $this->alternativeModel->tampil();
		return view('Backend/v_dashboard', $data);
	}

	public function chart_data()
	{
		$data = $this->chartModel->chartDatabase();
		return $this->response->setJSON($data);
	}
}
