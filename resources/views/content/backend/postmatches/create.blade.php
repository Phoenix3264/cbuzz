@extends('template.color_admin_apple_v42.form')
@section('title', str_replace("_"," ", $content))
@section('sidebar')    
@endsection

@section('content')    
    <form action="{{ route('Postmatches.store') }}" method="POST">
        @csrf

        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="Matches" />
            <div class="col-md-6">
                <input type="text" 
                    class       = "form-control m-b-5" 
                    value       = "{{$country_name}} {{$league_name}} {{$league_year}}" 
                    disabled 
                    />                    
            </div>


            <div class="col-md-3">
                <input type="text" 
                    name        = "leagues_id" 
                    class       = " form-control m-b-5 @error('leagues_id') is-invalid @enderror" 
                    value       = "{{$leagues_id}}" 
                    />
                    
                <!-- error message untuk title -->
                @error('leagues_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="League Round" />

            <div class="col-md-3">
                <input type="text" 
                    name        = "round_league" 
                    class       = " form-control m-b-5 @error('round_league') is-invalid @enderror" 
                    placeholder = "League Round" 
                    />
                    
                <!-- error message untuk title -->
                @error('round_league')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        </div>

        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="Home" />
            <div class="col-md-3">
                <select 
                    name        = "home_teams_id" 
                    class       = "form-control m-b-5 @error('home_teams_id') is-invalid @enderror" 
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
                @error('home_teams_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3">
                <input type="text" 
                    name        = "home_goals" 
                    class       = "form-control m-b-5 @error('home_goals') is-invalid @enderror" 
                    placeholder = "Home Goals" 
                    />                    
                <!-- error message untuk title -->
                @error('home_goals')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="col-md-3">
                <input type="text" 
                    name        = "home_corners" 
                    class       = "form-control m-b-5 @error('home_corners') is-invalid @enderror" 
                    placeholder = "Home Corner" 
                    />                    
                <!-- error message untuk title -->
                @error('home_corners')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        </div>

        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="Away" />
            <div class="col-md-3">
                <select 
                    name        = "away_teams_id" 
                    class       = "form-control m-b-5 @error('away_teams_id') is-invalid @enderror" 
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
                @error('away_teams_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3">
                <input type="text" 
                    name        = "away_goals" 
                    class       = "form-control m-b-5 @error('away_goals') is-invalid @enderror" 
                    placeholder = "Away Goals" 
                    />                    
                <!-- error message untuk title -->
                @error('away_goals')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="col-md-3">
                <input type="text" 
                    name        = "away_corners" 
                    class       = "form-control m-b-5 @error('away_corners') is-invalid @enderror" 
                    placeholder = "Away Corners" 
                    />                    
                <!-- error message untuk title -->
                @error('away_corners')
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
