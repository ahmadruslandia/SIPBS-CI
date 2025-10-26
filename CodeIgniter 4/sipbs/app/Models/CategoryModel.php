<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
	protected $table = 'tbl_category';

	public function getBlogByCategory($slug)
	{
		$sql = "SELECT tbl_post.*, tbl_category.*, user_name, user_photo 
                FROM tbl_post 
                LEFT JOIN tbl_category ON post_category_id = category_id 
                LEFT JOIN tbl_user ON post_user_id = user_id 
                WHERE category_slug = ?";
		return $this->db->query($sql, [$slug]);
	}

	public function blogCategoryPerPage($categoryId, $offset, $limit)
	{
		$sql = "SELECT tbl_post.*, tbl_category.*, user_name, user_photo 
                FROM tbl_post 
                LEFT JOIN tbl_category ON post_category_id = category_id 
                LEFT JOIN tbl_user ON post_user_id = user_id 
                WHERE category_id = ? 
                LIMIT ?, ?";
		return $this->db->query($sql, [$categoryId, $offset, $limit]);
	}
}
