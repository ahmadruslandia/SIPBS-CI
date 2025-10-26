<?php

namespace App\Controllers\Backend;

use App\Models\Backend\InboxModel;

use CodeIgniter\Controller;

class Inbox extends Controller
{
	protected $inboxModel;

	protected $pager;
	protected $session;

	public function __construct()
	{
		helper(['url', 'form', 'text']);

		$this->inboxModel = new InboxModel();

		$this->pager = \Config\Services::pager();
		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$count = $this->inboxModel->countAll();
		$page = $this->request->getVar('page') ?? 1;
		$offset = !$page ? 0 : $page;
		$limit = 10;

		$data = [
			'page' => $this->pager->makeLinks($page, $limit, $count, 'default_full', 1),
			'data' => $this->inboxModel->getAllInbox($offset, $limit),
		];

		return view('Backend/v_inbox', $data);
	}

	public function read($inbox_id = null)
	{
		$inbox_id = htmlspecialchars($inbox_id, ENT_QUOTES);
		$result = $this->inboxModel->getInboxById($inbox_id);

		if ($result) {
			$data = [
				'name' => $result['inbox_name'],
				'email' => $result['inbox_email'],
				'subject' => $result['inbox_subject'],
				'message' => $result['inbox_message'],
				'date' => $result['inbox_created_at'],
			];
			$this->inboxModel->updateStatusById($inbox_id);
			return view('Backend/v_inbox_detail', $data);
		} else {
			return redirect()->to(base_url('Backend/inbox'));
		}
	}

	public function result()
	{
		$keyword = htmlspecialchars($this->request->getGet('search_query'), ENT_QUOTES);
		$data = $this->inboxModel->searchInbox($keyword);

		if ($data) {
			return view('Backend/v_inbox', ['data' => $data]);
		} else {
			session()->setFlashdata('msg', 'info');
			return redirect()->to(base_url('Backend/inbox'));
		}
	}

	public function delete()
	{
		$inbox_id = $this->request->getPost('id');
		$this->inboxModel->deleteInbox($inbox_id);
		session()->setFlashdata('msg', 'success');
		return redirect()->to(base_url('Backend/inbox'));
	}
}
