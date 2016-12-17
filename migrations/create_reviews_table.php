<?php

/*
 * This file is part of Laravel Reviewable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->uuid('reviewable_id')->index();
            $table->string('reviewable_type', 255)->index();
            $table->uuid('author_id')->index();
            $table->string('author_type', 255)->index();
            $table->primary('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
