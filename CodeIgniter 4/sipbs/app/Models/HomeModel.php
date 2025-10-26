<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
	protected $table = 'tbl_post';
	protected $primaryKey = 'post_id';

	public function getPostHeader()
	{
		return $this->db->table('tbl_post')
			->select('tbl_post.*, user_name')
			->join('tbl_user', 'post_user_id = user_id', 'left')
			->orderBy('post_id', 'DESC')
			->limit(1)
			->get();
	}

	public function getPostHeader2()
	{
		return $this->db->table('tbl_post')
			->select('tbl_post.*, user_name')
			->join('tbl_user', 'post_user_id = user_id', 'left')
			->orderBy('post_id', 'DESC')
			->limit(2, 1)
			->get();
	}

	public function getPostHeader3()
	{
		return $this->db->table('tbl_post')
			->select('tbl_post.*, user_name')
			->join('tbl_user', 'post_user_id = user_id', 'left')
			->orderBy('post_id', 'DESC')
			->limit(3, 3)
			->get();
	}

	public function getLatestPost()
	{
		return $this->db->table('tbl_post')
			->select('tbl_post.*, user_name, user_photo')
			->join('tbl_user', 'post_user_id = user_id', 'left')
			->orderBy('post_id', 'DESC')
			->limit(6)
			->get();
	}

	public function getPopularPost()
	{
		return $this->db->table('tbl_post')
			->select('tbl_post.*, user_name')
			->join('tbl_user', 'post_user_id = user_id', 'left')
			->orderBy('post_views', 'DESC')
			->limit(5)
			->get();
	}
}
