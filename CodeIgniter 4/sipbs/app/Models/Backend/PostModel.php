<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class PostModel extends Model
{
	protected $table = 'tbl_post';
	protected $primaryKey = 'post_id';
	protected $allowedFields = [
		'post_title',
		'post_description',
		'post_contents',
		'post_image',
		'post_category_id',
		'post_tags',
		'post_slug',
		'post_status',
		'post_user_id'
	];
	protected $useTimestamps = false;

	public function getAllPost()
	{
		return $this->db->query("
            SELECT post_id, post_title, post_image, DATE_FORMAT(post_date, '%d %M %Y') AS post_date,
                   category_name, post_tags, post_status, post_views
            FROM tbl_post
            JOIN tbl_category ON post_category_id = category_id
        ")->getResult();
	}

	public function getPostById($post_id)
	{
		return $this->where('post_id', $post_id)->first();
	}

	public function save_post($title, $contents, $category, $slug, $image, $tags, $description)
	{
		$data = [
			'post_title' => $title,
			'post_description' => $description,
			'post_contents' => $contents,
			'post_image' => $image,
			'post_category_id' => $category,
			'post_tags' => $tags,
			'post_slug' => $slug,
			'post_status' => 1,
			'post_user_id' => session()->get('id')
		];
		return $this->insert($data);
	}

	public function edit_post_with_img($id, $title, $contents, $category, $slug, $image, $tags, $description)
	{
		$data = [
			'post_title' => $title,
			'post_description' => $description,
			'post_contents' => $contents,
			'post_image' => $image,
			'post_last_update' => date('Y-m-d H:i:s'),
			'post_category_id' => $category,
			'post_tags' => $tags,
			'post_slug' => $slug
		];
		return $this->update($id, $data);
	}

	public function edit_post_no_img($id, $title, $contents, $category, $slug, $tags, $description)
	{
		$data = [
			'post_title' => $title,
			'post_description' => $description,
			'post_contents' => $contents,
			'post_last_update' => date('Y-m-d H:i:s'),
			'post_category_id' => $category,
			'post_tags' => $tags,
			'post_slug' => $slug
		];
		return $this->update($id, $data);
	}

	public function delete_post($post_id)
	{
		return $this->delete($post_id);
	}

	public function isSlugExists($slug)
	{
		return $this->where('post_slug', $slug)->countAllResults() > 0;
	}
}
