<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category ;
use App\Models\Product ;
use App\Models\Bill ;

class CustomerReportsController extends Controller
{
    public function index () {

        $category = Category::all();
        $product = Product::all();
        return view ('reports.CustomerReports' ,
         ['category' => $category , 'product' => $product ]) ;
    }

    public function CustomerSearch (request $request) {
        $category = Category::all();
        $product = Product::all();

       if (!empty ($request->start_at) && !empty ($request->end_at)) {

        $bill = Bill::whereBetween('date' , [$request->start_at , $request->end_at])->where('category_id' , $request->category )->where('product' , $request->product)->get() ;

        return view('reports.CustomerReports' , ['data' => $bill , 'category' => $category ,  'product' => $product ]) ;


       }else {
       $bill = Bill::where('category_id' , $request->category )->where('product' , $request->product )->get();
        return view('reports.CustomerReports' , ['data' => $bill , 'category' => $category ,  'product' => $product ]) ;

       }
    }
}
