<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable=([
        'category_id',
        'product_name',
        'product_work',
        'product_short_breff',
        'product_regular_price',
        'product_discounted_price',
        'product_banner_photo',
    ]);


}
