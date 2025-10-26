<?php

namespace App\Controllers\Backend;

use App\Models\Backend\SettingModel;

use CodeIgniter\Controller;

class AboutSetting extends Controller
{
	protected $settingModel;

	protected $session;

	public function __construct()
	{
		$this->settingModel = new SettingModel();

		$this->session = \Config\Services::session();
	}

	public function index()
	{
		$data = $this->settingModel->getAboutData();

		$viewData = [
			'about_id' => $data->about_id ?? null,
			'about_img' => $data->about_image ?? '',
			'about_desc' => $data->about_description ?? '',
		];

		return view('Backend/v_about_setting', $viewData);
	}

	public function update()
	{
		$about_id = htmlspecialchars($this->request->getPost('about_id'), ENT_QUOTES);
		$description = $this->request->getPost('description');

		$file = $this->request->getFile('img_about');
		$uploadPath = ROOTPATH . 'public/theme/images/';

		if ($file && $file->isValid() && !$file->hasMoved()) {
			$newName = $file->getName();
			$file->move($uploadPath, $newName);
			$image = $newName;

			$this->settingModel->updateInformationAbout($about_id, $description, $image);
		} else {
			$this->settingModel->updateInformationAboutNoimg($about_id, $description);
		}

		session()->setFlashdata('msg', 'success');
		return redirect()->to(base_url('Backend/aboutsetting'));
	}
}
