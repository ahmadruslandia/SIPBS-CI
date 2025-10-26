<?php

namespace App\Controllers\Backend;

use App\Models\SiteModel;

use CodeIgniter\Controller;

class Settings extends Controller
{
	protected $siteModel;

	public function __construct()
	{
		helper(['url', 'text']);

		$this->siteModel = new SiteModel();
	}

	public function index()
	{
		$result = $this->siteModel->getSiteData();

		$data = [
			'site_id' => $result['site_id'] ?? null,
			'site_name' => $result['site_name'] ?? '',
			'site_title' => $result['site_title'] ?? '',
			'site_description' => $result['site_description'] ?? '',
			'site_logo_header' => $result['site_logo_header'] ?? '',
			'site_favicon' => $result['site_favicon'] ?? '',
			'site_logo_big' => $result['site_logo_big'] ?? '',
			'site_facebook' => $result['site_facebook'] ?? '',
			'site_twitter' => $result['site_twitter'] ?? '',
			'site_instagram' => $result['site_instagram'] ?? '',
			'site_pinterest' => $result['site_pinterest'] ?? '',
			'site_linkedin' => $result['site_linkedin'] ?? '',
		];

		return view('Backend/v_settings', $data);
	}

	public function update()
	{
		$site_id = $this->request->getPost('site_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$site_name = $this->request->getPost('name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$site_title = $this->request->getPost('title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$site_description = $this->request->getPost('description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$facebook = $this->request->getPost('facebook', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$twitter = $this->request->getPost('twitter', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$linkedin = $this->request->getPost('linkedin', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$instagram = $this->request->getPost('instagram', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$pinterest = $this->request->getPost('pinterest', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$uploadPath = WRITEPATH . 'uploads/';
		$upload = \Config\Services::upload();

		$logo_header = $this->uploadImage('logo_header', $upload, $uploadPath);
		$logo_footer = $this->uploadImage('logo_icon', $upload, $uploadPath);
		$logo_big = $this->uploadImage('logo_big', $upload, $uploadPath);

		if ($logo_header && $logo_footer && $logo_big) {
			$this->siteModel->updateInformation($site_id, $site_name, $site_title, $site_description, $logo_header, $logo_footer, $logo_big, $facebook, $twitter, $linkedin, $instagram, $pinterest);
		} elseif ($logo_header && $logo_footer && !$logo_big) {
			$this->siteModel->updateInformationHeaderIcon($site_id, $site_name, $site_title, $site_description, $logo_header, $logo_footer, $facebook, $twitter, $linkedin, $instagram, $pinterest);
		} elseif (!$logo_header && $logo_footer && $logo_big) {
			$this->siteModel->updateInformationBigIcon($site_id, $site_name, $site_title, $site_description, $logo_big, $logo_footer, $facebook, $twitter, $linkedin, $instagram, $pinterest);
		} elseif ($logo_header && !$logo_footer && $logo_big) {
			$this->siteModel->updateInformationBigHeader($site_id, $site_name, $site_title, $site_description, $logo_big, $logo_header, $facebook, $twitter, $linkedin, $instagram, $pinterest);
		} elseif ($logo_header && !$logo_footer && !$logo_big) {
			$this->siteModel->updateInformationHeader($site_id, $site_name, $site_title, $site_description, $logo_header, $facebook, $twitter, $linkedin, $instagram, $pinterest);
		} elseif (!$logo_header && $logo_footer && !$logo_big) {
			$this->siteModel->updateInformationFooter($site_id, $site_name, $site_title, $site_description, $logo_footer, $facebook, $twitter, $linkedin, $instagram, $pinterest);
		} elseif (!$logo_header && !$logo_footer && $logo_big) {
			$this->siteModel->updateInformationBig($site_id, $site_name, $site_title, $site_description, $logo_big, $facebook, $twitter, $linkedin, $instagram, $pinterest);
		} else {
			$this->siteModel->updateInformationNologo($site_id, $site_name, $site_title, $site_description, $facebook, $twitter, $linkedin, $instagram, $pinterest);
		}

		session()->setFlashdata('msg', 'success');
		return redirect()->to('Backend/settings');
	}

	private function uploadImage($inputName, $upload, $path)
	{
		$file = $this->request->getFile($inputName);
		if ($file && $file->isValid()) {
			$file->move($path);
			return $file->getName();
		}
		return null;
	}
}
