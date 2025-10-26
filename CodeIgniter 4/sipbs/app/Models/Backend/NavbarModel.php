<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class NavbarModel extends Model
{
	protected $table = 'tbl_navbar';
	protected $primaryKey = 'navbar_id';
	protected $allowedFields = ['navbar_name', 'navbar_slug', 'navbar_parent_id'];

	public function getNavbar()
	{
		return $this->where('navbar_parent_id', '0')->findAll();
	}

	public function insertNavbar($name, $slug)
	{
		$data = [
			'navbar_name' => $name,
			'navbar_slug' => $slug
		];
		return $this->insert($data);
	}

	public function updateNavbar($id, $name, $slug)
	{
		$data = [
			'navbar_name' => $name,
			'navbar_slug' => $slug
		];
		return $this->update($id, $data);
	}

	public function deleteNavbar($id)
	{
		$this->transStart();

		$this->where('navbar_parent_id', $id)->delete();


		$this->where('navbar_id', $id)->delete();

		$this->transComplete();
		return $this->transStatus();
	}

	public function insertSubNavbar($name, $slug, $id)
	{
		$data = [
			'navbar_name' => $name,
			'navbar_slug' => $slug,
			'navbar_parent_id' => $id
		];
		return $this->insert($data);
	}
}
