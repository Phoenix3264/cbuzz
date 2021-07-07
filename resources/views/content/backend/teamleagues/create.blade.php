@extends('template.color_admin_apple_v42.form')
@section('title', str_replace("_"," ", $content))
@section('sidebar')    
@endsection

@section('content')    
    <form action="{{ route('Teamleagues.store') }}" method="POST">
        @csrf

        <div class="form-group row m-b-15">
            <x-label-form-cv42 title="Leagues" />
            <div class="col-md-6">
                <select 
                    name        = "leagues_id" 
                    class       = "form-control m-b-5 @error('leagues_id') is-invalid @enderror" 
                    >
                    <option value="{{$leagues_id}}">
                        {{$league_name}}
                    </option>
                </select>
                    
                <!-- error message untuk title -->
                @error('leagues_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>


        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="Teams" />
            <div class="col-md-6">
                <select 
                    name        = "teams_id" 
                    class       = "form-control m-b-5 @error('teams_id') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih Teams
                    </option>
                    @foreach ($teams as $row)
                        <option value="{{$row->id}}">
                            {{$row->nama}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('teams_id')
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
