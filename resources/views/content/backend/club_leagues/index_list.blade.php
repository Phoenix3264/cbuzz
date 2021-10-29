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
                    <x-cv42.a-white-right link="{{ route($content.'.create', $leagues_id) }}" icon="ion-ios-add" title="Create"/>  

                    <x-cv42.a-white-right link="{{ route('Multirawclubleagues.create', $leagues_id) }}" icon="ion-ios-add" title="Multi Club"/>  

                    <x-cv42.a-white-right link="{{ route('Fixtures.index_list', $leagues_id) }}" icon="ion-ios-eye" title="Fixtures"/>  

                    <x-cv42.a-white-right link="{{ route('Archives.index_list', $leagues_id) }}" icon="ion-ios-eye" title="Archives"/> 

                    <x-cv42.a-white-right link="{{ route($content.'.card_stats', $leagues_id) }}" icon="ion-ios-eye" title="Card Stats"/>  

                    <x-cv42.a-white-right link="{{ route($content.'.corner_wdl', $leagues_id) }}" icon="ion-ios-eye" title="Corner WDL"/>  

                    <x-cv42.a-white-right link="{{ route($content.'.corner_stats', $leagues_id) }}" icon="ion-ios-eye" title="Corner Stats"/>  

                    <x-cv42.a-white-right link="{{ route('Leagues.index_list', $countries_id) }}" icon="ion-ios-eye" title="Leagues list"/>  
                    
                    <x-cv42.a-white-right link="{{ route($content.'.calibrate', $leagues_id) }}" icon="ion-ios-sync" title="Calibrate"/>
                </div>
                
                <br/>

                <div class="table-responsive m-t-20">               
                    <table id="data-table-default" class="table table-striped table-bordered">
                        <thead>
                            <tr>               
                                <th class="text-center" rowspan="3">
                                    id
                                </th>        
                                <th class="text-center" rowspan="3">
                                    Nama
                                </th>            
                                <th class="text-center" colspan="6">
                                    Goals
                                </th>        
                                <th class="text-center" rowspan="3">
                                    Points
                                </th>     
                                <th width="5%" rowspan="3"></th>
                            </tr>
                            <tr class="text-center">
                                <th colspan="3">
                                    Home
                                </th>
                                <th colspan="3">
                                    Away
                                </th>
                            </tr>
                            <tr class="text-center">
                                <th>
                                    Min
                                </th>
                                <th>
                                    Avg
                                </th>
                                <th>
                                    Max
                                </th>

                                <th>
                                    Min
                                </th>
                                <th>
                                    Avg
                                </th>
                                <th>
                                    Max
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse ($data as $row)
                                <tr>
                                    <td>
                                        {{ $row->id }}
                                    </td>
                                    <td>
                                        {{ $row->nama }}
                                    </td>

                                    <td class="text-center">
                                        <em>
                                            {{$row->goals_home_min}}
                                        </em>
                                    </td>
                                    <td class="text-center">
                                        <em>
                                            {{$row->goals_home_avg}}
                                        </em>
                                    </td>
                                    <td class="text-center">
                                        <em>
                                            {{$row->goals_home_max}}
                                        </em>
                                    </td>

                                    <td class="text-center">
                                        <em>
                                            {{$row->goals_away_min}}
                                        </em>
                                    </td>
                                    <td class="text-center">
                                        <em>
                                            {{$row->goals_away_avg}}
                                        </em>
                                    </td>
                                    <td class="text-center">
                                        <em>
                                            {{$row->goals_away_max}}
                                        </em>
                                    </td>
                                    <td class="text-center">
                                        <em>
                                            {{ $row->points }}
                                        </em>
                                    </td>
                                    <td class="with-btn" nowrap> 
                                        <div class="btn-group m-r-5 m-b-5">
                                            <a href="javascript:;" data-toggle="dropdown" class="btn btn-default dropdown-toggle"></a>
                                            <ul class="dropdown-menu">
                                                <x-cv42.dropdown-li-a link="{{ route('Leagues.index_list', $row->id) }}" icon="ion-ios-eye" title="show Leagues"/>

                                                <x-cv42.dropdown-li-a link="{{ route('Clubs.index_list', $row->id) }}" icon="ion-ios-eye" title="show Clubs"/>

                                                <x-cv42.dropdown-li-a link="{{ route($content.'.edit', $row->id) }}" icon="ion-md-create" title="Edit"/>
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
