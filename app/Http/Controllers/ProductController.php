<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category ;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */


      function __construct()
    {
       
         $this->middleware('permission:all-products', ['only' => ['index','show']]);
         $this->middleware('permission:add-products', ['only' => ['store']]);
         $this->middleware('permission:edit-products', ['only' => ['edit','update' ]]);
         $this->middleware('permission:delete-products', ['only' => ['destroy']]);
    }



    public function index()
    {
       $product = Product::all();
       $category = Category::all();
 
       return view ('products.products' , ['data' => $product , 'category' => $category]) ;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'bail|String|required|max:15|min:2',
        'description' => 'required|String|max:30',
        'price' => 'Integer|required',
        'status' => 'required',
        'category' => 'required',
       ],[

        'name.String' => "you can\'t add numbers or @#$% in name field " ,
        'description.String' => "you can\'t add numbers or @#$% in description field " ,

       ]);

       $product = Product::create([
        'name' => $request->name ,
        'description' => $request->description ,
        'price' => $request->price ,
        'status' => $request->status ,
        'category_id' => $request->category ,
        'user' => Auth()->user()->name,
        'date' => now()
       ]);

       if ($product) {
        Alert::success('Success ', 'Product inserted successfully');
        return redirect('/products');
       }else {
        Alert::info('Warning ', '!Nothing Inserted');
        return redirect('/products');
       }


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $cat = Category::all() ;
       $product = Product::where('id' , $id)->get() ;
       return view('products.editProduct' , ['data' => $product , 'category' => $cat ]) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $request->validate([
        'name' => 'bail|String|required|max:15|min:2',
        'description' => 'required|String|max:30',
        'price' => 'required',
        'status' => 'required',
        'category' => 'required',
     ]);

       $product = Product::findOrFail($id)->update([
        'name' => $request->name ,
        'description' => $request->description ,
        'price' => $request->price ,
        'status' => $request->status ,
        'category_id' => $request->category ,
        'user' => Auth()->user()->name,
        'date' => now()   
       ]);




       if($product) {
      Alert::success('Success ', 'Product Updated successfully'); 
       return redirect('/products');
      }else {
         echo "no";
      }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete() ;
        if ($product) {
         Alert::success('Product Deleted ', 'you can restore data from settings'); 
         return redirect('/products') ;
        }
    }
}
