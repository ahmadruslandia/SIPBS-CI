<?php

namespace App\Controllers\Backend;

use App\Models\Backend\CommentModel;

use CodeIgniter\Controller;

class Comment extends Controller
{
	protected $commentModel;

	protected $pager;
	protected $session;

	public function __construct()
	{
		$this->commentModel = new CommentModel();

		$this->pager = \Config\Services::pager();
		$this->session = \Config\Services::session();

		if (!$this->session->get('logged')) {
			return redirect()->to(base_url('administrator'));
		}
	}

	public function index()
	{
		$data['data'] = $this->commentModel->getAllComment($this->request->getVar('page') ?? 0, 10);
		$data['total_rows'] = $this->commentModel->countAllResults();
		$data['total_unpublish'] = $this->commentModel->where('comment_status', '0')->countAllResults();
		$data['page'] = $this->pager->makeLinks(1, 10, $data['total_rows'], 'default_full');

		return view('Backend/v_comment', $data);
	}

	public function upload_image()
	{
		if ($file = $this->request->getFile('file')) {
			$file->move('./assets/images');
			if (!$file->hasMoved()) {
				return false;
			}

			$imagePath = './assets/images/' . $file->getName();
			\Config\Services::image()
				->withFile($imagePath)
				->resize(600, 488, true, 'height')
				->save($imagePath, 60);

			echo base_url('assets/images/' . $file->getName());
		}
	}

	public function reply()
	{
		$post_id = htmlspecialchars($this->request->getPost('post_id'), ENT_QUOTES);
		$comment_id = htmlspecialchars($this->request->getPost('comment_id'), ENT_QUOTES);
		$comments = $this->request->getPost('comments');
		$user_id = session()->get('id');

		$db = \Config\Database::connect();
		$query = $db->table('tbl_user')->where('user_id', $user_id)->get();

		if ($query->getNumRows() > 0) {
			$b = $query->getRowArray();
			$user_name = $b['user_name'];
			$user_email = $b['user_email'];

			$this->commentModel->replyComment($post_id, $comment_id, $comments, $user_id, $user_name, $user_email);

			session()->setFlashdata('msg', 'success');
			return redirect()->to('Backend/comment');
		} else {
			session()->setFlashdata('msg', 'error');
			return redirect()->to('Backend/comment');
		}
	}


	public function publish()
	{
		$comment_id = $this->request->getPost('comment_id4');
		$this->commentModel->publishComment($comment_id);
		session()->setFlashdata('msg', 'success-publish');
		return redirect()->to('Backend/comment');
	}

	public function edit()
	{
		$comment_id = $this->request->getPost('comment_id2');
		$comments = $this->request->getPost('comments2');
		$this->commentModel->editComment($comment_id, $comments);
		session()->setFlashdata('msg', 'success-edit');
		return redirect()->to('Backend/comment');
	}

	public function delete()
	{
		$comment_id = $this->request->getPost('comment_id3');
		$this->commentModel->deleteComment($comment_id);
		session()->setFlashdata('msg', 'success-delete');
		return redirect()->to('Backend/comment');
	}

	public function change()
	{
		if ($file = $this->request->getFile('file')) {
			$file->move('./assets/images', $file->getRandomName());
			$imagePath = './assets/images/' . $file->getName();
			\Config\Services::image()
				->withFile($imagePath)
				->resize(90, 90, true, 'height')
				->save($imagePath, 60);

			$id = $this->request->getPost('comment_id5');
			$name = $this->request->getPost('name');
			$email = $this->request->getPost('email');
			$this->commentModel->change_image($id, $name, $email, $file->getName());

			session()->setFlashdata('msg', 'success-change');
			return redirect()->to('Backend/comment');
		}
	}

	public function results()
	{
		$keyword = $this->request->getGet('search_query');
		$data = $this->commentModel->search_comment($keyword);

		if ($data->getNumRows() > 0) {
			return view('Backend/v_comment', [
				'data' => $data,
				'total_rows' => $data->getNumRows()
			]);
		} else {
			session()->setFlashdata('msg', 'info');
			return redirect()->to('Backend/comment');
		}
	}

	public function unpublish()
	{
		$data['data'] = $this->commentModel->getAllCommentsUnpublished($this->request->getVar('page') ?? 0, 10);
		$data['total_rows'] = $this->commentModel->where('comment_status', '0')->countAllResults();
		$data['total_all'] = $this->commentModel->where('comment_parent', '0')->countAllResults();
		$data['page'] = $this->pager->makeLinks(1, 10, $data['total_rows'], 'default_full');

		return view('Backend/v_comment_unpublish', $data);
	}
}
