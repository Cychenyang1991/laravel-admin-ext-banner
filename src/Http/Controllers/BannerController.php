<?php

namespace Encore\Banner\Http\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class BannerController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(view('banner::index'));
    }
}
