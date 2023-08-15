<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 * 
 * @property int $id
 * @property int $user_id
 * @property string $address1
 * @property string $address2
 * @property string $postalcode
 * @property string $city
 * @property bool $deliverySameAddress
 * @property string|null $deliveryAddress1
 * @property string|null $deliveryAddress2
 * @property string|null $deliveryPostalcode
 * @property string|null $deliveryCity
 * @property bool $isCompany
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Address extends Model
{
	protected $table = 'addresses';

	protected $casts = [
		'user_id' => 'int',
		'deliverySameAddress' => 'bool',
		'isCompany' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'address1',
		'address2',
		'postalcode',
		'city',
		'deliverySameAddress',
		'deliveryAddress1',
		'deliveryAddress2',
		'deliveryPostalcode',
		'deliveryCity',
		'isCompany'
	];
}
