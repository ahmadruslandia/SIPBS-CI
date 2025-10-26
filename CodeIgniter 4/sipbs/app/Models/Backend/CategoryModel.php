<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class CategoryModel extends Model
{
	protected $table = 'tbl_category';
	protected $primaryKey = 'category_id';
	protected $allowedFields = ['category_name', 'category_slug'];

	public function getAllCategory()
	{
		return $this->findAll();
	}

	public function addNewRow($category, $slug)
	{
		$data = [
			'category_name' => $category,
			'category_slug' => $slug,
		];
		return $this->insert($data);
	}

	public function editRow($id, $category, $slug)
	{
		$data = [
			'category_name' => $category,
			'category_slug' => $slug,
		];
		return $this->update($id, $data);
	}

	public function deleteRow($id)
	{
		return $this->delete($id);
	}
}
