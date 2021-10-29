@extends('template.color_admin_apple_v42.form')
@section('content')             
    <div id="content" class="content">
        <x-cv42.breadcrumb link2="{{ route($content.'.index') }}" level2="{{$panel_name}}" level3="Create" />
        <x-cv42.page-header header="{{$panel_name}}"/>
        <div class="panel panel-inverse">
            <x-cv42.panel-heading title="Form"/>
            <div class="panel-body">
                <form action="{{ route($content.'.store') }}" method="POST" >
                    @csrf

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Round League" />
                        <div class="col-6 col-md-2">
                            <input type="number" 
                                name        = "leagues_id" 
                                class       = "form-control m-b-5 @error('leagues_id') is-invalid @enderror" 
                                value       = '{{$leagues_id}}'
                                />
                                
                            @error('leagues_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6 col-md-2">
                            <input type="number" 
                                name        = "round_league" 
                                class       = "form-control m-b-5 @error('round_league') is-invalid @enderror" 
                                />
                                
                            @error('round_league')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>

                    <div class="form-group row m-b-15">
                        <x-cv42.label-form title="Club" />
                        <div class="col-6 col-md-4">
                            <select 
                                name        = "home_clubs_id" 
                                class       = "form-control m-b-5 @error('home_clubs_id') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose Club
                                </option>
                                @foreach ($club as $row)
                                    <option value="{{$row->id}}">
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

                        <div class="col-6 col-md-4">
                            <select 
                                name        = "away_clubs_id" 
                                class       = "form-control m-b-5 @error('away_clubs_id') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose Club
                                </option>
                                @foreach ($club as $row)
                                    <option value="{{$row->id}}">
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
                    
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Handicap Goals" />
                        <div class="col-6 col-md-4">
                            <select 
                                name        = "home_hdp_goals" 
                                class       = "form-control m-b-5 @error('home_hdp_goals') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose HDP Goals
                                </option>
                                @foreach ($handicap_goals as $row)
                                    <option value="{{$row->nama}}">
                                        {{$row->nama}}
                                    </option>
                                @endforeach

                            </select>
                                
                            @error('home_hdp_goals')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>     

                        <div class="col-6 col-md-4">
                            <select 
                                name        = "away_hdp_goals" 
                                class       = "form-control m-b-5 @error('away_hdp_goals') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose HDP Goals
                                </option>
                                @foreach ($handicap_goals as $row)
                                    <option value="{{$row->nama}}">
                                        {{$row->nama}}
                                    </option>
                                @endforeach

                            </select>
                                
                            @error('away_hdp_goals')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>          
                    </div>

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="OU Goals" />
                        <div class="col-6 col-md-4">
                            <select 
                                name        = "over_under_goals" 
                                class       = "form-control m-b-5 @error('over_under_goals') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose OU Goals
                                </option>
                                @foreach ($handicap_goals as $row)
                                    <option value="{{$row->nama}}">
                                        {{$row->nama}}
                                    </option>
                                @endforeach

                            </select>
                                
                            @error('over_under_goals')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Handicap Corners" />
                        <div class="col-6 col-md-4">
                            <select 
                                name        = "home_hdp_corners" 
                                class       = "form-control m-b-5 @error('home_hdp_corners') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose HDP Corners
                                </option>
                                @foreach ($handicap_goals as $row)
                                    <option value="{{$row->nama}}">
                                        {{$row->nama}}
                                    </option>
                                @endforeach

                            </select>
                                
                            @error('home_hdp_corners')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>     

                        <div class="col-6 col-md-4">
                            <select 
                                name        = "away_hdp_corners" 
                                class       = "form-control m-b-5 @error('away_hdp_corners') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose HDP Corners
                                </option>
                                @foreach ($handicap_goals as $row)
                                    <option value="{{$row->nama}}">
                                        {{$row->nama}}
                                    </option>
                                @endforeach

                            </select>
                                
                            @error('away_hdp_corners')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>          
                    </div>

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="OU Corners" />
                        <div class="col-6 col-md-4">
                            <select 
                                name        = "over_under_corners" 
                                class       = "form-control m-b-5 @error('over_under_corners') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose OU Corners
                                </option>
                                @foreach ($ou_corners as $row)
                                    <option value="{{$row->nama}}">
                                        {{$row->nama}}
                                    </option>
                                @endforeach

                            </select>
                                
                            @error('over_under_corners')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Min Max Corners" />
                        <div class="col-6 col-md-4">
                            <input type="number" 
                                name        = "min_corners" 
                                class       = "form-control m-b-5 @error('min_corners') is-invalid @enderror" 
                                />
                                
                            @error('min_corners')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6 col-md-4">
                            <input type="number" 
                                name        = "max_corners" 
                                class       = "form-control m-b-5 @error('max_corners') is-invalid @enderror" 
                                />
                                
                            @error('max_corners')
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
