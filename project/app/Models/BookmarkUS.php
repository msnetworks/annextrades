<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookmarkUS extends Model
{
    protected $table = "bookmark_us";
    protected $fillable = ['name','slug'];
    public $timestamps = false;
}
