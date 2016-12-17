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

use Illuminate\Support\ServiceProvider;

class ReviewableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__.'/../migrations') => database_path('migrations')
        ], 'migrations');

        // Publish config files
        $this->publishes([
            __DIR__.'/../config.php' => config_path('reviewable'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfig();
    }

    /**
     * Merges user's and entrust's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/reviewable.php', 'reviewable'
        );
    }
}
