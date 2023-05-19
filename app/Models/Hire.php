<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
   	protected $table = 'hires';
   	protected $fillable = ['order_no'];
}