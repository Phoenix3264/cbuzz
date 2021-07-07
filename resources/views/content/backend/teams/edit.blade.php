<form action="" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group row m-b-15">
        <label class="col-form-label col-md-2">
            Nama
        </label>
        <div class="col-md-5">
            <input type="text" 
                name        = "nama" 
                value       = "{{ old('nama', $label->nama) }}" 
                class       = "form-control m-b-5 @error('nama') is-invalid @enderror" 
                placeholder = "Nama" />
                
            <!-- error message untuk title -->
            @error('nama')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

    </div>
    <div class="form-group row m-b-15">
        <label class="col-form-label col-md-2">
        </label>
        <div class="col-md-8">
            <button type="submit" class="btn btn-sm btn-primary  btn-block  ">
                Submit  {{$label->nama}}
            </button>
        </div>
    </div>
</form>
