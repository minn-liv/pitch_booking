<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Match
 * 
 * @property int $id
 * @property int $created_by
 * @property int $pitch_id
 * @property int|null $pitch_information_id
 * @property string $note
 * @property string $rules
 * @property int $teams_numbers
 * @property int $match_status
 * @property Carbon $duration
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Match extends Model
{
	protected $table = 'match';

	protected $casts = [
		'created_by' => 'int',
		'pitch_id' => 'int',
		'pitch_information_id' => 'int',
		'teams_numbers' => 'int',
		'match_status' => 'int',
		'duration' => 'datetime',
		'start_time' => 'datetime',
		'end_time' => 'datetime',
		'date' => 'datetime'
	];

	protected $fillable = [
		'created_by',
		'pitch_id',
		'pitch_information_id',
		'note',
		'rules',
		'teams_numbers',
		'match_status',
		'duration',
		'start_time',
		'end_time',
		'date'
	];
}
