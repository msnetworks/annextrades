<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Generalsetting;
use App\Models\Currency;
use Illuminate\Support\Facades\Session;


class PostRequest extends Model
{
    protected $table = 'PostRequest';
	//public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	/* protected $fillable = [
		'product_name', 'product_des','order_value', 'order_unit', 'name', 'phone', 'email',
	]; */
}
 