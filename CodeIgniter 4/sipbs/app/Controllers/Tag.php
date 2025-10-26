<?php

namespace App\Controllers;

use App\Models\TagModel;
use App\Models\BlogModel;
use App\Models\VisitorModel;
use App\Models\SiteModel;

use CodeIgniter\Controller;

class Tag extends Controller
{
	protected $tagModel;
	protected $blogModel;
	protected $visitorModel;
	protected $siteModel;

	public function __construct()
	{
		helper('text');

		$this->tagModel = new TagModel();
		$this->blogModel = new BlogModel();
		$this->visitorModel = new VisitorModel();
		$this->siteModel = new SiteModel();

		$this->visitorModel->countVisitor();
	}

	public function index()
	{
		return redirect()->to('/blog');
	}

	public function detail($tag)
	{
		$data = $this->tagModel->getBlogByTags($tag);
		if (!empty($data)) {
			$jum = count($data);
			$page = $this->request->getVar('page') ?? 1;
			$limit = 9;
			$offset = ($page - 1) * $limit;

			$pager = \Config\Services::pager();
			$pager->setPath('tag/' . $tag);
			$pagination = $pager->makeLinks($page, $limit, $jum);

			$x['page'] = $pagination;
			$x['data'] = $this->tagModel->blogTagsPerPage($tag, $offset, $limit);

			$x['judul'] = $tag;
			$x['description'] = "Kumpulan artikel " . $tag . " sangat bermanfaat untuk menambah wawasan Anda.";

			if ($page == 1) {
				$next_page = 2;
				$x['canonical'] = site_url('tag/' . $tag);
				$x['url_prev'] = "";
			} else {
				$next_page = $page + 1;
				$prev_page = $page - 1;
				$x['canonical'] = site_url('tag/' . $tag . '/' . $page);
				$x['url_prev'] = site_url('tag/' . $tag . '/' . $prev_page);
			}
			$x['url_next'] = site_url('tag/' . $tag . '/' . $next_page);

			$x['populer_post'] = $this->blogModel->getPopularPost()->getResult();

			$db = \Config\Database::connect();
			$siteInfo = $db->table('tbl_site')->get(1)->getRow();
			$x['site_image'] = $siteInfo->site_logo_big;
			$x['site_name'] = $siteInfo->site_name;
			$v['logo'] = $siteInfo->site_logo_header;
			$x['icon'] = $siteInfo->site_favicon;
			$x['header'] = view('Header', $v);
			$x['footer'] = view('Footer');

			return view('BlogTagView', $x);
		} else {
			return redirect()->to('/blog');
		}
	}
}
