<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
	protected $table = 'tbl_post';

	public function getBlogs()
	{
		return $this->db->table($this->table)->get();
	}

	public function getBlogPerPage($offset, $limit)
	{
		return $this->db->table($this->table)
			->select('tbl_post.*, user_name, user_photo')
			->join('tbl_user', 'post_user_id = user_id', 'left')
			->orderBy('post_id', 'DESC')
			->limit($limit, $offset)
			->get();
	}

	public function getPostBySlug($slug)
	{
		$sql = "SELECT tbl_post.*, user_name, COUNT(comment_id) AS comment_total, tbl_category.* 
                FROM tbl_post 
                LEFT JOIN tbl_user ON post_user_id = user_id 
                LEFT JOIN tbl_comment ON post_id = comment_post_id 
                LEFT JOIN tbl_category ON post_category_id = category_id 
                WHERE post_slug = ? 
                GROUP BY post_id 
                LIMIT 1";
		return $this->db->query($sql, [$slug]);
	}

	public function getPopularPost()
	{
		return $this->db->table($this->table)
			->select('tbl_post.*, user_name, user_photo')
			->join('tbl_user', 'post_user_id = user_id', 'left')
			->orderBy('post_views', 'DESC')
			->limit(5)
			->get();
	}

	public function getRelatedPost($categoryId, $kode)
	{
		$sql = "SELECT * FROM tbl_post 
                LEFT JOIN tbl_user ON post_user_id = user_id 
                WHERE post_category_id = ? AND NOT post_id = ? 
                ORDER BY post_views DESC 
                LIMIT 2";
		return $this->db->query($sql, [$categoryId, $kode]);
	}

	public function countViews($kode)
	{
		$userIp = $_SERVER['REMOTE_ADDR'];
		$sqlCheck = "SELECT * FROM tbl_post_views WHERE view_ip = ? AND view_post_id = ? AND DATE(view_date) = CURDATE()";
		$cekIp = $this->db->query($sqlCheck, [$userIp, $kode]);

		if ($cekIp->getNumRows() <= 0) {
			$this->db->transStart();

			$this->db->query("INSERT INTO tbl_post_views (view_ip, view_post_id) VALUES(?, ?)", [$userIp, $kode]);
			$this->db->query("UPDATE tbl_post SET post_views = post_views + 1 WHERE post_id = ?", [$kode]);

			$this->db->transComplete();

			return $this->db->transStatus();
		}

		return false;
	}

	public function showComments($kode)
	{
		$sql = "SELECT * FROM tbl_comment WHERE comment_post_id = ? AND comment_status = '1' AND comment_parent = '0'";
		return $this->db->query($sql, [$kode]);
	}

	public function saveComment($postId, $name, $email, $comment)
	{
		$data = [
			'comment_name' => $name,
			'comment_email' => $email,
			'comment_message' => $comment,
			'comment_post_id' => $postId,
			'comment_image' => 'user_blank.png'
		];
		$this->db->table('tbl_comment')->insert($data);
	}
}
