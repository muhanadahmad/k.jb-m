@extends('layouts.master')
@section('title', 'Setting - Ajyal Store')
@section('content')
<x-flash-message />


    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">

            <div class="card">
                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mt-4">
                    <h3 class="text-primary">Setting</h3>
              </div>
                <div class="card-body">


<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">

        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('setting.update',$setting) }}" method="post" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                @method('put')
                    <div class="row">
                        <div class="col-md-6 border-right-2 border-right-blue-400">

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Name Store <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input name="title" value="{{ old('title',$setting->title) }}" required type="text" class="form-control" placeholder="Name of School">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Phone</label>
                                <div class="col-lg-8">
                                    <input name="phone" value="{{old('phone', $setting->phone) }}" type="text" class="form-control" placeholder="Phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold"> Email</label>
                                <div class="col-lg-8">
                                    <input name="email" value="{{ old('email',$setting->email)}}" type="email" class="form-control" placeholder="School Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Address </label>
                                <div class="col-lg-8">
                                    <input required name="address" value="{{old('address', $setting->address) }}" type="text" class="form-control" placeholder="School Address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Facebbok</label>
                                <div class="col-lg-8">
                                    <input name="facebbok" value="{{ old('facebbok',$setting->facebbok)}}" type="text" class="form-control" placeholder="facebbok">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Twiter</label>
                                <div class="col-lg-8">
                                    <input name="twiter" value="{{ old('twiter',$setting->twiter)}}" type="text" class="form-control" placeholder="twiter">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Instagram</label>
                                <div class="col-lg-8">
                                    <input name="instagram" value="{{ old('instagram',$setting->instagram) }}" type="text" class="form-control" placeholder="instagram">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Logo <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <img style="width: 100px" height="100px" src="{{ asset('storage/'. $setting->logo) }}" alt="logo">
                                    </div>
                                    <input name="logo" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Favicon </label>
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <img style="width: 100px" height="100px" src="{{ asset('storage/'. $setting->favicon) }}" alt="favicon">
                                    </div>
                                    <input name="favicon" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Save Data')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->


                         </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@push('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
@endpush
