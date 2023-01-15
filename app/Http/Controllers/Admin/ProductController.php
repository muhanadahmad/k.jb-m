<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request=request();
        //$product=Product::join('stores as s','s.id','=','products.store_id')->select('products.*','s.name as nameStore')->get();
        $product = Product::with(['category','store'])->Filter($request->query())->latest()->paginate(10);
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category= Category::all();
        $store= Store::all();
        $product = new Product();
        return view('admin.product.create', compact('product', 'category','store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')) { //check isset image

            $file = $request->file('image'); //return object
            $path = $file->store('uploads', ['disk' => 'public']);
            $data['image'] = $path;
        }
        $store_id=Auth::user()->store_id;
        if($store_id){
            $data['store_id'] =$store_id;
           //dd($data['store_id'] );
           Product::create($data);
           return redirect()->route('product.index')->with('success', __('operation addion accomplished successfully'));
        }
          return redirect()->route('product.index')->with('error', __('Sorry , Dear user, you do not have a store to add the product to'));

      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $store= Store::all();
        $category= Category::all();
        return view('admin.product.edit', compact('product', 'store','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $old_image = $product->image;
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', ['disk' => 'public']);
            $data['image'] = $path;
        }
        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }
        $product->update($data);

        return redirect()->route('product.index')->with('success', 'operation accomplished successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
      if($product->image){
            Storage::disk('public')->delete($product->image);
       }
        return redirect()->route('product.index')->with('success', 'operation accomplished successfully');
    }
    public function trash()
    {
       $product = Product::onlyTrashed()->get();
       return view('admin.product.trash',compact('product'));
    }
    public function restore($id)
    {
       $product = Product::onlyTrashed()->findOrFail($id);
       $product->restore();
       return redirect()->route('product.trash')->with('success', 'operation accomplished successfully');
    }
    public function forceDelete($id)
    {
       $product = Product::onlyTrashed()->findOrFail($id);
       $product->forceDelete();
       return redirect()->route('product.trash')->with('success', 'operation accomplished successfully');
    }
}
