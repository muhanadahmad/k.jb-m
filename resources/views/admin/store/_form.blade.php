@if($errors->any())
<div class="alert alert-danger">
    <h3>Error Occured</h3>
    <ul>
    @foreach ($errors->all() as $err)
        <li class="text-danger">{{$err}}</li>
    @endforeach
    </ul>
</div>
@endif
                        <div class="row">
                            <x-form.input lable="Name" type="text" name="name" :value="$store->name" />

                          <x-form.status lable="Status" name="status" :value="$store->status" :option="['active'=>'Active','inactive'=>'Inactive']" />



                           <x-form.textarea lable="Notes" name="notes" :value="$store->notes"/>



                        </div>


                        <h5 class="">Logo Image</h5>
                        <x-form.input  type="file" name="logo_image" class="dropify"
                        accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />

                        <h5 class="">Cover Image</h5>
                        <x-form.input  type="file" name="cover_image" class="dropify"
                        accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />


                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">ٍSave Data</button>
                        </div>
