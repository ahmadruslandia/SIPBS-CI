<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteModel extends Model
{
	protected $table = 'tbl_site';
	protected $primaryKey = 'site_id';
	protected $allowedFields = [
		'site_name',
		'site_title',
		'site_description',
		'site_logo_header',
		'site_favicon',
		'site_logo_big',
		'site_facebook',
		'site_twitter',
		'site_instagram',
		'site_pinterest',
		'site_linkedin'
	];

	public function getSiteData()
	{
		return $this->db->table($this->table)
			->get()
			->getRowArray();
	}

	public function updateInformation($site_id, $data)
	{
		$this->update($site_id, $data);
	}

	public function updateInformationHeaderIcon($site_id, $data)
	{
		$this->update($site_id, $data);
	}

	public function updateInformationBigIcon($site_id, $data)
	{
		$this->update($site_id, $data);
	}

	public function updateInformationBigHeader($site_id, $data)
	{
		$this->update($site_id, $data);
	}

	public function updateInformationHeader($site_id, $data)
	{
		$this->update($site_id, $data);
	}

	public function updateInformationFooter($site_id, $data)
	{
		$this->update($site_id, $data);
	}

	public function updateInformationBig($site_id, $data)
	{
		$this->update($site_id, $data);
	}

	public function updateInformationNoLogo($site_id, $data)
	{
		$this->update($site_id, $data);
	}
}
