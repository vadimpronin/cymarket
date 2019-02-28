<?php

namespace CyMarket;

use Illuminate\Database\Eloquent\Model;

/**
 * CyMarket\AdvertPhoto
 *
 * @property int $id
 * @property int|null $advert_id
 * @property string|null $telegram_file_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \CyMarket\Advert|null $advert
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertPhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertPhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertPhoto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertPhoto whereAdvertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertPhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertPhoto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertPhoto whereTelegramFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertPhoto whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdvertPhoto extends Model
{

    public function advert()
    {
        return $this->belongsTo(Advert::class);
    }
}
