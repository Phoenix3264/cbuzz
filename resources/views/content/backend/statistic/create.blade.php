@extends('template.color_admin_apple_v42.form')
@section('title', str_replace("_"," ", $content))
@section('sidebar')    
@endsection

@section('content')    
    <form action="{{ route($content.'.store') }}" method="POST">
        @csrf

        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="Matches" />
            <div class="col-md-3">
                <input type="text" 
                    class       = "form-control m-b-5" 
                    value       = "{{$country_name}} {{$league_name}} {{$league_year}}" 
                    disabled 
                    />                    
            </div>

            <div class="col-md-3">
                <input type="text" 
                    name        = "league_round" 
                    class       = " form-control m-b-5 @error('league_round') is-invalid @enderror" 
                    placeholder = "League Round" 
                    />
                    
                <!-- error message untuk title -->
                @error('league_round')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3">
                <input type="text" 
                    name        = "leagues_id" 
                    class       = "d-none form-control m-b-5 @error('leagues_id') is-invalid @enderror" 
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
                <select 
                    name        = "home_hdp" 
                    class       = "form-control m-b-5 @error('home_hdp') is-invalid @enderror" 
                    >

                    <option value = "">
                        Pilih HDP
                    </option>
                    @foreach ($handicap as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach
                </select>
                    
                <!-- error message untuk title -->
                @error('home_hdp')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3">
                <select 
                    name        = "home_corner" 
                    class       = "form-control m-b-5 @error('home_corner') is-invalid @enderror" 
                    >

                    <option value = "">
                        Pilih HDPC
                    </option>
                    @foreach ($handicap as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach
                </select>
                    
                <!-- error message untuk title -->
                @error('home_corner')
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
                <select 
                    name        = "away_hdp" 
                    class       = "form-control m-b-5 @error('away_hdp') is-invalid @enderror" 
                    >

                    <option value = "">
                        Pilih Handicap
                    </option>
                    @foreach ($handicap as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach
                </select>
                    
                <!-- error message untuk title -->
                @error('away_hdp')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="col-md-3">
                <select 
                    name        = "away_corner" 
                    class       = "form-control m-b-5 @error('away_corner') is-invalid @enderror" 
                    >

                    <option value = "">
                        Pilih Handicap Corner
                    </option>
                    @foreach ($handicap as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach
                </select>
                    
                <!-- error message untuk title -->
                @error('away_corner')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>


        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="Over Under" />
            <div class="col-md-3">
                <select 
                    name        = "over_under" 
                    class       = "form-control m-b-5 @error('over_under') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih Over Under Goals
                    </option>
                    @foreach ($over_under as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('over_under')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3">
                <select 
                    name        = "over_under" 
                    class       = "form-control m-b-5 @error('over_under') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih Over Under Corner
                    </option>
                    @foreach ($over_under_corner as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('over_under')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>


        <div class="form-group row m-b-15">
            <x-label-form-cv42 title="Corner Min Max" />
            <div class="col-md-3">
                <select 
                    name        = "over_under" 
                    class       = "form-control m-b-5 @error('over_under') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih Min Corner
                    </option>
                    @foreach ($over_under_corner as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('over_under')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-3">
                <select 
                    name        = "over_under" 
                    class       = "form-control m-b-5 @error('over_under') is-invalid @enderror" 
                    >

                    <option value="">
                        Pilih Max Corner
                    </option>
                    @foreach ($over_under_corner as $row)
                        <option value="{{$row}}">
                            {{$row}}
                        </option>
                    @endforeach

                </select>
                    
                <!-- error message untuk title -->
                @error('over_under')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- -->

        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="Home" />
            
            <div class="col-md-3">
                <input type="text" 
                    name        = "home_score" 
                    class       = "form-control m-b-5 @error('home_score') is-invalid @enderror" 
                    placeholder = "Home Score" 
                    />                    
                <!-- error message untuk title -->
                @error('home_score')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="col-md-3">
                <input type="text" 
                    name        = "home_corner" 
                    class       = "form-control m-b-5 @error('home_corner') is-invalid @enderror" 
                    placeholder = "Home Corner" 
                    />                    
                <!-- error message untuk title -->
                @error('home_corner')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        </div>


        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="Away" />
            
            <div class="col-md-3">
                <input type="text" 
                    name        = "away_score" 
                    class       = "form-control m-b-5 @error('away_score') is-invalid @enderror" 
                    placeholder = "Away Score" 
                    />                    
                <!-- error message untuk title -->
                @error('away_score')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="col-md-3">
                <input type="text" 
                    name        = "away_corner" 
                    class       = "form-control m-b-5 @error('away_corner') is-invalid @enderror" 
                    placeholder = "Away Corner" 
                    />                    
                <!-- error message untuk title -->
                @error('away_corner')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>


        <!-- -->

        <div class="form-group row m-b-15">       
            <x-label-form-cv42 title="" />
            <div class="col-md-8">
                <x-button-submit />
            </div>
        </div>
    </form>
@endsection
