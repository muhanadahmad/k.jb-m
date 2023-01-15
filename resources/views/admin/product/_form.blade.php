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
    <x-form.input lable="Name" type="text" name="name" :value="$product->name" />
</div><br>
<div class="row">
    <x-form.input lable="Price" type="number" name="price" :value="$product->price" />
    <x-form.input lable="Discount" type="number" name="discount" :value="$product->discount" />

</div><br>
<div class="row">
    <div class="col-6">

        <label for="inputName" class="control-label">Category </label>
        <select name="category_id" @class([
            'form-control ',
            'SlectBox',
            'is-invalid' => $errors->has('category_id'),
        ]) onclick="console.log($(this).val())"
            onchange="console.log('change is firing')">
            <!--placeholder-->
            <option value="" selected disabled>Primary Category</option>
            @foreach ($category as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                    {{ $category->name }}</option>
            @endforeach
            @error('category_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </select>
    </div>

    <x-form.status lable="Status" name="status" :value="$product->status" :option="['active' => 'Active', 'inactive' => 'Inactive']" />

</div><br>
<div class="row">
    <x-form.textarea lable="Notes" name="notes" :value="$product->notes" />

</div><br>

<div class="row"></div>
<h5 class="">Image</h5>
<x-form.input type="file" name="image" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
    data-height="70" />


</div><br>

<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary">ٍSave Data</button>
</div><br><br>
