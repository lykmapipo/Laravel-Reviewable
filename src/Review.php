<?php

/*
 * This file is part of Laravel Reviewable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of Laravel Reviewable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Reviewable;

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

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function author(): MorphTo
    {
        return $this->morphTo('author');
    }

    public function createReview(Model $reviewable, $data, Model $author): bool
    {
        $review = new static();
        $review->fill(array_merge($data, [
            'author_id'   => $author->id,
            'author_type' => get_class($author),
        ]));

        return (bool) $reviewable->reviews()->save($review);
    }

    public function updateReview($id, $data): bool
    {
        return (bool) static::find($id)->update($data);
    }

    public function deleteReview($id): bool
    {
        return (bool) static::find($id)->delete();
    }
}
