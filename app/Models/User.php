<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property Carbon $dob
 * @property string $address
 * @property string $phone
 * @property string $user_type
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string $avatar
 * @property int $status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'users';
	use HasApiTokens, HasFactory, Notifiable;
	protected $casts = [
		'dob' => 'datetime',
		'latitude' => 'float',
		'longitude' => 'float',
		'status' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'username',
		'password',
		'name',
		'dob',
		'address',
		'phone',
		'user_type',
		'latitude',
		'longitude',
		'avatar',
		'status',
		'remember_token'
	];

	public function AauthAcessToken()
	{
		return $this->hasMany(OauthAccessToken::class);
	}

	public function booking()
	{
		return $this->belongsTo(Booking::class, 'id', 'user_created');
	}
}
