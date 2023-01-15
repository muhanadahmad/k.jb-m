@extends('layouts.master')
@section('title','Trash-product')
@section('breadcrumb','product')

@section('content')
				<!-- row opened -->
				<div class="row row-sm">


					<!--div-->
					<div class="col-xl-12">
                        <x-flash-message />



                            <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                                <a class="modal-effect btn btn-outline-primary " data-effect="effect-super-scaled"  href="{{route('product.index')}}">Back</a>

                          </div>

							<div class="card-body">

								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>ID</th>
                                                <th>Image</th>
												<th>Name</th>
                                                <th>status</th>
                                                <th>Deleted At</th>
                                                <th>Opreation</th>
											</tr>
										</thead>
										<tbody>
                                          @foreach ($product as $product)

                                      <tr>
                                          <th scope="row">{{$product->id}}</th>
                                          <td><img src="{{asset('storage/'.$product->image)}}" width="50" height="50" alt="{{$product->name}}"></td>
                                          <td>{{$product->name}}</td>

                                          <td>
                                            @if ($product->status == 'active')
                                            <span class="text-success">{{ $product->status }}</span>
                                            @else
                                            <span class="text-danger">{{ $product->status }}</span>

                                            @endif
                                          </td>
                                          <td>{{$product->deleted_at}}</td>
                                          <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <form action="{{ route('product.restore',$product->id ) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                <button class="dropdown-item" href="#"
                                                     data-target="#delete_invoice"><i
                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;Restore
                                                </button>
                                                    </form>
                                                    <form action="{{ route('product.forceDelete',$product->id ) }}" method="post">
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
                                          @endforeach
										</tbody>
									</table>
                                   </div></div>
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
