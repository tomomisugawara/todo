<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    /**
     * 状態定義
     */
    const STATUS = [
        1 => [ 'label' => '未完了', 'class' => 'label-default' ],
        2 => [ 'label' => '着手中', 'class' => 'label-info' ],
        3 => [ 'label' => '完了！', 'class' => 'label-primary' ],
    ];

    /**
 * 状態を表すHTMLクラス
 * @return string
 */
public function getStatusClassAttribute()
{
    // 状態値
    $status = $this->attributes['status'];

    // 定義されていなければ空文字を返す
    if (!isset(self::STATUS[$status])) {
        return '';
    }

    return self::STATUS[$status]['class'];
}

    /**
     * 状態のラベル
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

        /**
     * 整形した期限日
     * @return string
     */
    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }
}


