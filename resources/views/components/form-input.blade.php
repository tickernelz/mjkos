<div class="col-sm-6 mb-3 mt-3 mb-sm-0">
    <span style="color:red;">{{ $required ? '*' : '' }}</span>{{$label}}</label>
    <input autocomplete="off" type="{{ $type }}" name="{{ $name }}" value="{{ $value ?? old($name) }}"
        class="form-control form-control-user @error('{{$name}}') is-invalid @enderror" id="exampleName"
        placeholder="{{$label}}" {{ $required ?? '' }} {{ $disabled }} {{$type == 'number' ? `oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"` : ''}}>

    @error('{{$name}}')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>
