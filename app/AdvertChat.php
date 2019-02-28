<?php

namespace CyMarket;

use Illuminate\Database\Eloquent\Model;

/**
 * CyMarket\AdvertChat
 *
 * @property int $id
 * @property int|null $advert_id
 * @property int|null $telegram_message_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \CyMarket\Advert|null $advert
 * @property-read \CyMarket\Chat $chat
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertChat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertChat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertChat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertChat whereAdvertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertChat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertChat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertChat whereTelegramMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\AdvertChat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdvertChat extends Model
{

    public function advert()
    {
        return $this->belongsTo(Advert::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
