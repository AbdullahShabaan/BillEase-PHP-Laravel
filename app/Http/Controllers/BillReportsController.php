<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill ;

class BillReportsController extends Controller
{
    public $invoice_number  ;

    public function index () {
        return view ('reports.billReports') ;
    }


    public function SearchBill (request $request) {

        $radio =  $request->radio ;

        if ($radio == 1) {
             
             $number = $this->invoice_number = '' ;
            // $radio_value = $request->radio ;
            
            if (empty ($request->start_at ) && empty ($request->end_at )) {

                $bill = Bill::select('*')->where('value_status' , $request->type)->get();
            }else {


                $bill = Bill::whereBetween('date' ,[ $request->start_at , $request->end_at ])->where('value_status' , $request->type)->get();

            }


        }else {
           

             // $radio_value = $request->radio ;

          $bill = Bill::where('bill_number' , $request->invoice_number)->get();
          $number = $this->invoice_number = $request->invoice_number ;


        }       
                $type = $request->type ;
                $start_at = date($request->start_at) ;
                $end_at = date($request->end_at );

                if ($request->type == 1){
                    $type_name = 'Paid Bills' ; 
                }elseif ($request->type == 2){
                    $type_name = 'UnPaid Bills' ; 
                }elseif ($request->type == 3){
                    $type_name = 'Partialy Paid Bills' ; 
                }
                else {
                    $type_name = 'Select Status' ;
                }

                return view ('reports.billReports' , ['data' => $bill , 'type' => $type ,
                 'type_name' => $type_name , 'start_at' => $start_at , 'end_at' => $end_at ,
                 'invoice_number' => $number ]) ;

    }
}
