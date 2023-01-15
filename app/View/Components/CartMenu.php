<?php

namespace App\View\Components;

use App\Repositories\Cart\CartModelRepository;
use Illuminate\View\Component;

class CartMenu extends Component
{
    public $total;
    public $item;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CartModelRepository $cart)
    {
        $this->item=$cart->get();
        $this->total=$cart->total();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
