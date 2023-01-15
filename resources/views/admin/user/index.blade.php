@extends('layouts.master')
@section('title', 'User - Ajyal Store')
@section('breadcrumb', 'User')

@section('content')
    <!-- row opened -->
    <div class="row row-sm">


        <!--div-->
        <div class="col-xl-12">

            <x-flash-message />

            <div class="card">



                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mt-4">
                    <a class="modal-effect btn btn-outline-primary " data-effect="effect-super-scaled"
                        href="{{ route('user.create') }}">Add User</a>
                    <!-- <a class="modal-effect btn btn-outline-dark " data-effect="effect-super-scaled"  href="{{-- route('User.trash') --}}">Trash</a>-->

                </div>
                <div class="card-body">
                    <h3 class="card-title">User</h3>
                    <br>


                    <form action="{{route('user.index')}}" method="get" class="d-flex justify-content-between mb-4">
                        <input name="name" value="{{request('name')}}" placeholder="Enter name" class="form-control  mx-2">
                        <select name="status" class="form-control  mx-2">
                            <option value="" >All</option>
                        <option value="active" @selected(request('status' == 'active'))>Active</option>
                        <option value="archived" @selected(request('status' == 'inacteve'))>Inactive</option>

                    </select>

                            <button type="submit" class="btn bt-sm btn-primary">Filter</button>
                        </form>



                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Store</th>
                                    <th>status</th>
                                    <th>Creaed At</th>
                                    <th>Opreation</th>
                                </tr>
                            </thead>
                            <tbody>
                                  @forelse ($user as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->index }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->store_id)
                                                <span class="text-success">{{$user->store->name }}</span>
                                            @else
                                                <span class="text-danger">{{ $user->store->name }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->status == 'active')
                                                <span class="text-success">{{ $user->status }}</span>
                                            @else
                                                <span class="text-danger">{{ $user->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">Opreation<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item"
                                                        href=" {{ route('user.edit', $user->id) }}">Update
                                                    </a>
                                                    <form action="{{ route('user.destroy', $user->id) }}"
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
                        {{-- $user->links() --}}{{-- $user->links('pagintor.custom') --}}
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
