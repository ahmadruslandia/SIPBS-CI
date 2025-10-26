<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class TagModel extends Model
{
	protected $table = 'tbl_tags';
	protected $primaryKey = 'tag_id';
	protected $allowedFields = ['tag_name'];

	public function getAllTag()
	{
		return $this->findAll();
	}

	public function addNewRow($tag)
	{
		$data = [
			'tag_name' => $tag
		];
		return $this->insert($data);
	}

	public function editRow($id, $tag)
	{
		$data = [
			'tag_name' => $tag
		];
		return $this->update($id, $data);
	}

	public function deleteRow($id)
	{
		return $this->delete($id);
	}
}
