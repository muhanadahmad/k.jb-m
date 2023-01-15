@props(['name','type'=>'text', 'lable' => false,  'value' => ''])
<div class="col">
    @if ($lable)
        <label for="" class="text-capitalize ">{{ $lable }}</label>
    @endif
    <input type="{{ $type }}"
           name="{{ $name }}"
           value="{{ old($name, $value) }}"
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
           id=""
           placeholder=""
        >
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
