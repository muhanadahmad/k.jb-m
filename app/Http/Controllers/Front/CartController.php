<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart= new CartModelRepository();
        return view('front.cart',compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);

        $product_id = Product::findOrFail($request->post('product_id'));
        $cart= new CartModelRepository();
        $cart->add($product_id,$request->post('quantity'));
       // dd($cart);

        return redirect()->route('cart.index')
        ->with('success', 'Product added to cart!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity'=>'required|int|min:0',
        ]);
        $cart= new CartModelRepository();
        $cart->update($id,$request->post('quantity'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart= new CartModelRepository();
        $cart->delete($id);
      return redirect()->route('cart.index');
    }
}
