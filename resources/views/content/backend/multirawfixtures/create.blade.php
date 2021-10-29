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

                    <!-- Raw Text -->
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Raw Text" />
                        <div class="col-12  col-md-8">
                            <textarea 
                                class       = "form-control" 
                                name        = "raw_text"
                                rows        ="7"></textarea>

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
