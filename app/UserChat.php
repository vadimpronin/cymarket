<?php

namespace CyMarket;

use Illuminate\Database\Eloquent\Model;

/**
 * CyMarket\UserChat
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $chat_id
 * @property string|null $current_scenario
 * @property string|null $current_step
 * @property string|null $current_object
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \CyMarket\Chat|null $chat
 * @property-read \CyMarket\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat whereCurrentObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat whereCurrentScenario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat whereCurrentStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\UserChat whereUserId($value)
 * @mixin \Eloquent
 */
class UserChat extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
