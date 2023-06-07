<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category ;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected  $fillable = [

            'name',
            'description',
            'price',
            'status',
            'category_id',
            'user',
            'date'
    ];

   public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class , "category_id");
    }
}
