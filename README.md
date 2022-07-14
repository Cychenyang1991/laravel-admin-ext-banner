laravel-admin extension
======
基于laravel-admin编写的轮播图后台配置

1. 创建配置文件：

```shell
php artisan vendor:publish --provider="Encore\Banner\BannerServiceProvider"
```

会在admin后台的 admin目录下生成 BannerController.php 控制器

在 Models/Common/IndexSlide.php 生成 model文件

需要在 laravel-admin后台的 Admin目录中的 路由文件中 增加 $router->resource('banners', BannerController::class);

需在csrf中过滤请求
class VerifyCsrfToken extends Middleware
{
/**
* The URIs that should be excluded from CSRF verification.
* 
  * @var array
  */
  protected $except = [
  //
  'admin/banners/upload',
  'admin/banners/save',
  ];
}

