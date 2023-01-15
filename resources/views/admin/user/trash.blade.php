@extends('layouts.master')
@section('title','-Category')
@section('breadcrumb','Category')

@section('content')
				<!-- row opened -->
				<div class="row row-sm">


					<!--div-->
					<div class="col-xl-12">

						<div class="card">
                            @if(session()->has('success'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                <div>
                                  {{session('success')}}
                                </div>
                              </div>
                            @endif


                            <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                                <a class="modal-effect btn btn-outline-primary " data-effect="effect-super-scaled"  href="{{route('category.index')}}">Back</a>

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
                                          @foreach ($category as $category)

                                      <tr>
                                          <th scope="row">{{$category->id}}</th>
                                          <td><img src="{{asset('storage/'.$category->image)}}" width="50" height="50" alt="{{$category->name}}"></td>
                                          <td>{{$category->name}}</td>

                                          <td>
                                            @if ($category->status == 'active')
                                            <span class="text-success">{{ $category->status }}</span>
                                            @else
                                            <span class="text-danger">{{ $category->status }}</span>

                                            @endif
                                          </td>
                                          <td>{{$category->deleted_at}}</td>
                                          <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <form action="{{ route('category.restore',$category->id ) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                <button class="dropdown-item" href="#"
                                                     data-target="#delete_invoice"><i
                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;Restore
                                                </button>
                                                    </form>
                                                    <form action="{{ route('category.forceDelete',$category->id ) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                <button class="dropdown-item" href="#"
                                                     data-target="#delete_invoice"><i
                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;Delete
                                                </button>
                                                    </form>
{{--
                                                    <a class="dropdown-item"
                                                    href=" {{route('showDetailsInvoice',$invoice->id)}}">عرض
                                                    الفاتورة</a>


                                                        <a class="dropdown-item"
                                                            href=" {{route('invoices.edit',$invoice->id) }}">تعديل
                                                            الفاتورة</a>


                                                            <form action="{{ route('invoices.destroy',$invoice->id ) }}" method="post">
                                                                {{ method_field('delete') }}
                                                                {{ csrf_field() }}
                                                        <button class="dropdown-item" href="#"
                                                             data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                        </button>
                                                            </form>
                                                            <a class="dropdown-item"
                                                            href="{{ route('invoiceDetail.edit', [$invoice->id]) }}"><i
                                                                class=" text-success fas"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                            حالة
                                                            الدفع</a>

                                                        <a class="dropdown-item"
                                                            href="{{ URL::route('Status_show', [$invoice->id]) }}"><i
                                                                class=" text-success fas
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                            حالة
                                                            الدفع</a>

                                                        <a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                            data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي

                                                        <a class="dropdown-item" href="{{ route('printInvoiceTeacher',$invoice->id) }}"><i
                                                                class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                            الفاتورة
                                                        </a>
--}}
                                                </div>
                                            </div>

                                        </td>
                                      </tr>
                                          @endforeach
										</tbody>
									</table>
                                    {{-- $category->links() --}}{{--$category->links('pagintor.custom')--}}
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
