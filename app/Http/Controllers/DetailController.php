<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use App\Models\Category ;
use App\Models\BillAttachement ;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User ;



class DetailController extends Controller
{
   
    public function edit($id)
    {
        $detail = Detail::where('bill_id' ,$id)->get();
        $detailAll = Detail::where('bill_id' ,$id)->latest()->first();
        $file = BillAttachement::where('bill_id' , $id)->get() ;


//    Notification Mark As Read
         $user = User::find(Auth()->user()->id) ;
        foreach ($user->unreadNotifications as $notification) {
        $notification->markAsRead();
        }
//    Notification Mark As Read

        return view('bills.billDetails', 
            ['details' => $detail , 'file' => $file  , 'detailAll' => $detailAll ]) ;
    }

    public function downloadFile ($fileName) {

        return $contents = Storage::download('BillAttachement/'.$fileName);
        return redirect()->back();

    }

    public function DeleteFile($fileName) {
 
        Storage::delete('BillAttachement/'.$fileName);
        $file = BillAttachement::where('file_name' , $fileName)->delete() ;
        
        if ($file) {
        Alert::success('Success ', 'Attachment Deleted successfully');
        return redirect('/bills');
        }
    }

    public function openFile($fileName) {


        return response()->file('app/BillAttachement/'.$fileName);
    }

   
}
