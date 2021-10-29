@extends('template.color_admin_apple_v42.form')
@section('content')             
    <div id="content" class="content">
        <x-cv42.breadcrumb link2="{{ route($content.'.index') }}" level2="{{$panel_name}}" level3="Edit" />
        <x-cv42.pageheader header="{{$panel_name}}"/>
        <div class="panel panel-inverse">
            <x-cv42.panel-heading title="Form"/>
            <div class="panel-body">
                <form action="{{ route($content.'.update', $Mybet->id) }}" method="POST" >
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Club" />
                        <div class="col-md-1 text-center"> 
                            <?php 
                                if(!is_null($fixture->home_hdp_goals))
                                {
                                    echo '<span class="badge badge-lime ">
                                            +'.$fixture->home_hdp_goals.
                                            '</span>';
                                }
                            ?>
                        </div>     
                        <div class="col-md-2 text-center">       
                            {{ $fixture->home_club }}
                            <em>
                                ({{ $fixture->home_points }} Pts)
                            </em>
                        </div>           
                        <div class="col-md-2 text-center"> 
                            Round League<br/>
                            {{ $fixture->round_league }}
                        </div>             
                        <div class="col-md-2 text-center">          
                            {{ $fixture->away_club }}
                            <em>
                                ({{ $fixture->away_points }} Pts)
                            </em>
                        </div>    
                        <div class="col-md-1 text-center"> 
                            <?php 
                                if(!is_null($fixture->away_hdp_goals))
                                {
                                    echo '<span class="badge badge-lime ">
                                            +'.$fixture->away_hdp_goals.
                                            '</span>';
                                }
                            ?>
                        </div>     
                    </div>

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Goals" />
                        <div class="col-md-1 text-center"> 
                        </div>     
                        <div class="col-md-2 text-center">     
                            {!!define_club_leagues($Mybet->leagues_id, $Mybet->home_clubs_id, 'home', 'goals')!!}   
                        </div>           
                        <div class="col-md-2 text-center"> 
                            {{ $fixture->over_under_goals }}                            
                        </div>             
                        <div class="col-md-2 text-center">    
                            {!!define_club_leagues($Mybet->leagues_id, $Mybet->away_clubs_id, 'away', 'goals')!!}       
                        </div>    
                        <div class="col-md-1 text-center"> 
                        </div>     
                    </div>

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Corner" />
                        <div class="col-md-1 text-center"> 
                            <?php 
                                if(!is_null($fixture->home_hdp_corners))
                                {
                                    echo '<span class="badge badge-indigo ">
                                            +'.$fixture->home_hdp_corners.
                                            '</span>';
                                }
                            ?>
                        </div>     
                        <div class="col-md-2 text-center">       
                            {!!define_club_leagues($Mybet->leagues_id, $Mybet->home_clubs_id, 'home', 'corners')!!}  
                            <br/>
                            {{ $fixture->home_corner_club }}
                        </div>           
                        <div class="col-md-2 text-center"> 
                            {{ $fixture->over_under_corners }}                               
                        </div>             
                        <div class="col-md-2 text-center">          
                            {!!define_club_leagues($Mybet->leagues_id, $Mybet->away_clubs_id, 'away', 'corners')!!}  
                            <br/>
                            {{ $fixture->away_corner_club }}
                        </div>    
                        <div class="col-md-1 text-center"> 
                            <?php 
                                if(!is_null($fixture->away_hdp_corners))
                                {
                                    echo '<span class="badge badge-indigo ">
                                            +'.$fixture->away_hdp_corners.
                                            '</span>';
                                }
                            ?>
                        </div>     
                    </div>

                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="My Bet" />
                        <div class="col-md-4">
                                
                            <select 
                                name        = "my_bet" 
                                class       = "form-control m-b-5 @error('my_bet') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose Bet
                                </option>
                                @foreach ($bet_status as $row)
                                    <option value="{{$row->id}}"
                                        @if($row->id == $Mybet->my_bet)
                                            selected
                                        @endif
                                        >
                                        {{$row->nama}}
                                    </option>
                                @endforeach

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
                        <x-cv42.label-form title="Accuracy" />
                        <div class="col-md-4">
                                
                            <select 
                                name        = "akurasi" 
                                class       = "form-control m-b-5 @error('akurasi') is-invalid @enderror" 
                                >

                                <option value="">
                                    Choose Accuracy
                                </option>
                                @foreach ($bet_accuracy as $row)
                                    <option value="{{$row->nama}}"
                                        @if($row->nama == $Mybet->akurasi)
                                            selected
                                        @endif
                                        >
                                        {{$row->nama}}
                                    </option>
                                @endforeach

                            </select>
                                
                            <!-- error message untuk title -->
                            @error('akurasi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>             
                    </div>

                    
                    <div class="form-group row m-b-15">    
                        <x-cv42.label-form title="Notes" />
                        <div class="col-md-8">
                            <textarea 
                                name        = "notes" 
                                rows        = "5"
                                class       = "form-control m-b-5 @error('akurasi') is-invalid @enderror" >{{ old('title', $Mybet->notes) }}</textarea>    
                                
                            <!-- error message untuk title -->
                            @error('notes')
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

        <div class="row">
            <!-- begin col-12 -->
            <div class="col-lg-12">
                <!-- begin nav-tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-items">
                        <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                            <span class="d-sm-none">Home</span>
                            <span class="d-sm-block d-none">Home</span>
                        </a>
                    </li>
                    <li class="nav-items">
                        <a href="#default-tab-2" data-toggle="tab" class="nav-link">
                            <span class="d-sm-none">Away</span>
                            <span class="d-sm-block d-none">Away</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#default-tab-3" data-toggle="tab" class="nav-link">
                            <span class="d-sm-none">Head to Head</span>
                            <span class="d-sm-block d-none">Head to Head</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#default-tab-4" data-toggle="tab" class="nav-link">
                            <span class="d-sm-none">Season Summary</span>
                            <span class="d-sm-block d-none">Season Summary</span>
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content">                    
                    <div class="tab-pane fade active show" id="default-tab-1">   
                        {!! last_fixtures($Mybet->leagues_id, $Mybet->home_clubs_id) !!} 
                    </div>
                    
                    <div class="tab-pane fade" id="default-tab-2">     
                        {!! last_fixtures($Mybet->leagues_id, $Mybet->away_clubs_id) !!}  
                    </div>
                    
                    <div class="tab-pane fade" id="default-tab-3">  
                        <div class="row">                            
                            <div class="m-b-20">      
                                <x-cv42.a-white-right link="{{ route('Archives.create', $Mybet->id) }}" icon="ion-ios-add" title="Create"/>  
                            </div>
                            
                            <br/>
                        </div>

                        {!! head_to_head($Mybet->home_clubs_id, $Mybet->away_clubs_id) !!}  

                    </div>

                    <div class="tab-pane fade" id="default-tab-4">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>
                                        Club
                                    </th>
                                    <th>
                                        Total Avg Home Goals
                                    </th>
                                    <th>
                                        Total Avg Away Goals                                        
                                    </th>
                                    <th>
                                        Total Avg Home Corners
                                    </th>
                                    <th>
                                        Total Avg Away Corners                                        
                                    </th>
                                    <th>
                                        Home Corners Club
                                    </th>
                                    <th>
                                        Away Corners Club                                       
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clubs as $row)
                                    <tr>
                                        <td>
                                            {{$row->club}}
                                        </td>
                                        <td> 
                                        </td>
                                        <td> 
                                        </td>
                                        <td> 
                                        </td>
                                        <td> 
                                        </td>
                                        <td>
                                            {{$row->home_corner_club}}
                                        </td>
                                        <td>
                                            {{$row->away_corner_club}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br/>

                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>
                                        Year
                                    </th>
                                    <th>
                                        Club
                                    </th>
                                    <th>
                                        Total Avg Home Goals
                                    </th>
                                    <th>
                                        Total Avg Away Goals                                        
                                    </th>
                                    <th>
                                        Total Avg Home Corners
                                    </th>
                                    <th>
                                        Total Avg Away Corners                                        
                                    </th>
                                    <th>
                                        Home Corners Club
                                    </th>
                                    <th>
                                        Away Corners Club                                       
                                    </th>
                                    <th>
                                        Points                                       
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($home_ss as $row)
                                    <tr>
                                        <td>
                                            {{$row->tahun}}
                                        </td>
                                        <td>
                                            {{$row->club}}
                                        </td>
                                        <td> 
                                        </td>
                                        <td> 
                                        </td>
                                        <td> 
                                        </td>
                                        <td> 
                                        </td>
                                        <td>
                                            {{$row->home_corner_club}}
                                        </td>
                                        <td>
                                            {{$row->away_corner_club}}
                                        </td>
                                        <td>
                                            {{$row->points}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br/>

                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>
                                        Year
                                    </th>
                                    <th>
                                        Club
                                    </th>
                                    <th>
                                        Total Avg Home Goals
                                    </th>
                                    <th>
                                        Total Avg Away Goals                                        
                                    </th>
                                    <th>
                                        Total Avg Home Corners
                                    </th>
                                    <th>
                                        Total Avg Away Corners                                        
                                    </th>
                                    <th>
                                        Home Corners Club
                                    </th>
                                    <th>
                                        Away Corners Club                                       
                                    </th>
                                    <th>
                                        Points                                       
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($away_ss as $row)
                                    <tr>
                                        <td>
                                            {{$row->tahun}}
                                        </td>
                                        <td>
                                            {{$row->club}}
                                        </td>
                                        <td> 
                                        </td>
                                        <td> 
                                        </td>
                                        <td> 
                                        </td>
                                        <td> 
                                        </td>
                                        <td>
                                            {{$row->home_corner_club}}
                                        </td>
                                        <td>
                                            {{$row->away_corner_club}}
                                        </td>
                                        <td>
                                            {{$row->points}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                
            </div>
            
        </div>


    </div>    
@endsection
