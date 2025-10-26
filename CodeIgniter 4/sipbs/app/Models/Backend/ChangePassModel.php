<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class ChangePassModel extends Model
{
	protected $table = 'tbl_user';
	protected $primaryKey = 'user_id';

	public function checkingOldPassword($user_id, $old_pass)
	{
		return $this->where('user_id', $user_id)
			->where('user_password', $old_pass)
			->get();
	}

	public function changePassword($user_id, $new_pass)
	{
		return $this->set('user_password', $new_pass)
			->where('user_id', $user_id)
			->update();
	}
}
