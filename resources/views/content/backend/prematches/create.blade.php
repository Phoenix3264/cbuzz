@extends('template.color_admin_apple_v42.form')
@section('title', str_replace("_"," ", $content))
@section('sidebar')    
@endsection

@section('content')    
    <form action="{{ route('Prematches.store') }}" method="POST">
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

        <!-- Round League -->
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

        <!-- Home -->
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

            <div class="col-md-2">
                <select 
                    name        = "home_hdp_goals" 
                    class       = "form-control m-b-5 @error('home_hdp_goals') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih HDP Goals
                    </option>
                    @foreach ($handicap as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('home_hdp_goals')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-2">
                <select 
                    name        = "home_hdp_corners" 
                    class       = "form-control m-b-5 @error('home_hdp_corners') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih HDP Corners
                    </option>
                    @foreach ($handicap as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('home_hdp_corners')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Away -->
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

            <div class="col-md-2">
                <select 
                    name        = "away_hdp_goals" 
                    class       = "form-control m-b-5 @error('away_hdp_goals') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih HDP Goals
                    </option>
                    @foreach ($handicap as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('away_hdp_goals')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-2">
                <select 
                    name        = "away_hdp_corners" 
                    class       = "form-control m-b-5 @error('away_hdp_corners') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih HDP Corners
                    </option>
                    @foreach ($handicap as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('away_hdp_corners')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!--  -->
        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="" />

            <div class="col-md-1">
                <input type="text" 
                    name        = "min_corners" 
                    class       = " form-control m-b-5 @error('min_corners') is-invalid @enderror" 
                    placeholder = "Min" 
                    />
                    
                <!-- error message untuk title -->
                @error('min_corners')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-1">
                <input type="text" 
                    name        = "max_corners" 
                    class       = " form-control m-b-5 @error('max_corners') is-invalid @enderror" 
                    placeholder = "Max" 
                    />
                    
                <!-- error message untuk title -->
                @error('max_corners')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="col-md-2">
                <select 
                    name        = "over_under_goals" 
                    class       = "form-control m-b-5 @error('over_under_goals') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih OU Goals
                    </option>
                    @foreach ($over_under as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('over_under_goals')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-2">
                <select 
                    name        = "over_under_corners" 
                    class       = "form-control m-b-5 @error('over_under_corners') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih OU Corners
                    </option>
                    @foreach ($handicap_corner as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('over_under_corners')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- My Bet -->
        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="League Round" />

            <div class="col-md-6">
                <input type="text" 
                    name        = "my_bet" 
                    class       = " form-control m-b-5 @error('my_bet') is-invalid @enderror" 
                    placeholder = "League Round" 
                    />
                    
                <!-- error message untuk title -->
                @error('my_bet')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Submit -->
        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="" />
            <div class="col-md-8">
                <x-button-submit />
            </div>
        </div>

    </form>
@endsection
