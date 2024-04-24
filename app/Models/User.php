<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

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
	use HasApiTokens;
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
}
