@extends('template.color_admin_apple_v42.form')
@section('content')             
    <div id="content" class="content">
        <x-cv42.breadcrumb link2="{{ route($content.'.index') }}" level2="{{$panel_name}}" level3="Edit" />
        <x-cv42.pageheader header="{{$panel_name}}"/>
        <div class="panel panel-inverse">
            <x-cv42.panel-heading title="Form"/>
            <div class="panel-body">
                <form action="{{ route($content.'.update', $Club_league->id) }}" method="POST" >
                    @csrf
                    @method('PUT')

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="League" />
                        <div class="col-md-5">
                            <input type="text" 
                                class       = "form-control m-b-5 " 
                                value       = "{{ $model->leagues_name }} {{ $model->tahun }}" disabled />
                                
                        </div>            
                    </div>

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Club" />
                        <div class="col-md-5">
                            <input type="text" 
                                class       = "form-control m-b-5 " 
                                value       = "{{ $model->clubs_name }}" disabled/>
                                
                            @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>            
                    </div>


                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Corner Fav" />
                        <div class="col-md-4">
                                
                            <select 
                                name        = "corner_fav" 
                                class       = "form-control m-b-5 @error('corner_fav') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose corner_fav
                                </option>
                                <option value="0"
                                    @if(0 == $Club_league->corner_fav)
                                        selected
                                    @endif
                                    >
                                    No
                                </option>
                                <option value="1"
                                    @if(1 == $Club_league->corner_fav)
                                        selected
                                    @endif
                                    >
                                    Under
                                </option>
                                <option value="2"
                                    @if(2 == $Club_league->corner_fav)
                                        selected
                                    @endif
                                    >
                                    Over
                                </option>
                                <option value="3"
                                    @if(3 == $Club_league->corner_fav)
                                        selected
                                    @endif
                                    >
                                    Steady
                                </option>

                            </select>
                                
                            <!-- error message untuk title -->
                            @error('my_bet')
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
