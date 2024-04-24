<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PitchInformation
 * 
 * @property int $id
 * @property string $name
 * @property string $pitch_type
 * @property int $price
 * @property int $pitch_id
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class PitchInformation extends Model
{
	protected $table = 'pitch_information';

	protected $casts = [
		'price' => 'int',
		'pitch_id' => 'int',
		'start_time' => 'datetime',
		'end_time' => 'datetime'
	];

	protected $fillable = [
		'name',
		'pitch_type',
		'price',
		'pitch_id',
		'start_time',
		'end_time'
	];

	public function pitch()
	{
		return $this->hasOne(Pitch::class, 'id', 'pitch_id');
	}
}
