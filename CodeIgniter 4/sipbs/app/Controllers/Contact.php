<?php

namespace App\Controllers;

use App\Models\ContactModel;
use App\Models\VisitorModel;

use CodeIgniter\Controller;

class Contact extends Controller
{
	protected $contactModel;
	protected $visitorModel;

	public function __construct()
	{
		$this->contactModel = new ContactModel();
		$this->visitorModel = new VisitorModel();

		$this->visitorModel->countVisitor();
	}

	public function index()
	{
		$db = \Config\Database::connect();

		$siteInfo = $db->table('tbl_site')->get()->getRow();
		$v['logo'] = $siteInfo->site_logo_header;
		$data['icon'] = $siteInfo->site_favicon;
		$data['header'] = view('Header', $v);
		$data['footer'] = view('Footer');

		$session = session();
		$data['msg'] = $session->getFlashdata('msg');

		return view('ContactView', $data);
	}

	public function send()
	{
		$validation =  \Config\Services::validation();
		$validation->setRules([
			'name' => [
				'label' => 'Name',
				'rules' => 'required|min_length[3]|max_length[40]|htmlspecialchars'
			],
			'email' => [
				'label' => 'Email',
				'rules' => 'required|valid_email'
			],
			'subject' => [
				'label' => 'Subject',
				'rules' => 'required|min_length[3]|max_length[100]|htmlspecialchars'
			],
			'message' => [
				'label' => 'Message',
				'rules' => 'required'
			],
		]);

		if (!$this->validate($validation->getRules())) {
			session()->setFlashdata('msg', '<div class="alert alert-danger">Mohon masukkan input yang Valid!</div>');
			return redirect()->to('contact');
		} else {
			$name = $this->request->getPost('name');
			$email = $this->request->getPost('email');
			$subject = $this->request->getPost('subject');
			$message = strip_tags(htmlspecialchars($this->request->getPost('message'), ENT_QUOTES));
			$this->contactModel->saveMessage($name, $email, $subject, $message);
			session()->setFlashdata('msg', '<div class="alert alert-info">Terima kasih telah menghubungi kami, pesan Anda akan segera kami proses.</div>');
			return redirect()->to('contact');
		}
	}
}
