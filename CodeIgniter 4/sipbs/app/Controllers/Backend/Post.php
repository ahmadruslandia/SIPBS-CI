<?php

namespace App\Controllers\Backend;

use App\Models\Backend\TagModel;
use App\Models\Backend\CategoryModel;
use App\Models\Backend\PostModel;

use CodeIgniter\Controller;

class Post extends Controller
{
	protected $tagModel;
	protected $categoryModel;
	protected $postModel;

	protected $session;
	protected $imageLib;

	public function __construct()
	{
		helper(['url', 'form']);

		$this->tagModel = new TagModel();
		$this->categoryModel = new CategoryModel();
		$this->postModel = new PostModel();

		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['data'] = $this->postModel->getAllPost();
		return view('Backend/v_post', $data);
	}

	public function add_new()
	{
		$data['tag'] = $this->tagModel->getAllTag();
		$data['category'] = $this->categoryModel->getAllCategory();
		return view('Backend/v_add_post', $data);
	}

	public function get_edit($post_id)
	{
		$data['tag'] = $this->tagModel->getAllTag();
		$data['category'] = $this->categoryModel->getAllCategory();
		$data['data'] = $this->postModel->getPostById($post_id);
		return view('Backend/v_edit_post', $data);
	}

	public function publish()
	{
		$file = $this->request->getFile('filefoto');

		if ($file && $file->isValid()) {
			$newName = $file->getRandomName();
			$file->move('./assets/images', $newName);
			$imagePath = './assets/images/' . $newName;

			\Config\Services::image()
				->withFile($imagePath)
				->resize(500, 320, true)
				->save($imagePath, 60);

			$this->_create_thumbs($newName);

			$image = $newName;
			$title = strip_tags(htmlspecialchars($this->request->getPost('title'), ENT_QUOTES));
			$contents = $this->request->getPost('contents');
			$category = $this->request->getPost('category', FILTER_SANITIZE_STRING);

			$preslug = strip_tags(htmlspecialchars($this->request->getPost('slug'), ENT_QUOTES));
			$slug = url_title($preslug, '-', true);

			if ($this->postModel->isSlugExists($slug)) {
				$slug .= '-' . rand();
			}

			$tags = implode(",", (array)$this->request->getPost('tag'));
			$description = htmlspecialchars($this->request->getPost('description'), ENT_QUOTES);

			$this->postModel->save_post($title, $contents, $category, $slug, $image, $tags, $description);
			$this->session->setFlashdata('msg', 'success');
			return redirect()->to('Backend/post');
		} else {
			$this->session->setFlashdata('msg', 'warning');
			return redirect()->to('Backend/post');
		}
	}

	public function edit()
	{
		$file = $this->request->getFile('filefoto');
		$id = $this->request->getPost('post_id', FILTER_SANITIZE_NUMBER_INT);
		$title = strip_tags(htmlspecialchars($this->request->getPost('title'), ENT_QUOTES));
		$contents = $this->request->getPost('contents');
		$category = $this->request->getPost('category', FILTER_SANITIZE_STRING);

		$preslug = strip_tags(htmlspecialchars($this->request->getPost('slug'), ENT_QUOTES));
		$slug = url_title($preslug, '-', true);

		if ($this->postModel->isSlugExists($slug)) {
			$slug .= '-' . rand();
		}

		$tags = implode(",", (array)$this->request->getPost('tag'));
		$description = htmlspecialchars($this->request->getPost('description'), ENT_QUOTES);

		if ($file && $file->isValid()) {
			$newName = $file->getRandomName();
			$file->move('./assets/images', $newName);
			$imagePath = './assets/images/' . $newName;

			\Config\Services::image()
				->withFile($imagePath)
				->resize(500, 320, true)
				->save($imagePath, 60);

			$this->_create_thumbs($newName);
			$image = $newName;

			$this->postModel->edit_post_with_img($id, $title, $contents, $category, $slug, $image, $tags, $description);
		} else {
			$this->postModel->edit_post_no_img($id, $title, $contents, $category, $slug, $tags, $description);
		}

		$this->session->setFlashdata('msg', 'info');
		return redirect()->to('Backend/post');
	}

	public function delete()
	{
		$post_id = $this->request->getPost('id', FILTER_SANITIZE_NUMBER_INT);
		$this->postModel->delete_post($post_id);
		$this->session->setFlashdata('msg', 'success-delete');
		return redirect()->to('Backend/post');
	}

	public function upload_image()
	{
		$file = $this->request->getFile('file');

		if ($file && $file->isValid()) {
			$newName = $file->getRandomName();
			$file->move('./assets/images', $newName);
			$imagePath = './assets/images/' . $newName;

			\Config\Services::image()
				->withFile($imagePath)
				->resize(800, 800, true)
				->save($imagePath, 60);

			echo base_url('assets/images/' . $newName);
		}
	}

	private function _create_thumbs($file_name)
	{
		$thumbPath = './assets/images/thumb/' . $file_name;

		\Config\Services::image()
			->withFile('./assets/images/' . $file_name)
			->resize(370, 237, true)
			->save($thumbPath, 60);
	}
}
