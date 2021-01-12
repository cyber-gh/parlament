<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InterestMember
 * 
 * @property int $member_id
 * @property int $interest_id
 * 
 * @property Interest $interest
 * @property Member $member
 *
 * @package App\Models
 */
class InterestMember extends Model
{
	protected $table = 'interest_member';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'member_id' => 'int',
		'interest_id' => 'int'
	];

	public function interest()
	{
		return $this->belongsTo(Interest::class);
	}

	public function member()
	{
		return $this->belongsTo(Member::class);
	}
}
