<?php

namespace App\Controllers\Backend;

use App\Models\Backend\CategoryModel;

use CodeIgniter\Controller;

class Category extends Controller
{
	protected $categoryModel;

	protected $session;


	public function __construct()
	{
		helper(['text']);

		$this->categoryModel = new CategoryModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['data'] = $this->categoryModel->findAll();
		return view('Backend/v_category', $data);
	}

	public function save()
	{
		$category = strip_tags(htmlspecialchars($this->request->getPost('category', TRUE), ENT_QUOTES));
		$string = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $category);
		$trim = trim($string);
		$slug = strtolower(str_replace(" ", "-", $trim));

		$this->categoryModel->addNewRow($category, $slug);
		session()->setFlashdata('msg', 'success');
		return redirect()->to('Backend/category');
	}

	public function edit()
	{
		$id = $this->request->getPost('kode', TRUE);
		$category = strip_tags(htmlspecialchars($this->request->getPost('category2', TRUE), ENT_QUOTES));
		$string = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $category);
		$trim = trim($string);
		$slug = strtolower(str_replace(" ", "-", $trim));

		$this->categoryModel->editRow($id, $category, $slug);
		session()->setFlashdata('msg', 'info');
		return redirect()->to('Backend/category');
	}

	public function delete()
	{
		$id = $this->request->getPost('id', TRUE);
		$this->categoryModel->deleteRow($id);
		session()->setFlashdata('msg', 'success-delete');
		return redirect()->to('Backend/category');
	}
}
