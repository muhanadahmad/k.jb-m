@extends('layouts.master')
@section('title', 'Category - Ajyal Store')
@section('breadcrumb', 'Category')

@section('content')
    <!-- row opened -->
    <div class="row row-sm">


        <!--div-->
        <div class="col-xl-12">
            <x-flash-message />

            <div class="card">


                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mt-4">
                    <a class="modal-effect btn btn-outline-primary " data-effect="effect-super-scaled"
                        href="{{ route('category.create') }}">Add Category</a>
                    <!-- <a class="modal-effect btn btn-outline-dark " data-effect="effect-super-scaled"  href="{{-- route('category.trash') --}}">Trash</a>-->

                </div>
                <div class="card-body">
                    <h3 class="card-title">Category</h3>
                    <br>
                    <form action="{{route('category.index')}}" method="get" class="d-flex justify-content-between mb-4">
                        <input name="name" value="{{request('name')}}" placeholder="Enter name" class="form-control  mx-2">
                        <select name="parent_id" class="form-control  mx-2">
                            <option value="" >All</option>
                        <option value="active" @selected(request('parent_id' == 'main'))>الرئسية </option>
                        <option value="archived" @selected(request('parent_id' == 'sub'))>الفرعية</option>

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
                                    <th>Parent</th>
                                    <th>status</th>
                                    <th>Creaed At</th>
                                    <th>Opreation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($category as $category)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1}}</th>
                                        <td><img src="{{ asset('storage/' . $category->image) }}" width="50"
                                                height="50" alt="{{ $category->name }}"></td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->parent->name }}</td>
                                        <td>
                                            @if ($category->status == 'active')
                                                <span class="text-success">{{ $category->status }}</span>
                                            @else
                                                <span class="text-danger">{{ $category->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item"
                                                        href=" {{ route('category.edit', $category->id) }}">Update
                                                    </a>
                                                    <form action="{{ route('category.destroy', $category->id) }}"
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
                                        <td colspan="9">No categories defined.</td>
                                    </tr>
                                    @endforelse
                            </tbody>
                        </table>
                        {{-- $category->links() --}}{{-- $category->links('pagintor.custom') --}}
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
