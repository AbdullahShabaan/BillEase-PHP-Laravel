<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     function __construct()
    {
       
         $this->middleware('permission:all-category', ['only' => ['index','show']]);
         $this->middleware('permission:add-category', ['only' => ['create','store']]);
         $this->middleware('permission:edit-category', ['only' => ['edit','update' ]]);
         $this->middleware('permission:delete-category', ['only' => ['destroy']]);
    }


    public function index()
    {
        $category = Category::all() ;
        return view ('categories.categories' , ['data' => $category]) ;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|String|unique:categories|max:15|min:2',
            'description' => 'required|String|max:25|min:3'
        ],[
            'name.unique' => 'this category already exists',

        ]);

        $cat = Category::create([
            'name' => $request->name ,
            'description' => $request->description ,
            'created_by' => Auth()->User()->name

        ]);

        if ($cat) {

            Alert::success('Success ', 'Category inserted successfully');
            return redirect('/categories') ;
        }


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $cat = Category::where('id' , $id)->get();
        return view('categories.editCategory' , ['data' => $cat] ) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, $id)
    {

        $r->validate([
            'name' => 'required|max:15|min:2',
            'description' => 'required|max:25|min:3'
        ],[
            'name.unique' => 'this category already exists',
            'name.regex' => 'you can\'t insert numbers in name field',
            'description.regex' => 'you can\'t insert numbers in description field',
        ]);


        $update = Category::findOrFail($id);
        $update->name = $r->name ;
        $update->description = $r->description ;
        $update-> save() ;


        if ($update){

            Alert::success('Success', 'Category Updated');

            return redirect('/categories');
        }else {
           Alert::info('warning', 'nothing changed!');

            return redirect('/categories');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $cat = Category::findOrFail($id)->delete() ;

       if ($cat) {

        Alert::success('Category Deleted', 'You can restore category from settings');
       return redirect ('/categories') ;

       }
    }

    public function getproducts($id) {

        $products = DB::table('products')->where('category_id' , $id)->pluck('name' , 'id');
        return json_encode($products) ;
    }
}
