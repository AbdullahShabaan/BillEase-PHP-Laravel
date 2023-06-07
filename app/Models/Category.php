<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product ;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [

        'name',
        'description',
        'created_by'

    ];

 public function products(): HasMany
    {
        return $this->hasMany(Product::class , 'category_id');
    }


}
