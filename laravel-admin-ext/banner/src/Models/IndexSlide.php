<?php

namespace Encore\Banner\Models;;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * App\Models\Common\IndexSlide
 *
 * @property int $id
 * @property string $url 素材地址
 * @property int $url_type 素材类型
 * @property string|null $name 名称
 * @property string $slide_type 交互类型none无，official公众号，outside_mini外部小程序，inside_mini内部小程序
 * @property array $slide_type_content 交互内容
 * @property int $status 状态 1开启 2关闭
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide query()
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide whereSlideType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide whereSlideTypeContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndexSlide whereUrlType($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class IndexSlide extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
