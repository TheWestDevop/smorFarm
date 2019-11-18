<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description',
        'product_image',
        'path',
        'price',
        'price_per_unit',
        'category_id',
        'quantity',
        'made_in_nigeria',
        'discount',
        'ordered_quantities',
    ];

}
