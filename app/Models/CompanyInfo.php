<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyInfo
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $fax
 * @property bool $vatFree
 * @property string|null $vat
 * @property string $siret
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_infos';

    protected $casts = [
        'user_id' => 'int',
        'vatFree' => 'bool',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'fax',
        'vatFree',
        'vat',
        'siret',
    ];
}
