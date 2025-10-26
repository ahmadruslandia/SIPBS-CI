<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class TestimonialModel extends Model
{
	protected $table = 'tbl_testimonial';
	protected $primaryKey = 'testimonial_id';
	protected $allowedFields = ['testimonial_name', 'testimonial_content', 'testimonial_image'];

	public function getTestimonial()
	{
		return $this->findAll();
	}

	public function insertTestimonial($nama, $content, $gambar)
	{
		$data = [
			'testimonial_name' => $nama,
			'testimonial_content' => $content,
			'testimonial_image' => $gambar,
		];
		return $this->insert($data);
	}

	public function updateTestimonial($id, $nama, $content, $gambar)
	{
		$data = [
			'testimonial_name' => $nama,
			'testimonial_content' => $content,
			'testimonial_image' => $gambar,
		];
		return $this->update($id, $data);
	}

	public function updateTestimonialNoImg($id, $nama, $content)
	{
		$data = [
			'testimonial_name' => $nama,
			'testimonial_content' => $content,
		];
		return $this->update($id, $data);
	}

	public function deleteTestimonial($testimonial_id)
	{
		return $this->delete($testimonial_id);
	}
}
