<?php

namespace App\Controllers\Backend;

use App\Models\Backend\TagModel;

use CodeIgniter\Controller;

class Tag extends Controller
{
	protected $tagModel;

	protected $session;

	public function __construct()
	{
		helper('text');

		$this->tagModel = new TagModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['data'] = $this->tagModel->findAll();
		return view('Backend/v_tag', $data);
	}

	public function save()
	{
		$tag = strip_tags(htmlspecialchars($this->request->getPost('tag'), ENT_QUOTES));
		$this->tagModel->insert(['tag_name' => $tag]);
		session()->setFlashdata('msg', 'success');
		return redirect()->to(base_url('Backend/tag'));
	}

	public function edit()
	{
		$id = $this->request->getPost('kode');
		$tag = strip_tags(htmlspecialchars($this->request->getPost('tag2'), ENT_QUOTES));
		$this->tagModel->update($id, ['tag_name' => $tag]);
		session()->setFlashdata('msg', 'info');
		return redirect()->to(base_url('Backend/tag'));
	}

	public function delete()
	{
		$id = $this->request->getPost('id');
		$this->tagModel->delete($id);
		session()->setFlashdata('msg', 'success-delete');
		return redirect()->to(base_url('Backend/tag'));
	}
}
