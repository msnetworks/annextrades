<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryUS extends Model
{
    protected $table = "categories_us";
    protected $fillable = ['name','display_name','slug','photo','is_featured','image','is_refine'];
    public $timestamps = false;

    public function subs()
    {
    	return $this->hasMany('App\Models\Subcategory')->where('status','=',1);
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }

    public function attributes() {
        return $this->morphMany('App\Models\Attribute', 'attributable');
    }
}
