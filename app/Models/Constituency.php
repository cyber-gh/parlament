<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Constituency
 * 
 * @property int $id
 * @property int $electorate
 * @property string $region
 * 
 * @property Collection|Member[] $members
 *
 * @package App\Models
 */
class Constituency extends Model
{
	protected $table = 'constituencies';
	public $timestamps = false;

	protected $casts = [
		'electorate' => 'int'
	];

	protected $fillable = [
		'electorate',
		'region'
	];

	public function members()
	{
		return $this->hasMany(Member::class);
	}
}
