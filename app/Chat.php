<?php

namespace CyMarket;

use Illuminate\Database\Eloquent\Model;

/**
 * CyMarket\Chat
 *
 * @property int $id
 * @property int|null $telegram_id
 * @property int|null $type
 * @property string|null $title
 * @property string|null $username
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\CyMarket\UserChat[] $userChats
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Chat whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Chat whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Chat whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Chat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\Chat whereUsername($value)
 * @mixin \Eloquent
 */
class Chat extends Model
{
    const TYPE_PRIVATE = 1;
    const TYPE_GROUP = 2;
    const TYPE_SUPERGROUP = 3;

    const STRINGTYPEMAP = [
        'private' => self::TYPE_PRIVATE,
        'group' => self::TYPE_GROUP,
        'supergroup' => self::TYPE_SUPERGROUP,
    ];

    protected $guarded = [];

    public function userChats()
    {
        return $this->hasMany(UserChat::class);
    }
}
