<?php

namespace Encore\Banner;

use Encore\Admin\Extension;

class Banner extends Extension
{
    public $name = 'banner';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $migrations = __DIR__.'/../database/migrations';



    public $menu = [
        'title' => 'Banner',
        'path'  => 'banner',
        'icon'  => 'fa-gears',
    ];
}
