@extends('template.color_admin_apple_v42.datatable')

@section('content')             
    <div id="content" class="content">
        <x-cv42.breadcrumb link2="{{ route($content.'.index') }}" level2="{{$panel_name}}" level3="Data" />
        <x-cv42.page-header header="{{$panel_name}}"/>
        <div class="panel panel-inverse">
            <x-cv42.panel-heading title="Table Data"/>

            <div class="panel-body">   

                @if(session()->has('Success'))
                    <x-cv42.alert-form-saved />
                @elseif(session()->has('Deleted'))
                    <x-cv42.alert-form-deleted />
                @endif

                <div class="m-b-20">    
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
                                <x-cv42.th-content title="My Bet" />
                                <x-cv42.th-content title="acc" />
                                <x-cv42.th-last/>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse ($data as $row)
                                <tr>
                                    <td>
                                        {{ $row->league_name }}<br/>
                                        #{{ $row->round_league }}
                                    </td>
                                    <td class="text-center">
                                        {{ $row->ch_nama }} 

                                        {!!define_club_leagues($row->leagues_id, $row->home_clubs_id, 'home', 'avg_corners')!!}

                                    </td>
                                    <td class="text-center">
                                        <br/>
                                        {!!corner_fav_icon($row->home_corner_fav)!!}
                                            Corners 
                                        {!!corner_fav_icon($row->away_corner_fav)!!}

                                        <br/>
                                            {{$row->home_hdp_corners}} || {{$row->away_hdp_corners}}
                                        <br/>
                                            ou {{ $row->over_under_corners }}
                                        <br/>
                                            {{$row->min_corners}} <> {{$row->max_corners}}
                                    </td>   
                                    <td class="text-center">
                                        {{ $row->ca_nama }}

                                        {!!define_club_leagues($row->leagues_id, $row->away_clubs_id, 'away', 'avg_corners')!!}

                                    </td>
                                    <td class="text-center">
                                        {{ $row->my_bet }}<hr/>
                                        {{ $row->notes }} 
                                    </td>
                                    <td class="text-center">
                                        {{ $row->akurasi }}
                                    </td>
                                    <td class="with-btn" nowrap> 
                                        <div class="btn-group m-r-5 m-b-5">
                                            <a href="javascript:;" data-toggle="dropdown" class="btn btn-default dropdown-toggle"></a>
                                            <ul class="dropdown-menu">
                                                <x-cv42.dropdown-li-a link="{{ route($content.'.edit', $row->id) }}" icon="ion-md-create" title="Corner Bet"/>
                                                <x-cv42.dropdown-li-a link="{{ route('Postmatch.edit', $row->id) }}" icon="ion-md-create" title="Post Match"/>
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
