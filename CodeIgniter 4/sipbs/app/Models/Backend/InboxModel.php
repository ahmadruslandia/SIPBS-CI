<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class InboxModel extends Model
{
	protected $table = 'tbl_inbox';
	protected $primaryKey = 'inbox_id';
	protected $allowedFields = ['inbox_name', 'inbox_subject', 'inbox_status'];

	public function getAllInbox($offset, $limit)
	{
		return $this->findAll($limit, $offset);
	}

	public function getInboxById($inbox_id)
	{
		return $this->where('inbox_id', $inbox_id)->first();
	}

	public function searchInbox($keyword)
	{
		return $this->like('inbox_name', $keyword)
			->orLike('inbox_subject', $keyword)
			->findAll();
	}

	public function updateStatusById($inbox_id)
	{
		return $this->update($inbox_id, ['inbox_status' => 1]);
	}

	public function deleteInbox($inbox_id)
	{
		return $this->delete($inbox_id);
	}
}
