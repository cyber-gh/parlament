<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Party
 * 
 * @property int $id
 * @property string $name
 * @property int $date_of_foundation
 * @property string $principal_colour
 * 
 * @property Collection|Member[] $members
 *
 * @package App\Models
 */
class Party extends Model
{
	protected $table = 'parties';
	public $timestamps = false;

	protected $casts = [
		'date_of_foundation' => 'int'
	];

	protected $fillable = [
		'name',
		'date_of_foundation',
		'principal_colour'
	];

	public function members()
	{
		return $this->hasMany(Member::class);
	}
}
