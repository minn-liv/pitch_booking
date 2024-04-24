<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MatchDetail
 * 
 * @property int $match_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MatchDetail extends Model
{
	protected $table = 'match_details';
	protected $primaryKey = 'match_id';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id'
	];
}
