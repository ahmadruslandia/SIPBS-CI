<?php

namespace App\Controllers\Backend;

use App\Models\Backend\VisitorModel;

use CodeIgniter\Controller;

class System extends Controller
{
	protected $visitorModel;

	protected $session;


	public function __construct()
	{
		$this->visitorModel = new VisitorModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$visitor = $this->visitorModel->visitorStatistics();
		$bulan = [];
		$value = [];
		foreach ($visitor as $result) {
			$bulan[] = $result->tgl;
			$value[] = (float) $result->jumlah;
		}
		$data['month'] = json_encode($bulan);
		$data['value'] = json_encode($value);

		$data['all_visitors'] = $this->visitorModel->countAllVisitors();
		$data['all_post_views'] = $this->visitorModel->countAllPageViews();
		$data['all_posts'] = $this->visitorModel->countAllPosts();
		$data['all_comments'] = $this->visitorModel->countAllComments();
		$data['top_five_articles'] = $this->visitorModel->topFiveArticles();

		$visitor_this_month = $this->visitorModel->countVisitorThisMonth()->tot_visitor ?? 0;
		$data['chrome_visitor'] = $this->calculatePercentage($this->visitorModel->countChromeVisitors()->chrome_visitor ?? 0, $visitor_this_month);
		$data['firefox_visitor'] = $this->calculatePercentage($this->visitorModel->countFirefoxVisitors()->firefox_visitor ?? 0,  $visitor_this_month);
		$data['explorer_visitor'] = $this->calculatePercentage($this->visitorModel->countExplorerVisitors()->explorer_visitor ?? 0,  $visitor_this_month);
		$data['safari_visitor'] = $this->calculatePercentage($this->visitorModel->countSafariVisitors()->safari_visitor ?? 0,  $visitor_this_month);
		$data['opera_visitor'] = $this->calculatePercentage($this->visitorModel->countOperaVisitors()->opera_visitor ?? 0,  $visitor_this_month);
		$data['robot_visitor'] = $this->calculatePercentage($this->visitorModel->countRobotVisitors()->robor_visitor ?? 0,  $visitor_this_month);
		$data['other_visitor'] = $this->calculatePercentage($this->visitorModel->countOtherVisitors()->other_visitor ?? 0,  $visitor_this_month);

		return view('Backend/v_system', $data);
	}

	private function calculatePercentage($visitor, $totalVisitors)
	{
		return ($totalVisitors > 0) ? ($visitor / $totalVisitors) * 100 : 0;
	}
}
