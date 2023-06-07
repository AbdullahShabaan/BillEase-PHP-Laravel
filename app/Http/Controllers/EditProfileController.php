<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User ;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class EditProfileController extends Controller
{
    public function update (request $request) {

        if ($request->hasFile('img')){
            $request->validate([
                'img' => 'image',
            ]);

            $realPath = $request->file('img')->getClientOriginalName();
            $store = $request->file('img')->storeAs('ProfilePic' , $realPath , 'local');

            $user = User::findOrFail(Auth()->user()->id)->update([
                'img' => $realPath ,
            ]);

        }

        if (!empty ($request->password1)){

        $request->validate([
            'name' => 'String|max:20|min:2,name,' .Auth()->user()->name,
            'email' => 'email|unique:users,email,'.Auth()->user()->id,
            'password1' => 'max:15|min:6',
        ],[
            'password1.max' => 'password must be less than 15 char',
            'password1.min' => 'password must be more than 6 char',
        ]);



            if ($request->password1 == $request->password2 ) {

                $user = User::findOrFail(Auth()->user()->id)->update([
                    'name' => $request->name , 
                    'email' => $request->email , 
                    'password' => Hash::make($request->password) , 

                ]);

        }else {
            Alert::error('Failed ', '!Password not match');
            return redirect ('/profile') ;
        }

    }else {


          $request->validate([
            'name' => 'String|max:20|min:2,name,' .Auth()->user()->name,
            'email' => 'email|unique:users,email,'.Auth()->user()->id,
        ]);


                $user = User::findOrFail(Auth()->user()->id)->update([
                    'name' => $request->name , 
                    'email' => $request->email , 
                ]);


    }
    
        Alert::success('Updated ', 'your information updated successfully');

        return redirect('/profile');
    



    }
}
