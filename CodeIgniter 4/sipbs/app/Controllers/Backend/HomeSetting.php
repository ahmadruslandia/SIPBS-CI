<?php

namespace App\Controllers\Backend;

use App\Models\Backend\SettingModel;

use CodeIgniter\Controller;

class HomeSetting extends Controller
{
	protected $settingModel;

	protected $session;
	protected $upload;
	protected $uploadPath = './theme/images/';

	function __construct()
	{
		helper(['url', 'text', 'form']);

		$this->settingModel = new SettingModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data = $this->settingModel->getHomeData();
		$x['home_id'] = $data->home_id;
		$x['caption_1'] = $data->home_caption_1;
		$x['caption_2'] = $data->home_caption_2;
		$x['image_heading'] = $data->home_bg_heading;
		$x['image_testimonial'] = $data->home_bg_testimonial;
		return view('Backend/v_home_setting', $x);
	}

	public function update()
	{
		$home_id = htmlspecialchars($this->request->getPost('home_id', FILTER_SANITIZE_STRING));
		$caption1 = htmlspecialchars($this->request->getPost('caption1', FILTER_SANITIZE_STRING));
		$caption2 = htmlspecialchars($this->request->getPost('caption2', FILTER_SANITIZE_STRING));

		$img_heading = $this->request->getFile('img_heading');
		$img_testimonial = $this->request->getFile('img_testimonial');
		$bg_heading = null;
		$bg_testimoni = null;

		if ($img_heading->isValid() && !$img_heading->hasMoved()) {
			$img_heading->move($this->uploadPath);
			$bg_heading = $img_heading->getName();
		}

		if ($img_testimonial->isValid() && !$img_testimonial->hasMoved()) {
			$img_testimonial->move($this->uploadPath);
			$bg_testimoni = $img_testimonial->getName();
		}

		if ($bg_heading && $bg_testimoni) {
			$this->settingModel->updateInformation($home_id, $caption1, $caption2, $bg_heading, $bg_testimoni);
		} elseif ($bg_heading) {
			$this->settingModel->updateInformationHeading($home_id, $caption1, $caption2, $bg_heading);
		} elseif ($bg_testimoni) {
			$this->settingModel->updateInformationTestimoni($home_id, $caption1, $caption2, $bg_testimoni);
		} else {
			$this->settingModel->updateInformationNoImg($home_id, $caption1, $caption2);
		}

		$this->upload = \Config\Services::image();

		session()->setFlashdata('msg', 'success');
		return redirect()->to(base_url('Backend/homesetting'));
	}
}
