<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
	protected $table = 'tbl_inbox';
	protected $primaryKey = 'id';
	protected $allowedFields = ['inbox_name', 'inbox_email', 'inbox_subject', 'inbox_message'];

	public function saveMessage($name, $email, $subject, $message)
	{
		$data = [
			'inbox_name'    => $name,
			'inbox_email'   => $email,
			'inbox_subject' => $subject,
			'inbox_message' => $message
		];
		return $this->insert($data);
	}
}
