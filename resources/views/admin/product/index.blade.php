@extends('layouts.master')
@section('title', 'Product - Ajyal Store')
@section('breadcrumb', 'product')

@section('content')
    <!-- row opened -->
    <div class="row row-sm">


        <!--div-->
        <div class="col-xl-12">
            <x-flash-message />


            <div class="card">

                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mt-4">
                    <a class="modal-effect btn btn-outline-primary " data-effect="effect-super-scaled"
                        href="{{ route('product.create') }}">Add Product</a>
                    <a class="modal-effect btn btn-outline-danger " data-effect="effect-super-scaled"  href="{{ route('product.trash') }}">Trash</a>

                </div>
                <div class="card-body">
                    <h3 class="card-title">Product</h3>
                    <br>


                    <form action="{{route('product.index')}}" method="get" class="d-flex justify-content-between mb-4">
                        <input name="name" value="{{request('name')}}" placeholder="Enter name" class="form-control  mx-2">
                        <input name="created_at" type="date" value="{{request('created_at')}}" placeholder="Enter Created At" class="form-control  mx-2">

                    </select>

                            <button type="submit" class="btn bt-sm btn-primary">Filter</button>
                        </form>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Store</th>
                                    <th>Status</th>
                                    <th>Creaed At</th>
                                    <th>Opreation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($product as $product)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td><img src="{{ asset('storage/' . $product->image) }}" width="50"
                                                height="50" alt="{{ $product->name }}"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->store->name }}</td>
                                        <td>
                                            @if ($product->status == 'active')
                                                <span class="text-success">{{ $product->status }}</span>
                                            @else
                                                <span class="text-danger">{{ $product->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item"
                                                        href=" {{ route('product.edit', $product->id) }}">Update
                                                    </a>
                                                    <form action="{{ route('product.destroy', $product->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="dropdown-item" href="#"
                                                            data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9">No product defined.</td>
                                    </tr>
                                    @endforelse
                            </tbody>
                        </table>
                        {{-- $product->links() --}}{{-- $product->links('pagintor.custom') --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
