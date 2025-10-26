<?php

namespace App\Controllers;

use App\Models\BlogModel;
use App\Models\VisitorModel;
use App\Models\HomeModel;
use App\Models\SiteModel;

use CodeIgniter\Controller;

class Blog extends Controller
{
	protected $blogModel;
	protected $visitorModel;
	protected $homeModel;
	protected $siteModel;

	protected $pagination;
	protected $pager;


	public function __construct()
	{
		helper('text');

		$this->blogModel = new BlogModel();
		$this->visitorModel = new VisitorModel();
		$this->homeModel = new HomeModel();
		$this->siteModel = new SiteModel();

		$this->visitorModel->countVisitor();

		$this->pager = \Config\Services::pager();
	}

	public function index()
	{
		$totalBlogs = $this->blogModel->getBlogs()->getNumRows();
		$page = $this->request->getVar('page') ?? 1;
		$limit = 9;
		$offset = ($page - 1) * $limit;

		$this->pager->setPath('blog/page');
		$pagination = $this->pager->makeLinks($page, $limit, $totalBlogs);

		$data['blogs'] = $this->blogModel->getBlogPerPage($offset, $limit)->getResult();
		$data['pagination'] = $pagination;
		$data['judul'] = "Blog";

		if ($page == 1) {
			$data['canonical'] = site_url('blog');
			$data['url_prev'] = "";
			$data['url_next'] = site_url('blog/page/2');
		} elseif ($page == 2) {
			$data['canonical'] = site_url('blog/page/2');
			$data['url_prev'] = site_url('blog');
			$data['url_next'] = site_url('blog/page/3');
		} else {
			$prev_page = $page - 1;
			$next_page = $page + 1;
			$data['canonical'] = site_url('blog/page/' . $page);
			$data['url_prev'] = site_url('blog/page/' . $prev_page);
			$data['url_next'] = site_url('blog/page/' . $next_page);
		}

		$data['popular_posts'] = $this->blogModel->getPopularPost()->getResult();

		$db = \Config\Database::connect();
		$siteInfo = $db->table('tbl_site')->get(1)->getRow();
		$data['site_image'] = $siteInfo->site_logo_big;
		$data['site_name'] = $siteInfo->site_name;
		$v['logo'] = $siteInfo->site_logo_header;
		$data['icon'] = $siteInfo->site_favicon;
		$data['header'] = view('Header', $v);
		$data['footer'] = view('Footer');

		return view('BlogView', $data);
	}

	public function detail($slug)
	{
		$data = $this->blogModel->getPostBySlug($slug)->getRowArray();
		if (!empty($data)) {
			$q = $data;
			$kode = $q['post_id'];
			$data['title'] = $q['post_title'];
			if (empty($q['post_description'])) {
				helper('text');
				$data['description'] = strip_tags(word_limiter($q['post_contents'], 25));
			} else {
				$data['description'] = $q['post_description'];
			}
			$data['image'] = $q['post_image'];
			$data['slug'] = $q['post_slug'];
			$data['content'] = $q['post_contents'];
			$data['views'] = $q['post_views'];
			$data['comment'] = $q['comment_total'];
			$data['author'] = $q['user_name'];
			$data['category'] = $q['category_name'];
			$data['category_slug'] = $q['category_slug'];
			$data['date'] = $q['post_date'];
			$data['tags'] = $q['post_tags'];
			$data['post_id'] = $kode;
			$category_id = $q['category_id'];
			$this->blogModel->countViews($kode);
			$data['related_post'] = $this->blogModel->getRelatedPost($category_id, $kode);
			$data['show_comments'] = $this->blogModel->showComments($kode);

			$session = session();
			$data['msg'] = $session->getFlashdata('msg');

			$db = \Config\Database::connect();
			$siteInfo = $db->table('tbl_site')->get(1)->getRow();
			$data['site_name'] = $siteInfo->site_name;
			$v['logo'] = $siteInfo->site_logo_header;
			$data['icon'] = $siteInfo->site_favicon;
			$data['header'] = view('Header', $v);
			$data['footer'] = view('Footer');
			return view('BlogDetailView', $data);
		} else {
			return redirect()->to('/blog');
		}
	}


	public function submit_comment()
	{
		$post_id = htmlspecialchars($this->request->getPost('post_id'), ENT_QUOTES);
		$slug = htmlspecialchars($this->request->getPost('slug'), ENT_QUOTES);

		$validation = \Config\Services::validation();
		$validation->setRules([
			'name' => 'required|min_length[3]|max_length[40]|htmlspecialchars',
			'email' => 'required|valid_email',
			'comment' => 'required'
		]);

		if (!$validation->withRequest($this->request)->run()) {
			session()->setFlashdata('msg', '<div class="alert alert-danger">Mohon masukkan input yang Valid!</div>');
			return redirect()->to(site_url('blog/' . $slug));
		} else {
			$name = htmlspecialchars($this->request->getPost('name'), ENT_QUOTES);
			$email = htmlspecialchars($this->request->getPost('email'), ENT_QUOTES);
			$comment = htmlspecialchars($this->request->getPost('comment'), ENT_QUOTES);

			$this->blogModel->saveComment($post_id, $name, $email, $comment);

			session()->setFlashdata('msg', '<div class="alert alert-info">Terima kasih atas respon Anda, komentar Anda akan tampil setelah moderasi</div>');
			return redirect()->to(site_url('blog/' . $slug));
		}
	}
}
