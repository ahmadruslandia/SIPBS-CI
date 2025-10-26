<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class SettingModel extends Model
{
	protected $tableHome = 'tbl_home';
	protected $tableAbout = 'tbl_about';

	public function getHomeData()
	{
		return $this->db->table($this->tableHome)
			->limit(1)
			->get()
			->getRow();
	}

	public function updateInformation($homeId, $caption1, $caption2, $bgHeading, $bgTestimoni)
	{
		return $this->db->table($this->tableHome)
			->where('home_id', $homeId)
			->update([
				'home_caption_1' => $caption1,
				'home_caption_2' => $caption2,
				'home_bg_heading' => $bgHeading,
				'home_bg_testimonial' => $bgTestimoni,
			]);
	}

	public function updateInformationHeading($homeId, $caption1, $caption2, $bgHeading)
	{
		return $this->db->table($this->tableHome)
			->where('home_id', $homeId)
			->update([
				'home_caption_1' => $caption1,
				'home_caption_2' => $caption2,
				'home_bg_heading' => $bgHeading,
			]);
	}

	public function updateInformationTestimoni($homeId, $caption1, $caption2, $bgTestimoni)
	{
		return $this->db->table($this->tableHome)
			->where('home_id', $homeId)
			->update([
				'home_caption_1' => $caption1,
				'home_caption_2' => $caption2,
				'home_bg_testimonial' => $bgTestimoni,
			]);
	}

	public function updateInformationNoImg($homeId, $caption1, $caption2)
	{
		return $this->db->table($this->tableHome)
			->where('home_id', $homeId)
			->update([
				'home_caption_1' => $caption1,
				'home_caption_2' => $caption2,
			]);
	}

	public function getAboutData()
	{
		return $this->db->table($this->tableAbout)
			->limit(1)
			->get()
			->getRow();
	}

	public function updateInformationAbout($aboutId, $description, $image)
	{
		return $this->db->table($this->tableAbout)
			->where('about_id', $aboutId)
			->update([
				'about_image' => $image,
				'about_description' => $description,
			]);
	}

	public function updateInformationAboutNoImg($aboutId, $description)
	{
		return $this->db->table($this->tableAbout)
			->where('about_id', $aboutId)
			->update([
				'about_description' => $description,
			]);
	}
}
