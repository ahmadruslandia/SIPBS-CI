<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\VisitorModel;
use App\Models\BlogModel;
use App\Models\SiteModel;

use CodeIgniter\Controller;

class Category extends Controller
{
	protected $categoryModel;
	protected $visitorModel;
	protected $blogModel;
	protected $siteModel;

	public function __construct()
	{
		helper('text');

		$this->categoryModel = new CategoryModel();
		$this->visitorModel = new VisitorModel();
		$this->blogModel = new BlogModel();
		$this->siteModel = new SiteModel();

		$this->visitorModel->countVisitor();
	}

	public function index()
	{
		return redirect()->to('blog');
	}

	public function detail($slug)
	{
		$data = $this->categoryModel->getBlogByCategory($slug)->getRowArray();
		if (!empty($data)) {
			$category_id = $data['category_id'];
			$kategori_nama = $data['category_name'];

			$page = $this->request->getVar('page') ?? 1;
			$limit = 9;
			$offset = ($page - 1) * $limit;

			$jum = $this->categoryModel->getBlogByCategory($slug);
			$totalRows = $jum->getNumRows();

			$pager = \Config\Services::pager();
			$pager->setPath('category/' . $slug);
			$pagination = $pager->makeLinks($page, $limit, $totalRows);

			$data['blogs'] = $this->categoryModel->blogCategoryPerPage($category_id, $offset, $limit)->getResult();
			$data['pagination'] = $pagination;
			$data['judul'] = $kategori_nama;
			$data['description'] = "Kumpulan artikel " . $kategori_nama . " yang bermanfaat untuk menambah wawasan Anda.";

			if ($page == 1) {
				$data['canonical'] = site_url('category/' . $slug);
				$data['url_prev'] = "";
				$data['url_next'] = site_url('category/' . $slug . '/2');
			} else {
				$prev_page = $page - 1;
				$next_page = $page + 1;
				$data['canonical'] = site_url('category/' . $slug . '/' . $page);
				$data['url_prev'] = site_url('category/' . $slug . '/' . $prev_page);
				$data['url_next'] = site_url('category/' . $slug . '/' . $next_page);
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

			return view('BlogCategoryView', $data);
		} else {
			return redirect()->to('/blog');
		}
	}
}
