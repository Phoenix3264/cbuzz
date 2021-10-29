@extends('template.color_admin_apple_v42.form')
@section('content')             
    <div id="content" class="content">
        <x-cv42.breadcrumb link2="{{ route($content.'.index') }}" level2="{{$panel_name}}" level3="Edit" />
        <x-cv42.pageheader header="{{$panel_name}}"/>
        <div class="panel panel-inverse">
            <x-cv42.panel-heading title="Form"/>
            <div class="panel-body">
                <form action="{{ route($content.'.update', $Postrawmatch->id) }}" method="POST" >
                    @csrf
                    @method('PUT')

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Round League" />
                        <div class="col-6  col-md-2">
                            <input type="number" 
                                name        = "leagues_id" 
                                class       = "form-control m-b-5 @error('nama') is-invalid @enderror" 
                                value       = "{{ old('title', $Postrawmatch->leagues_id) }}" disabled/>

                            @error('leagues_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-2">
                            <input type="number" 
                                name        = "round_league" 
                                class       = "form-control m-b-5 @error('nama') is-invalid @enderror" 
                                value       = "{{ old('title', $Postrawmatch->round_league) }}" disabled/>
                                
                            @error('round_league')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>

                    <div class="form-group row m-b-15">
                        <x-cv42.label-form title="Club" />
                        <div class="col-6  col-md-4">
                            <select 
                                name        = "home_clubs_id" 
                                class       = "form-control m-b-5 @error('home_clubs_id') is-invalid @enderror" 
                                disabled/>

                                <option value="">
                                    Choose Club
                                </option>
                                @foreach ($club as $row)
                                    <option value="{{$row->id}}"
                                        @if($row->id == $Postrawmatch->home_clubs_id)
                                            selected
                                        @endif
                                        >
                                        {{$row->nama}}
                                    </option>
                                @endforeach

                            </select>
                                
                            <!-- error message untuk title -->
                            @error('home_clubs_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>  

                        <div class="col-6  col-md-4">
                            <select 
                                name        = "away_clubs_id" 
                                class       = "form-control m-b-5 @error('away_clubs_id') is-invalid @enderror" 
                                disabled/>

                                <option value="">
                                    Choose Club
                                </option>
                                @foreach ($club as $row)
                                    <option value="{{$row->id}}"
                                        @if($row->id == $Postrawmatch->away_clubs_id)
                                            selected
                                        @endif
                                        >
                                        {{$row->nama}}
                                    </option>
                                @endforeach

                            </select>
                                
                            <!-- error message untuk title -->
                            @error('away_clubs_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Raw Text -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Raw Text" />
                        <div class="col-12  col-md-8">
                            <textarea 
                                class       = "form-control" 
                                name        = "raw_text"
                                rows        ="7">{{ old('title', $Postrawmatch->raw_text) }}</textarea>

                            @error('raw_text')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>          
                    </div>
                    
                    <div class="form-group row m-b-15"> 
                        <div class="col-md-8 offset-md-2">
                            <x-cv42.button-submit />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
@endsection
