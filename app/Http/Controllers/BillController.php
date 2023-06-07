<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Category;
use App\Models\Detail;
use App\Models\User;
use App\Models\BillAttachement;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Mail\AddInvoice ;
use Illuminate\Support\Facades\Mail;
use App\Notifications\PaidBillNotification ;
use Illuminate\Support\Facades\Notification;




class BillController extends Controller
{

        
    public $paid_Status; 
    public $value_Status; 
    /**
     * Display a listing of the resource.
     */



     function __construct()
    {
       
         $this->middleware('permission:add-bills', ['only' => ['create','store']]);
         $this->middleware('permission:bill-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bill-delete', ['only' => ['destroy' , 'archive' , 'restore' , 'forceBill']]);
         $this->middleware('permission:bill-print', ['only' => ['printBill']]);
    }



    public function index()
    {   
        $bills = Bill::all() ;

        return view ('bills.total' , ['data' => $bills ]) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all() ;
        return view('bills.addBill' , ['category' => $category]) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
        'bill_number' =>        'required|Integer' ,
        'due_date'  =>          'date|required' ,
        'date'  =>              'date|required' ,
        'collected_amount'  => 'required' ,
        'Amount_Commission'  => 'required' ,
        'note' => 'max:255' ,
        ]);


       $bills = Bill::create([
        'bill_number' =>        $request->bill_number ,
        'category_id'  =>       $request->category ,
        'product'  =>           $request->product ,
        'date'  =>              $request->date ,
        'due_date'  =>          $request->due_date ,
        'amount_collection'  => $request->collected_amount ,
        'amount_commission'  => $request->Amount_Commission ,
        'discount'  =>          $request->Discount ,
        'value_VAT'  =>         $request->Value_VAT ,
        'rate_VAT'  =>          $request->Rate_VAT ,
        'total'  =>             $request->Total ,
        'status'  =>            'Un Paid' ,
        'value_status'  =>      2 ,
        'note'  =>              $request->note ,
        'user'  =>              Auth()->user()->name ,

       ]);

       $bill_ID = Bill::latest()->first()->id ;

       $details = Detail::create([
         'bill_number' =>      $request->bill_number ,
         'bill_id' =>          $bill_ID ,
         'product'  =>         $request->product ,
         'category_id'  =>     $request->category ,
         'status'  =>          2 ,
         'notes'  =>           $request->note ,
         'user'  =>            Auth()->user()->name ,
 
       ]);


       if ($request->hasFile('pic')) {

        $realPath = $request->file('pic')->getClientOriginalName();
        $file = $request->file('pic')->storeAs('BillAttachement' , $realPath , 'local');

       $attachment = BillAttachement::create([

        'file_name'   =>       $realPath ,
        'bill_number' =>       $request->bill_number ,
        'created_by'  =>       Auth()->user()->name ,
        'bill_id'     =>       $bill_ID ,

       ]);

       }

       if ($bills) {
    

        Mail::to($request->user())->send(new AddInvoice($bill_ID , $request->bill_number));

         Alert::success('Success ', 'Category inserted successfully');
         return redirect('/bills');
       }

    }

 

    public function changeStatus ($id) {
        $bill = Bill::where('id' , $id)->first() ;
        $category = Category::where('id' , $bill->category_id)->first();
        return view ('bills.changeStatus' , ['bill' => $bill , 'category' => $category]);
    }

    public function updateStatus (request $request , $id) {

        $request->validate([
            'payment_at' => 'required|date',
            'status'     => 'required',
        ]);

        if ($request->status == 'Paid') {

            $this->paid_Status = 'Paid' ;
            $this->value_Status = 1 ;

        }elseif ($request->status == 'UnPaid'){

            $this->paid_Status = 'UnPaid' ;
            $this->value_Status = 2 ;

        }elseif ($request->status == 'PartialyPaid'){

            $this->paid_Status = 'PartialyPaid' ;
            $this->value_Status = 3 ;

        }

        $bill = Bill::where('id' , $id)->update([
            'status' => $this->paid_Status ,
            'value_status' => $this->value_Status ,
        ]);

        $detail = Detail::where('bill_id' , $id)->create([
            'bill_number' => $request->bill_number ,
            'bill_id'     => $id ,
            'product'     => $request->product ,
            'category_id' => $request->category ,            
            'status'      => $this->value_Status , 
            'payment_at'  => $request->payment_at ,
            'notes'       => $request->note ,
            'user'        => Auth()->user()->name ,
        ]);

        if ($bill) {

    // Send Notification
        $user = User::where('id' , '!=' , Auth()->user()->id )->get();
        $bill_id = $id ;
        $bill_num = $request->bill_number ;
         Notification::send($user , new PaidBillNotification($bill_id , $bill_num)) ;


            Alert::success('Success ', 'Bill Status Updated successfully');
            return redirect('/bills') ;
        }

    }


    public function edit($id)
    {
        $bill = Bill::where('id' , $id)->first() ;
        $file = BillAttachement::where('bill_id' , $id)->first('file_name');
        $category = Category::all();
       return view ('bills.editBill' ,
        ['bill' => $bill , 'category' => $category , 'oldFile' => $file ]) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {

       $request->validate([
        'bill_number' =>        'required|Integer' ,
        'due_date'  =>          'date|required' ,
        'date'  =>              'date|required' ,
        'product' =>            'required',
        'Rate_VAT' =>           'required',
        'collected_amount'  => 'required' ,
        'Amount_Commission'  => 'required' ,
        'note' => 'max:255' ,
        ],[

            'Rate_VAT.required' => 'Please Select Taxes Rate',
        ]);

// Bill Updates

        $bill = Bill::where('id' , $id)->update([

        'bill_number'           => $request->bill_number,
        'category_id'           => $request->category ,
        'product'               => $request->product ,
        'date'                  => $request->date ,
        'due_date'              => $request->due_date,
        'amount_collection'     => $request->collected_amount,
        'amount_commission'     => $request->Amount_Commission,
        'discount'              => $request->Discount,
        'value_VAT'             => $request->Value_VAT,
        'rate_VAT'              => $request->Rate_VAT,
        'total'                 => $request->Total,
        'status'                => 'UnPaid' ,
        'value_status'          => 2 ,
        'note'                  => $request->note,
        'user'                  => Auth()->User()->name ,

            ]);

// Bill Details Update

        $details = Detail::where('bill_id' , $id)->update([
            'bill_number' => $request->bill_number ,
            'product'  => $request->product ,
            'category_id' => $request->category ,
            'notes'  => $request->note ,
            'user' => Auth()->user()->name ,

        ]);




// File Update
        if ($request->hasFile('pic')){

        $request->validate([
            'pic' => 'required|mimes:pdf,png,jpg,jpeg',
        ]);

            $realPath = $request->file('pic')->getClientOriginalName();
            $store = $request->file('pic')->storeAs('BillAttachement' , $realPath , 'local') ;

            // Delete Old File
            // Storage::delete('BillAttachement/'.$request->oldFile);

            $attachment = BillAttachement::create([
                'file_name'   =>       $realPath ,
                'bill_number' =>       $request->bill_number ,
                'created_by'  =>       Auth()->user()->name ,
                'bill_id'     =>       $id ,
            ]);


        } 

        if ($bill) {
        Alert::success('Success ', 'Bill Updated successfully');
        return redirect('/bills') ;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $id = $request->invoice_id ;

        $bill = Bill::where('id' , $id)->delete();
        if ($bill) {      
           Alert::success('Bill Deleted Successfully', 'you can restore data from settings');
           return redirect('/bills') ;
        }
        
    }


    public function archive () {
        $trached = Bill::onlyTrashed()->get();
        return view('bills.billsArchive' , ['data' => $trached ]) ;

    }

    public function restore (request $request) {
        $restore = Bill::withTrashed()->where('id' , $request->invoice_id)->restore();

        if ($restore) {
            Alert::success('Bill Restored', 'Bill Restored Successfully');
            return redirect('/bills');
        }
    }


    public function forceBill(request $request) {
            
            // Delete Files
        $file = BillAttachement::where('bill_id' , $request->invoice_id)->get('file_name');
            
            if ($file) {
                foreach($file as $f) {
            Storage::delete('BillAttachement/'.$f->file_name);
                }
            }

            // Delete files in database
        $forceDelete = Bill::withTrashed()->where('id' , $request->invoice_id )->forceDelete();

            if ($forceDelete) {
                Alert::success('Bill Deleted', 'Bill deleted from archive');
                return redirect('/bills');
            }
           

            

    }

    public function printBill ($id) {

        $bill = Bill::where('id' , $id)->first() ;
        return view('bills.printBill' , ['bill' => $bill ]) ;
    }


    public function Paid () {
        $paid = Bill::where('value_status' , '1')->get() ;
        return view('bills.Paid' , ['data' => $paid ]) ;
    }


     public function PartialyPaid () {
        $PartialyPaid = Bill::where('value_status' , '3')->get() ;
        return view('bills.PartialyPaid' , ['data' => $PartialyPaid ]) ;    
    }


     public function UnPaid () {
        $UnPaid = Bill::where('value_status' , '2')->get() ;
        return view('bills.UnPaid' , ['data' => $UnPaid ]) ;   
         }
}

