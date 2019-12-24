<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Altek\Eventually\Eventually;

class Book extends Model
{
    use SoftDeletes,
        Eventually;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'author_key',
        'isbn',
        'cover_url',
        'cover_i',
        'year',
        'publish_date',
        'publisher',
        'id_goodreads',
        'id_amazon',
        'id_google',
        'metadata',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'publish_date',
    ];
}
