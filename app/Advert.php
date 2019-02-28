<?php

namespace CyMarket;

use Illuminate\Database\Eloquent\Model;

/**
 * CyMarket\Advert
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $status
 * @property string|null $description
 * @property string|null $price
 * @property int|null $area_id
 * @property int|null $category_id
 * @property int|null $reserved_by
 * @property string|null $reserved_till
 * @property string|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \CyMarket\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert query()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereReservedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereReservedTill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Advert whereUserId($value)
 * @mixin \Eloquent
 */
class Advert extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
