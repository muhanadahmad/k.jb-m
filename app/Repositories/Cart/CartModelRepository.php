<?php
namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartModelRepository implements CartRepository
{
    public function get(): Collection
    {
        return Cart::with('product')->get();
    }
    public function add(Product $product, $quantity)
    {
        $cart = Cart::where('product_id', '=', $product->id)
            ->first();
        if (!$cart) {
            return Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }
        return $cart->increment('quantity', $quantity);

    }
    public function update($id, $quantity)
    {
        return Cart::where('id', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id)
    {
        Cart::where('id', $id)->delete();

    }
    function empty() {
        Cart::query()->destroy();

    }
    public function total(): float
    {
       // dd('dd');
        return (float) Cart::join('products as p', 'p.id', '=', 'carts.product_id')
            ->selectRaw('sum(quantity * p.price) as total')
            ->value('total');

    }
}
