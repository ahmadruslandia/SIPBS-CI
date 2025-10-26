<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
	protected $table = 'tbl_post';

	public function getBlogByTags($tag)
	{
		$builder = $this->db->table('tbl_post');
		$builder->select('tbl_post.*, user_name, user_photo')
			->join('tbl_user', 'post_user_id = user_id', 'left')
			->like('post_tags', $tag);

		return $builder->get()->getResult();
	}

	public function blogTagsPerPage($tag, $offset, $limit)
	{
		$builder = $this->db->table('tbl_post');
		$builder->select('tbl_post.*, user_name, user_photo')
			->join('tbl_user', 'post_user_id = user_id', 'left')
			->like('post_tags', $tag)
			->limit($limit, $offset);

		return $builder->get()->getResult();
	}
}
