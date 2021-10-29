@extends('template.color_admin_apple_v42.form')
@section('content')             
    <div id="content" class="content">
        <x-cv42.breadcrumb link2="{{ route($content.'.index') }}" level2="{{$panel_name}}" level3="Edit" />
        <x-cv42.pageheader header="{{$panel_name}}"/>
        <div class="panel panel-inverse">
            <x-cv42.panel-heading title="Form"/>
            <div class="panel-body">
                <form action="{{ route($content.'.update', $Multirawfixture->id) }}" method="POST" >
                    @csrf
                    @method('PUT')

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Round League" />
                        <div class="col-md-2">
                            <input type="number" 
                                name        = "leagues_id" 
                                class       = "form-control m-b-5 @error('leagues_id') is-invalid @enderror" 
                                value       = "{{ old('title', $Multirawfixture->leagues_id) }}" />

                            @error('leagues_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            

                        <div class="col-md-2">
                            <input type="number" 
                                name        = "round_league" 
                                class       = "form-control m-b-5 @error('round_league') is-invalid @enderror" 
                                value       = "{{ old('title', $Multirawfixture->round_league) }}" />
                                
                            @error('round_league')
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
                                rows        ="7">{{ old('title', $Multirawfixture->raw_text) }}</textarea>

                            @error('raw_text')
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
                           {{ old('title', $Multirawfixture->post_raw_text) }}

                           <?php
                                $pre = old('title', $Multirawfixture->post_raw_text);

                                $str_replace_raw_text = explode('//-//-//', $pre);

                                for ($i=0; $i < count($str_replace_raw_text); $i++) 
                                { 
                                    echo $str_replace_raw_text[$i];
                                    echo '<br/>';
                                }
                           ?>

                           <?php
                                $pre = old('title', $Multirawfixture->post_raw_text);

                                $str_replace_raw_text = explode('//-//-//', $pre);

                                        echo '<br/>';
                                for ($i=0; $i < count($str_replace_raw_text); $i++) 
                                { 
                                    // echo $str_replace_raw_text[$i];
                                    // echo '<br/>';

                                    $str_replace_raw_text_2 = explode('//', $str_replace_raw_text[$i]);

                                    ///

                                        if(count($str_replace_raw_text_2) == 4)
                                        {
                                            echo $str_replace_raw_text_2[2];
                                            echo ' ';                                   
     
                                            echo define_club($str_replace_raw_text_2[2],$str_replace_raw_text_2[2]);
                                            echo ' ';
                                            echo 'vs';
                                            echo ' ';
                                            echo $str_replace_raw_text_2[3];
                                            echo ' ';
                                            echo define_club($str_replace_raw_text_2[3],$str_replace_raw_text_2[3]);
                                            echo ' ';
                                            echo '======> 4';

                                        }
                                        elseif(count($str_replace_raw_text_2) == 5)
                                        {

                                            $home_clubs_id = define_club($str_replace_raw_text_2[2],$str_replace_raw_text_2[3]);
                                            $away_clubs_id = define_club($str_replace_raw_text_2[3],$str_replace_raw_text_2[4]);

                                            if(is_null($home_clubs_id))
                                            {
                                                $home_clubs_id = define_club($str_replace_raw_text_2[2],$str_replace_raw_text_2[2]);
                                            }
                                            if(is_null($away_clubs_id))
                                            {
                                                $away_clubs_id = define_club($str_replace_raw_text_2[4],$str_replace_raw_text_2[4]);
                                            }

                                            echo $str_replace_raw_text_2[2];
                                            echo ' ';
                                            echo $home_clubs_id;

                                            echo 'vs';
                                            echo ' ';
                                            echo $str_replace_raw_text_2[3];
                                            echo ' ';
                                            echo $away_clubs_id;
                                            echo '======> 5';
                                        }
                                        elseif(count($str_replace_raw_text_2) == 6)
                                        {
                                            echo $str_replace_raw_text_2[2];
                                            echo ' ';
                                            echo define_club($str_replace_raw_text_2[2],$str_replace_raw_text_2[3]);

                                            echo 'vs';
                                            echo ' ';
                                            echo $str_replace_raw_text_2[4];
                                            echo ' ';
                                            echo define_club($str_replace_raw_text_2[3],$str_replace_raw_text_2[4]);
                                            echo '======> 6';
                                        }

                                        echo '<br/>';
                                    //}
                                }
                           ?>
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
