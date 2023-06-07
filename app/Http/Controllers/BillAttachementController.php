<?php

namespace App\Http\Controllers;

use App\Models\BillAttachement;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BillAttachementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pic' => 'required|mimes:pdf,png,jpg,jpeg',
        ]);

        $realPath = $request->file('pic')->getClientOriginalName();
        $store = $request->file('pic')->storeAs('BillAttachement' , $realPath , 'local');

        $file = BillAttachement::create([
            'bill_number' => $request->bill_number ,
            'bill_id'     => $request->bill_id ,
            'created_by'  => Auth()->user()->name ,
            'file_name'   => $realPath ,
        ]);


       if ($file ) {
       Alert::success('Success ', 'Category inserted successfully');
       return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BillAttachement $billAttachement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillAttachement $billAttachement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillAttachement $billAttachement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillAttachement $billAttachement)
    {
        //
    }
}
