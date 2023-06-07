<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category ;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Detail extends Model
{
    use HasFactory;


    // protected $fillable= [

    //      'bill_number' ,
    //      'bill_id' ,
    //      'product' ,
    //      'category_id' , 
    //      'status'  ,
    //      'notes'  ,
    //      'user',


    //  ];

     protected $guarded = [] ;

       public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class , "category_id");
    }
}
