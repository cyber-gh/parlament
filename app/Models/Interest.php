<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Interest
 * 
 * @property int $id
 * @property string $name
 * 
 * @property Collection|Member[] $members
 *
 * @package App\Models
 */
class Interest extends Model
{
	protected $table = 'interests';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function members()
	{
		return $this->belongsToMany(Member::class);
	}
}
