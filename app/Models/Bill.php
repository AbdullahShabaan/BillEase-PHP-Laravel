<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory;
    use SoftDeletes;



    // protected $guarded = [] ;

    protected $fillable = [

        'bill_number' ,
        'category_id' ,
        'product' ,
        'date'  ,
        'due_date' ,
        'amount_collection' ,
        'amount_commission'  ,
        'discount' ,
        'value_VAT' ,
        'rate_VAT'  ,
        'total'  ,
        'status'  ,
        'value_status' ,
        'note',
        'user' ,     


    ];


    public function Category() {
        
        return $this->belongsTo(Category::class , 'category_id') ;
    }

}
