<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Member
 * 
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property Carbon|null $date_of_birth
 * @property int|null $party_id
 * @property int $constituency_id
 * 
 * @property Constituency $constituency
 * @property Party|null $party
 * @property Collection|Interest[] $interests
 *
 * @package App\Models
 */
class Member extends Model
{
	protected $table = 'members';
	public $timestamps = false;

	protected $casts = [
		'party_id' => 'int',
		'constituency_id' => 'int'
	];

	protected $dates = [
		'date_of_birth'
	];

	protected $fillable = [
		'firstname',
		'lastname',
		'date_of_birth',
		'party_id',
		'constituency_id'
	];

	public function constituency()
	{
		return $this->belongsTo(Constituency::class);
	}

	public function party()
	{
		return $this->belongsTo(Party::class);
	}

	public function interests()
	{
		return $this->belongsToMany(Interest::class);
	}
}
