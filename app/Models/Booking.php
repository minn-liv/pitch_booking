<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Booking
 * 
 * @property int $id
 * @property int $user_created
 * @property int $pitch_information_id
 * @property string $note
 * @property int $total
 * @property int $payment_status
 * @property int $booking_status
 * @property Carbon $date
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Booking extends Model
{
	protected $table = 'booking';

	protected $casts = [
		'user_created' => 'int',
		'pitch_information_id' => 'int',
		'total' => 'int',
		'payment_status' => 'int',
		'booking_status' => 'int',
		'date' => 'datetime',
		'start_time' => 'datetime',
		'end_time' => 'datetime'
	];

	protected $fillable = [
		'user_created',
		'pitch_information_id',
		'note',
		'total',
		'payment_status',
		'booking_status',
		'date',
		'start_time',
		'end_time'
	];
}
