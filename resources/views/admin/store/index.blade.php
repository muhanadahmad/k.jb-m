@extends('layouts.master')
@section('title', 'Store - Ajyal Store')
@section('breadcrumb', 'Store')

@section('content')
    <!-- row opened -->
    <div class="row row-sm">


        <!--div-->
        <div class="col-xl-12">
            <x-flash-message />

            <div class="card">


                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mt-4">
                    <a class="modal-effect btn btn-outline-primary " data-effect="effect-super-scaled"
                        href="{{ route('store.create') }}">Add Store</a>
                    <!-- <a class="modal-effect btn btn-outline-dark " data-effect="effect-super-scaled"  href="{{-- route('Store.trash') --}}">Trash</a>-->

                </div>
                <div class="card-body">
                    <div class="card-body">
                        <h3 class="card-title ">Store</h3>
                        <br>
                        <form action="{{route('store.index')}}" method="get" class="d-flex justify-content-between mb-4">
                            <input name="name" value="{{request('name')}}" placeholder="Enter name" class="form-control  mx-2">
                            <input name="created_at" value="{{request('created_at')}}" type="date" placeholder="Enter Created At" class="form-control  mx-2">

                        </select>

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
                                    <th>status</th>
                                    <th>Creaed At</th>
                                    <th>Opreation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($store as $store)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td><img src="{{ asset('storage/' . $store->logo_image) }}" width="50"
                                                height="50" alt="{{ $store->name }}"></td>
                                        <td>{{ $store->name }}</td>
                                        <td>
                                            @if ($store->status == 'active')
                                                <span class="text-success">{{ $store->status }}</span>
                                            @else
                                                <span class="text-danger">{{ $store->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $store->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item"
                                                        href=" {{ route('store.edit', $store->id) }}">Update
                                                    </a>
                                                    <form action="{{ route('store.destroy', $store->id) }}"
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
                                        <td colspan="9">No Store defined.</td>
                                    </tr>
                                    @endforelse
                            </tbody>
                        </table>
                        {{-- $store->links() --}}{{-- $store->links('pagintor.custom') --}}
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
