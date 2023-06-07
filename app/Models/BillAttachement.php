<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillAttachement extends Model
{
    use HasFactory;


    // protected $fillable = [
    //     'bill_number' ,
    //     'bill_id'     ,
    //     'created_by'  ,
    //     'file_name'   ,
    // ];

    protected $guarded = [] ;
}
