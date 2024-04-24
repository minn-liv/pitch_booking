<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pitch
 * 
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $hotline
 * @property string $description
 * @property string|null $image
 * @property string|null $longitude
 * @property string|null $latitude
 * @property int $host_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Pitch extends Model
{
	protected $table = 'pitch';

	protected $casts = [
		'host_by' => 'int'
	];

	protected $fillable = [
		'name',
		'address',
		'hotline',
		'description',
		'image',
		'longitude',
		'latitude',
		'host_by'
	];

	public function pitch_information()
	{
		return $this->belongsTo(PitchInformation::class, 'id', 'pitch_id');
	}
}
