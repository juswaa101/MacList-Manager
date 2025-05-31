<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $mac_address
 * @property string $type
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress blackListed()
 * @method static \Database\Factories\MacAddressFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress macAddressWhitelist($macAddress)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress whereMacAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress whiteListed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MacAddress withMacAddress($macAddress)
 *
 * @mixin \Eloquent
 */
class MacAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'mac_address',
        'type',
        'description',
    ];

    public function scopeWhiteListed($query)
    {
        return $query->where('type', 'whitelist');
    }

    public function scopeBlackListed($query)
    {
        return $query->where('type', 'blacklist');
    }

    public function scopeWithMacAddress($query, $macAddress)
    {
        return $query->where('mac_address', $macAddress);
    }

    public function scopeMacAddressWhitelist($query, $macAddress)
    {
        return $query->whiteListed()->withMacAddress($macAddress);
    }
}
