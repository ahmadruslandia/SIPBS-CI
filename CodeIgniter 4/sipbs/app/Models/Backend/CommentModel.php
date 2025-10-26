<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class CommentModel extends Model
{
	protected $table = 'tbl_comment';
	protected $primaryKey = 'comment_id';
	protected $allowedFields = [
		'comment_name',
		'comment_email',
		'comment_message',
		'comment_status',
		'comment_parent',
		'comment_post_id',
		'comment_image'
	];

	public function getAllComment($offset, $limit)
	{
		$sql = "SELECT comment_id, DATE_FORMAT(comment_date,'%d %M %Y %H:%i') AS comment_date,
				comment_name, comment_email, comment_status, comment_message, comment_image,
				post_id, post_title, post_slug 
				FROM tbl_comment 
				JOIN tbl_post ON comment_post_id = post_id 
				WHERE comment_parent = '0' 
				ORDER BY comment_id DESC LIMIT $offset, $limit";
		return $this->db->query($sql)->getResult();
	}


	public function getAllCommentsUnpublished($offset, $limit)
	{
		$sql = "SELECT comment_id, DATE_FORMAT(comment_date,'%d %M %Y %H:%i') AS comment_date,
				comment_name, comment_email, comment_status, comment_message, comment_image,
				post_id, post_title, post_slug 
				FROM tbl_comment 
				JOIN tbl_post ON comment_post_id = post_id 
				WHERE comment_status = '0' 
				ORDER BY comment_id DESC LIMIT $offset, $limit";
		return $this->db->query($sql)->getResult();
	}


	public function replyComment($post_id, $comment_id, $comments, $user_id, $user_name, $user_email)
	{
		$session = session();
		$user_id = $session->get('id');
		$query = $this->db->table('tbl_user')->getWhere(['user_id' => $user_id]);
		$image = $query->getNumRows() > 0 ? $query->getRow()->user_photo : 'user_blank.png';

		$data = [
			'comment_name' => $user_name,
			'comment_email' => $user_email,
			'comment_message' => $comments,
			'comment_status' => 1,
			'comment_parent' => $comment_id,
			'comment_post_id' => $post_id,
			'comment_image' => $image
		];

		return $this->db->table($this->table)->insert($data);
	}

	public function editComment($comment_id, $comments)
	{
		return $this->db->table($this->table)
			->set('comment_message', $comments)
			->where('comment_id', $comment_id)
			->update();
	}

	public function publishComment($comment_id)
	{
		return $this->db->table($this->table)
			->set('comment_status', '1')
			->where('comment_id', $comment_id)
			->update();
	}

	public function deleteComment($comment_id)
	{
		$this->db->transStart();
		$this->db->query("DELETE FROM tbl_comment WHERE comment_parent = ?", [$comment_id]);
		$this->db->query("DELETE FROM tbl_comment WHERE comment_id = ?", [$comment_id]);
		$this->db->transComplete();

		return $this->db->transStatus();
	}

	public function changeImage($id, $name, $email, $image)
	{
		return $this->db->table($this->table)
			->set([
				'comment_name' => $name,
				'comment_email' => $email,
				'comment_image' => $image
			])
			->where('comment_id', $id)
			->update();
	}

	public function searchComment($keyword)
	{
		$sql = "SELECT comment_id, DATE_FORMAT(comment_date,'%d %M %Y %H:%i') AS comment_date,
                comment_name, comment_email, comment_status, comment_message, comment_image,
                post_id, post_title, post_slug 
                FROM tbl_comment 
                LEFT JOIN tbl_post ON comment_post_id = post_id 
                WHERE (comment_name LIKE ? OR post_title LIKE ?) 
                AND comment_parent = '0' 
                ORDER BY comment_id DESC LIMIT 10";

		return $this->db->query($sql, ['%' . $keyword . '%', '%' . $keyword . '%'])->getResult();
	}
}
