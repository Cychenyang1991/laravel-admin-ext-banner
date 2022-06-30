<?php

namespace Encore\Banner;

use Illuminate\Support\ServiceProvider;

class BannerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Banner $extension)
    {
        if (!Banner::boot()) {
            return;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'banner');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/')],
                'banner'
            );
        }

        if ($this->app->runningInConsole() && $migrations = $extension->migrations()) {
            $this->publishes(
                [$migrations => database_path('migrations')],
                'banner-migrations'
            );
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../stubs/BannerController.stub'
                              => admin_path('Controllers/BannerController.php')], 'banner_con');

            $this->publishes([__DIR__ . '/../stubs/IndexSlide.stub'
                              => app_path('Models/Common/IndexSlide.php')], 'banner_con');
        }


        $this->app->booted(function () {
            Banner::routes(__DIR__ . '/../routes/web.php');
        });
    }
}
