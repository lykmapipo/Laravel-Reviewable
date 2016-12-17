<?php

/*
 * This file is part of Laravel Reviewable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// declare(strict_types=1);

/*
 * This file is part of Laravel Reviewable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Reviewable;

use Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Alsofronie\Uuid\UuidModelTrait;


class Review extends Model
{
    /**
     * Use Uuuid 32 as primary key
     */
    use UuidModelTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['title', 'body'];

    public function reviewable()
    {
        return $this->morphTo();
    }

    /**
     * Review belongs to a user.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(Config::get('auth.model'));
    }
}
