@extends('template.color_admin_apple_v42.form')
@section('title', str_replace("_"," ", $content))
@section('sidebar')    
@endsection

@section('content')    
    <form action="{{ route($content.'.store') }}" method="POST">
        @csrf
        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="Nama" />
            <div class="col-md-5">
                <input type="text" 
                    name        = "nama" 
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
            <x-label-form-cv42 title="" />
            <div class="col-md-8">
                <x-button-submit />
            </div>
        </div>
    </form>
@endsection
