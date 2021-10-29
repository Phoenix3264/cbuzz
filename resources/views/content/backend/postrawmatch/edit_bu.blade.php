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
                        <div class="col-8  col-md-8">
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

                    <!-- Ball Possesion -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Ball Possesion
                            {{ old('title', $Postrawmatch->home_ball_possession) }} - 
                            {{ old('title', $Postrawmatch->away_ball_possession) }}                            
                        " />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_ball_possession" 
                                class       = "form-control m-b-5 @error('home_ball_possession') is-invalid @enderror" 
                                value       = "{{ ball_possession(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ ball_possession(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_goal_attempts) }} -
                            {{ old('title', $Postrawmatch->away_goal_attempts) }}
                        " />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_goal_attempts" 
                                class       = "form-control m-b-5 @error('home_goal_attempts') is-invalid @enderror" 
                                value       = "{{ goal_attempts(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ goal_attempts(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_shots_on_goals) }} -
                            {{ old('title', $Postrawmatch->away_shots_on_goals) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_shots_on_goals" 
                                class       = "form-control m-b-5 @error('home_shots_on_goals') is-invalid @enderror" 
                                value       = "{{ shots_on_goal(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ shots_on_goal(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_shots_off_goals) }} -
                            {{ old('title', $Postrawmatch->away_shots_off_goals) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_shots_off_goals" 
                                class       = "form-control m-b-5 @error('home_shots_off_goals') is-invalid @enderror" 
                                value       = "{{ shots_off_goal(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ shots_off_goal(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_blocked_shots) }} -
                            {{ old('title', $Postrawmatch->away_blocked_shots) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_blocked_shots" 
                                class       = "form-control m-b-5 @error('home_blocked_shots') is-invalid @enderror" 
                                value       = "{{ blocked_shots(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ blocked_shots(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_free_kicks) }} -
                            {{ old('title', $Postrawmatch->away_free_kicks) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_free_kicks" 
                                class       = "form-control m-b-5 @error('home_free_kicks') is-invalid @enderror" 
                                value       = "{{ free_kicks(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ free_kicks(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_corners) }} -
                            {{ old('title', $Postrawmatch->away_corners) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_corners" 
                                class       = "form-control m-b-5 @error('home_corners') is-invalid @enderror" 
                                value       = "{{ corner_kicks(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ corner_kicks(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_offsides) }} -
                            {{ old('title', $Postrawmatch->away_offsides) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_offsides" 
                                class       = "form-control m-b-5 @error('home_offsides') is-invalid @enderror" 
                                value       = "{{ offsides(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ offsides(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_throw_in) }} -
                            {{ old('title', $Postrawmatch->away_throw_in) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_throw_in" 
                                class       = "form-control m-b-5 @error('home_throw_in') is-invalid @enderror" 
                                value       = "{{ throw_in(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ throw_in(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_goalkeeper_saves) }} -
                            {{ old('title', $Postrawmatch->away_goalkeeper_saves) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_goalkeeper_saves" 
                                class       = "form-control m-b-5 @error('home_goalkeeper_saves') is-invalid @enderror" 
                                value       = "{{ goalkeeper_saves(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ goalkeeper_saves(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_fouls) }} -
                            {{ old('title', $Postrawmatch->away_fouls) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_fouls" 
                                class       = "form-control m-b-5 @error('home_fouls') is-invalid @enderror" 
                                value       = "{{ fouls(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ fouls(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
                            @error('away_fouls')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Total Passes -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Total Passes
                            {{ old('title', $Postrawmatch->home_total_passes) }} -
                            {{ old('title', $Postrawmatch->away_total_passes) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_total_passes" 
                                class       = "form-control m-b-5 @error('home_total_passes') is-invalid @enderror" 
                                value       = "{{ total_passes(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ total_passes(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_completed_passes) }} -
                            {{ old('title', $Postrawmatch->away_completed_passes) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_completed_passes" 
                                class       = "form-control m-b-5 @error('home_completed_passes') is-invalid @enderror" 
                                value       = "{{ completed_passes(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ completed_passes(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
                            @error('away_completed_passes')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Yellow Cards -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Yellow Cards
                            {{ old('title', $Postrawmatch->home_yellow_cards) }} -
                            {{ old('title', $Postrawmatch->away_yellow_cards) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_yellow_cards" 
                                class       = "form-control m-b-5 @error('home_yellow_cards') is-invalid @enderror" 
                                value       = "{{ yellow_cards(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ yellow_cards(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
                            @error('away_yellow_cards')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>
                    
                    <!-- Tackles -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Tackles
                            {{ old('title', $Postrawmatch->home_tackles) }} -
                            {{ old('title', $Postrawmatch->away_tackles) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_tackles" 
                                class       = "form-control m-b-5 @error('home_tackles') is-invalid @enderror" 
                                value       = "{{ tackles(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ tackles(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_attacks) }} -
                            {{ old('title', $Postrawmatch->away_attacks) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_attacks" 
                                class       = "form-control m-b-5 @error('home_attacks') is-invalid @enderror" 
                                value       = "{{ attacks(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ attacks(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
                            {{ old('title', $Postrawmatch->home_dangerous_attacks) }} -
                            {{ old('title', $Postrawmatch->away_dangerous_attacks) }}" />
                        <div class="col-6  col-md-4">
                            <input type="number" 
                                name        = "home_dangerous_attacks" 
                                class       = "form-control m-b-5 @error('home_dangerous_attacks') is-invalid @enderror" 
                                value       = "{{ dangerous_attacks(old('title', $Postrawmatch->raw_text), 'Home') }}" >

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
                                value       = "{{ dangerous_attacks(old('title', $Postrawmatch->raw_text), 'Away') }}" >
                                
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
