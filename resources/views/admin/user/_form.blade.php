@if ($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occured</h3>
        <ul>
            @foreach ($errors->all() as $err)
                <li class="text-danger">{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <x-form.input lable="Name" type="text" name="name" :value="$user->name" />
</div>
<div class="row">
    <x-form.input lable="Email" type="email" name="email" :value="$user->email" />
    <x-form.input lable="Password" type="password" name="password" :value="$user->password" />
</div>
<div class="row">

<div class="col-12">

    <label for="inputName" class="control-label">Store</label>
    <select name="store_id" @class([
        'form-control ',
        'SlectBox',
        'is-invalid' => $errors->has('store_id'),
    ]) onclick="console.log($(this).val())"
        onchange="console.log('change is firing')">
        <!--placeholder-->
        <option value="" selected disabled>Store</option>
        @foreach ($store as $store)
            <option value="{{ $store->id }}" @selected(old('store_id', $user->store_id) == $store->id)>
                {{ $store->name }}</option>
        @endforeach
        @error('store_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </select>
</div>
<x-form.status lable="Status" name="status" :value="$user->status" :option="['active' => 'Active', 'inacteve' => 'Inactive']" />

</div>






</div>



<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary">ٍSave Data</button>
</div>
<br><
<br>
