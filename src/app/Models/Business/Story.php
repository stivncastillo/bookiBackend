<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Altek\Eventually\Eventually;

class Story extends Model
{
    use SoftDeletes,
        Eventually;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'action',
        'summary',
        'page',
        'chapter',
        'is_ended',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_ended' => 'boolean',
    ];
}
