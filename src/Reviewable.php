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

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Reviewa
{
    public function reviews()
    {
        return $this->morphMany('BrianFaust\Reviewable\Review', 'reviewable');
    }

    /**
     * Add a review for this record by the given user.
     * 
     * @param $title string - review title
     * @param $body string - review body
     * @param $userId mixed - If null will use currently logged in user.
     */
    public function review($title = null, $body = null, $userId = null)
    {

        if(is_null($userId)) {
            $userId = $this->loggedInUserId();
        }
        
        if($userId) {
            $review = new Review();
            $review->user_id = $userId;
            $review->title = $title;
            $review->body = $body;
            $this->ratings()->save($review);
        }

        else{
            return;
        }
    }
}
