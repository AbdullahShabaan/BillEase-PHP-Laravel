<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill ;
use App\Models\Category ;
use App\Models\Product ;


class HomeController extends Controller
{
    public function index () {

        $count_all = Bill::count() ;
        if ($count_all == 0 ) {
            $count_all = 1 ;
        }


      $paid = round(Bill::where('value_status' , 1)->count() / $count_all * 100 , 2 );
      $UnPaid = round(Bill::where('value_status' , 2)->count() / $count_all * 100 , 2 );
      $PartialyPaid = round(Bill::where('value_status' , 3)->count() / $count_all * 100 , 2 ) ;

$chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 400, 'height' => 200])
         ->labels([ 'UnPaid' , "Paid " , 'Partisaly Paid'])
         ->datasets([
             [
                 "label" => "UnPaid Bills",
                 'backgroundColor' => ['#FF0060'] ,
                 'data' => [$UnPaid]
             ],

              [
                 "label" => "Paid Bills",
                 'backgroundColor' => ['#1B9C85'] ,
                 'data' => [$paid]
             ],
              [
                 "label" => "Partialy Paid Bills",
                 'backgroundColor' => ['#FFC26F'] ,
                 'data' => [$PartialyPaid]
             ],
           
            
         ])
         ->options([]);



$chartjs2 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Paid' , 'UnPaid'])
        ->datasets([
            [
                'backgroundColor' => [ '#36A2EB' ,'#FF6384'],
                'hoverBackgroundColor' => [ '#36A2EB' , '#FF6384'],
                'data' => [$paid, $UnPaid ]
            ]
        ])
        ->options([]);
       

    $category = Category::all() ; 
    $products = Product::count() ;

    // $categoryy = Category::find( 1 )->products->count() ;
    // return $categoryy ; die ;
        return view ('dashboard' , compact('chartjs' , 'chartjs2' , 'category' ,'products')) ;
    

    }

}
