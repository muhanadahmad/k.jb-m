@extends('front.layouts.master')
@section('title')
    Cart
@endsection

@section('body')
    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->
                <!-- Cart Single List list -->
                @foreach ($cart->get() as $item)
                    <div class="cart-single-list">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="product-details.html"><img src="{{ $item->product->image_url }}"
                                        alt="#"></a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name"><a href="product-details.html">
                                        {{ $item->product->name }}</a></h5>
                                <p class="product-des">
                                    <span><em>Type:</em> Mirrorless</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input"><input class="form-control item-quantity" name="quantity"
                                        data-id="{{ $item->id }}" value="{{ $item->quantity }}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ Currency::format($item->product->price - $item->product->discount * $item->quantity) }}
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ Currency::format($item->product->discount * $item->quantity) }}</p>
                            </div>

                            <div class="col-lg-1 col-md-2 col-12">
                                <form action="{{ route('cart.destroy',$item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="remove-item" href="javascript:void(0)"><i class="lni lni-close"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- End Single List list -->
                <!-- End Single List list -->
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal<span>{{ Currency::format($cart->total()) }}</span></li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You Save<span>$29.00</span></li>
                                        <li class="last">You Pay<span>$2531.00</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="checkout.html" class="btn">Checkout</a>
                                        <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
    @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


        (function($) {

        $('.item-quantity').on('change', function(e) { //class item-quantity

        $.ajax({
        url: "/cart/" + $(this).data('id'), //data-id
        method: 'put',
        data: {
        quantity: $(this).val(),
        _token: csrf_token
        }
        });
        });

        $('.remove-item').on('click', function(e) {

        let id = $(this).data('id');
        $.ajax({
        url: "/cart/" + id, //data-id
        method: 'delete',
        data: {
        _token: csrf_token
        },
        success: response => {
        $(`#${id}`).remove();
        }
        });
        });

        $('.add-to-cart').on('click', function(e) {

        $.ajax({
        url: "/cart",
        method: 'post',
        data: {
        product_id: $(this).data('id'),
        quantity: $(this).data('quantity'),
        _token: csrf_token
        },
        success: response => {
        alert('product added')
        }
        });
        });

        })(jQuery);
    @endpush
@endsection
