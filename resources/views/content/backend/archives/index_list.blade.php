@extends('template.color_admin_apple_v42.datatable')

@section('content')             
    <div id="content" class="content">
        <x-cv42.breadcrumb link2="{{ route($content.'.index') }}" level2="{{$panel_name}}" level3="Data" />
        <x-cv42.page-header header="{{$panel_name}}"/>


        <div class="row">
            {!!top_corner_club_dashboard('Over', 'Over', $leagues_id )!!}
            {!!top_corner_club_dashboard('Under', 'Under', $leagues_id)!!}
        </div>

        <div class="panel panel-inverse">
            <x-cv42.panel-heading title="Table Data"/>

            <div class="panel-body">   

                @if(session()->has('Success'))
                    <x-cv42.alert-form-saved />
                @elseif(session()->has('Deleted'))
                    <x-cv42.alert-form-deleted />
                @endif

                <div class="m-b-20">        
                    <x-cv42.a-white-right link="{{ route($content.'.create', $leagues_id) }}" icon="ion-ios-add" title="Create"/>   

                    <x-cv42.a-white-right link="{{ route('Postrawmatch.create', $leagues_id) }}" icon="ion-ios-add" title="Create Post Raw Fixtures"/>   

                    <x-cv42.a-white-right link="{{ route('Multirawfixtures.create', $leagues_id) }}" icon="ion-ios-add" title="Create Multi Raw Fixtures"/>  

                    <x-cv42.a-white-right link="{{ route('Club_leagues.index_list', $leagues_id) }}" icon="ion-ios-eye" title="Club League"/>  

                    <x-cv42.a-white-right link="{{ route('Leagues.index_list', $countries_id) }}" icon="ion-ios-eye" title="Leagues list"/>  
                    
                    <x-cv42.a-white-right link="{{ route($content.'.calibrate', $leagues_id) }}" icon="ion-ios-sync" title="Calibrate"/>

                </div>
                
                <br/>

                <div class="table-responsive m-t-20">               
                    <table id="data-table-default" class="table table-striped table-bordered">
                        <thead>
                            <tr>               
                                <x-cv42.th-first/>            
                                <x-cv42.th-content title="Home" />
                                <x-cv42.th-content title="Result" />
                                <x-cv42.th-content title="Away" />
                                <x-cv42.th-last/>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse ($data as $row)
                                <tr>
                                    <td>
                                        #{{ $row->round_league }}<br/>
                                        {{ $row->id }}
                                    </td>
                                    <td class="text-center">
                                        {{ $row->ch_nama }} 
                                        <em>
                                            ({{$row->last_home_points}} pts) 
                                        </em>
                                        {!!define_club_leagues($leagues_id, $row->home_clubs_id, 'home', 'avg_goals')!!}
                                        {!!define_club_leagues($leagues_id, $row->home_clubs_id, 'home', 'avg_corners')!!}
                                        {!!define_club_leagues($leagues_id, $row->home_clubs_id, 'home', 'avg_yellow_cards')!!}
                                        {!!define_club_leagues($leagues_id, $row->home_clubs_id, 'home', 'avg_red_cards')!!}
                                    </td>
                                    <td class="text-center">
                                        Goals
                                        <br/>
                                        {{ $row->home_goals }} - {{ $row->away_goals }}
                                        <br/>
                                        ou {{ $row->over_under_goals }}
                                        <br/>
                                        {{$row->home_hdp_corners}} + {{$row->away_hdp_goals}}
                                        <hr/>

                                        {!!corner_fav_icon($row->home_corner_fav)!!}
                                        Corners 
                                        {!!corner_fav_icon($row->away_corner_fav)!!}

                                        <br/>
                                        {{ $row->home_corners }} - {{ $row->away_corners }}
                                        <br/>
                                        ou {{ $row->over_under_corners }}
                                        <br/>
                                        {{$row->min_corners}} <> {{$row->max_corners}}
                                        <br/>
                                        {{$row->home_hdp_corners}} + {{$row->away_hdp_corners}}
                                        <hr/>

                                        Yellow Cards
                                        <br/>
                                        {{ $row->home_yellow_cards }} - {{ $row->away_yellow_cards }}                                        
                                        <hr/>

                                        Red Cards
                                        <br/>
                                        {{ $row->home_red_cards }} - {{ $row->away_red_cards }}
                                        <hr/>
                                    </td>
                                    <td class="text-center">
                                        {{ $row->ca_nama }}
                                        <em>
                                            ({{$row->last_away_points}} pts)
                                        </em>
                                        {!!define_club_leagues($leagues_id, $row->away_clubs_id, 'away', 'avg_goals')!!}
                                        {!!define_club_leagues($leagues_id, $row->away_clubs_id, 'away', 'avg_corners')!!}
                                        {!!define_club_leagues($leagues_id, $row->away_clubs_id, 'away', 'avg_yellow_cards')!!}
                                        {!!define_club_leagues($leagues_id, $row->away_clubs_id, 'away', 'avg_red_cards')!!}

                                    </td>
                                    <td class="with-btn" nowrap> 
                                        <div class="btn-group m-r-5 m-b-5">
                                            <a href="javascript:;" data-toggle="dropdown" class="btn btn-default dropdown-toggle"></a>
                                            <ul class="dropdown-menu">
                                                <x-cv42.dropdown-li-a link="{{ route($content.'.edit', $row->id) }}" icon="ion-md-create" title="Edit"/>

                                                <x-cv42.dropdown-li-a link="{{ route('Mybet.edit', $row->id) }}" icon="ion-md-create" title="My Bet"/>

                                                <x-cv42.dropdown-li-a link="{{ route('Postmatch.edit', $row->id) }}" icon="ion-md-create" title="Post Match"/>

                                                <x-cv42.dropdown-li-a link="{{ route('Postrawmatch.edit', $row->id) }}" icon="ion-md-create" title="Post Raw Match"/>

                                                <li class="divider"></li>

                                                <x-cv42.dropdown-li-a link="{{ route($content.'.show', $row->id) }}" icon="ion-ios-trash" title="Delete"/>
                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                                @empty 
                                    <x-message.tr-no-record-data col="10"/>
                            @endforelse
                        </tbody>
                    </table>        
                </div>
            </div>
        </div>
    </div>    
@endsection
