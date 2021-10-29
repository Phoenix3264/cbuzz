@extends('template.color_admin_apple_v42.form')
@section('content')             
    <div id="content" class="content">
        <x-cv42.breadcrumb link2="{{ route($content.'.index') }}" level2="{{$panel_name}}" level3="Edit" />
        <x-cv42.pageheader header="{{$panel_name}}"/>
        <div class="panel panel-inverse">
            <x-cv42.panel-heading title="Form"/>
            <div class="panel-body">
                <form action="{{ route($content.'.update', $Postmatch->id) }}" method="POST" >
                    @csrf
                    @method('PUT')


                    <!-- Raw Text -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Raw Text" />
                        <div class="col-12  col-md-8">
                            <textarea 
                                class       = "form-control" 
                                name        = "raw_text"
                                rows        ="7">{{ old('title', $Postmatch->raw_text) }}</textarea>

                            @error('raw_text')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>          
                    </div>

                    <!-- Post Raw Text -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Post Raw Text" />
                        <div class="col-12  col-md-8">
                            <textarea 
                                class       = "form-control" 
                                name        = "post_raw_text"
                                rows        ="7">{{ old('title', $Postmatch->post_raw_text) }}</textarea>

                            @error('post_raw_text')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>          
                    </div>

                    <!-- Round League -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Round League
                            {{ round_league(old('title', $Postmatch->raw_text), 'Round') }}   " />
                        <div class="col-6  col-md-2">
                            <input type="number" 
                                name        = "leagues_id" 
                                class       = "form-control m-b-5 @error('nama') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->leagues_id) }}" disabled/>

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
                                value       = "{{ old('title', $Postmatch->round_league) }}" disabled/>
                                
                            @error('round_league')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>

                    <!-- Clubs -->
                    <div class="form-group row m-b-15">
                        <x-cv42.label-form title="Club
                            {{ club(old('title', $Postmatch->raw_text), 'Home', $Postmatch->leagues_id) }} - 
                            {{ club(old('title', $Postmatch->raw_text), 'Away', $Postmatch->leagues_id) }}   " />
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
                                        @if($row->id == $Postmatch->home_clubs_id)
                                            selected
                                        @endif
                                        >
                                        {{$row->nama}} 
                                        {{$row->id}}
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
                                        @if($row->id == $Postmatch->away_clubs_id)
                                            selected
                                        @endif
                                        >
                                        {{$row->nama}}
                                        {{$row->id}}
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

                    <!-- Goals -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Goals
                            {{ goals(old('title', $Postmatch->raw_text), 'Home') }} - 
                            {{ goals(old('title', $Postmatch->raw_text), 'Away') }}   " />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_goals" 
                                class       = "form-control m-b-5 @error('home_goals') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_goals) }}" >

                            @error('home_goals')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_goals" 
                                class       = "form-control m-b-5 @error('away_goals') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_goals) }}" >
                                
                            @error('away_goals')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>

                    <!-- Ball Possesion -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Ball Possesion
                            {{ ball_possession(old('title', $Postmatch->raw_text), 'Home') }} - 
                            {{ ball_possession(old('title', $Postmatch->raw_text), 'Away') }}                 
                        " />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_ball_possession" 
                                class       = "form-control m-b-5 @error('home_ball_possession') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_ball_possession) }}" >

                            @error('home_ball_possession')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_ball_possession" 
                                class       = "form-control m-b-5 @error('away_ball_possession') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_ball_possession) }}" >
                                
                            @error('away_ball_possession')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Goal Attempts -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Goal Attempts
                            {{ goal_attempts(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ goal_attempts(old('title', $Postmatch->raw_text), 'Away') }}
                        " />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_goal_attempts" 
                                class       = "form-control m-b-5 @error('home_goal_attempts') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_goal_attempts) }}" >

                            @error('home_goal_attempts')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_goal_attempts" 
                                class       = "form-control m-b-5 @error('away_goal_attempts') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_goal_attempts) }}" >
                                
                            @error('away_goal_attempts')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>

                    <!-- Shots on Goals -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Shots on Goals
                            {{ shots_on_goal(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ shots_on_goal(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_shots_on_goals" 
                                class       = "form-control m-b-5 @error('home_shots_on_goals') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_shots_on_goals) }}" >

                            @error('home_shots_on_goals')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_shots_on_goals" 
                                class       = "form-control m-b-5 @error('away_shots_on_goals') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_shots_on_goals) }}" >
                                
                            @error('away_shots_on_goals')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>

                    <!-- Shots off Goals -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Shots off Goals
                            {{ shots_off_goal(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ shots_off_goal(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_shots_off_goals" 
                                class       = "form-control m-b-5 @error('home_shots_off_goals') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_shots_off_goals) }}" >

                            @error('home_shots_off_goals')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_shots_off_goals" 
                                class       = "form-control m-b-5 @error('away_shots_off_goals') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_shots_off_goals) }}" >
                                
                            @error('away_shots_off_goals')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>

                    <!-- Blocked Shots  -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Blocked Shots
                            {{ blocked_shots(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ blocked_shots(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_blocked_shots" 
                                class       = "form-control m-b-5 @error('home_blocked_shots') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_blocked_shots) }}" >

                            @error('home_blocked_shots')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_blocked_shots" 
                                class       = "form-control m-b-5 @error('away_blocked_shots') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_blocked_shots) }}" >
                                
                            @error('away_blocked_shots')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Free Kicks -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Free Kicks
                            {{ free_kicks(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ free_kicks(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_free_kicks" 
                                class       = "form-control m-b-5 @error('home_free_kicks') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_free_kicks) }}" >

                            @error('home_free_kicks')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_free_kicks" 
                                class       = "form-control m-b-5 @error('away_free_kicks') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_free_kicks) }}" >
                                
                            @error('away_free_kicks')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Corners -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Corners
                            {{ corner_kicks(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ corner_kicks(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_corners" 
                                class       = "form-control m-b-5 @error('home_corners') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_corners) }}" >

                            @error('home_corners')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_corners" 
                                class       = "form-control m-b-5 @error('away_corners') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_corners) }}" >
                                
                            @error('away_corners')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Offsides -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Offsides
                            {{ offsides(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ offsides(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_offsides" 
                                class       = "form-control m-b-5 @error('home_offsides') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_offsides) }}" >

                            @error('home_offsides')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_offsides" 
                                class       = "form-control m-b-5 @error('away_offsides') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_offsides) }}" >
                                
                            @error('away_offsides')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Throw In -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Throw In
                            {{ throw_in(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ throw_in(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_throw_in" 
                                class       = "form-control m-b-5 @error('home_throw_in') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_throw_in) }}" >

                            @error('home_throw_in')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_throw_in" 
                                class       = "form-control m-b-5 @error('away_throw_in') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_throw_in) }}" >
                                
                            @error('away_throw_in')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Goalkeeper Saves -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Goalkeeper Saves
                            {{ goalkeeper_saves(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ goalkeeper_saves(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_goalkeeper_saves" 
                                class       = "form-control m-b-5 @error('home_goalkeeper_saves') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_goalkeeper_saves) }}" >

                            @error('home_goalkeeper_saves')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_goalkeeper_saves" 
                                class       = "form-control m-b-5 @error('away_goalkeeper_saves') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_goalkeeper_saves) }}" >
                                
                            @error('away_goalkeeper_saves')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Fouls -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Fouls
                            {{ fouls(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ fouls(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_fouls" 
                                class       = "form-control m-b-5 @error('home_fouls') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_fouls) }}" >

                            @error('home_fouls')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_fouls" 
                                class       = "form-control m-b-5 @error('away_fouls') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_fouls) }}" >
                                
                            @error('away_fouls')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Red Cards -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Red Cards
                            {{ red_cards(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ red_cards(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_red_cards" 
                                class       = "form-control m-b-5 @error('home_red_cards') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_red_cards) }}" >

                            @error('home_red_cards')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_red_cards" 
                                class       = "form-control m-b-5 @error('away_red_cards') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_red_cards) }}" >
                                
                            @error('away_red_cards')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Yellow Cards -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Yellow Cards
                            {{ yellow_cards(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ yellow_cards(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_yellow_cards" 
                                class       = "form-control m-b-5 @error('home_yellow_cards') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_yellow_cards) }}" >

                            @error('home_yellow_cards')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_yellow_cards" 
                                class       = "form-control m-b-5 @error('away_yellow_cards') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_yellow_cards) }}" >
                                
                            @error('away_yellow_cards')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Total Passes -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Total Passes
                            {{ total_passes(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ total_passes(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_total_passes" 
                                class       = "form-control m-b-5 @error('home_total_passes') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_total_passes) }}" >

                            @error('home_total_passes')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_total_passes" 
                                class       = "form-control m-b-5 @error('away_total_passes') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_total_passes) }}" >
                                
                            @error('away_total_passes')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Completed Passes -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Completed Passes
                            {{ completed_passes(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ completed_passes(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_completed_passes" 
                                class       = "form-control m-b-5 @error('home_completed_passes') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_completed_passes) }}" >

                            @error('home_completed_passes')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_completed_passes" 
                                class       = "form-control m-b-5 @error('away_completed_passes') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_completed_passes) }}" >
                                
                            @error('away_completed_passes')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Tackles -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Tackles
                            {{ tackles(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ tackles(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_tackles" 
                                class       = "form-control m-b-5 @error('home_tackles') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_tackles) }}" >

                            @error('home_tackles')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_tackles" 
                                class       = "form-control m-b-5 @error('away_tackles') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_tackles) }}" >
                                
                            @error('away_tackles')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Attacks -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Attacks
                            {{ attacks(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ attacks(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_attacks" 
                                class       = "form-control m-b-5 @error('home_attacks') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_attacks) }}" >

                            @error('home_attacks')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_attacks" 
                                class       = "form-control m-b-5 @error('away_attacks') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_attacks) }}" >
                                
                            @error('away_attacks')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Dangerous Attacks -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Dangerous Attacks
                            {{ dangerous_attacks(old('title', $Postmatch->raw_text), 'Home') }} -
                            {{ dangerous_attacks(old('title', $Postmatch->raw_text), 'Away') }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_dangerous_attacks" 
                                class       = "form-control m-b-5 @error('home_dangerous_attacks') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->home_dangerous_attacks) }}" >

                            @error('home_dangerous_attacks')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "away_dangerous_attacks" 
                                class       = "form-control m-b-5 @error('away_dangerous_attacks') is-invalid @enderror" 
                                value       = "{{ old('title', $Postmatch->away_dangerous_attacks) }}" >
                                
                            @error('away_dangerous_attacks')
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
