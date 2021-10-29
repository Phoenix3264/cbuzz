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

                    <x-cv42.a-white-right link="{{ route($content.'.calibrate', $leagues_id) }}" icon="ion-ios-sync" title="Calibrate"/>

                </div>
                
                <br/>

                <div class="table-responsive m-t-20">               
                    <table id="data-table-default" class="table table-striped table-bordered">
                        <thead>
                            <tr>               
                                <x-cv42.th-first/>            
                                <x-cv42.th-content title="hdp" />
                                <x-cv42.th-content title="Home" />
                                <x-cv42.th-content title="Result" />
                                <x-cv42.th-content title="Away" />
                                <x-cv42.th-content title="hdp" />
                                <x-cv42.th-content title="mb" />
                                <x-cv42.th-content title="acc" />
                                <x-cv42.th-last/>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse ($data as $row)
                                <tr>
                                    <td>
                                        #{{ $row->round_league }}
                                    </td>
                                    <td class="text-center">                                        
                                        <br/>
                                        <?php 
                                            if(!is_null($row->home_hdp_goals)  && is_null($row->home_goals))
                                            {
                                                echo '<span class="badge badge-lime ">+';
                                            }
                                            else 
                                            {
                                                echo '<span>';
                                            }
                                            
                                            echo $row->home_hdp_goals;  
                                            // if(!is_null($row->handicap_voor_goals_status) && is_null($row->home_hdp_goals))
                                            // {
                                            //     echo '<br/>'.$row->handicap_voor_goals_status;
                                            // }         
                                            echo '</span>';
                                        ?>
                                        <hr/>
                                        <?php 
                                            if(!is_null($row->home_hdp_corners)  && is_null($row->home_corners))
                                            {   
                                                echo '<span class="badge badge-indigo ">+';
                                            }
                                            else 
                                            {
                                                echo '<span>';
                                            }
                                            
                                            echo $row->home_hdp_corners;     
                                            // if(!is_null($row->handicap_voor_corners_status) && is_null($row->home_hdp_corners))
                                            // {
                                            //     echo '<br/>'.$row->handicap_voor_corners_status;
                                            // }                                            
                                            echo '</span>';
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        {{ $row->ch_nama }} 
                                        <em>
                                            ({{$row->last_home_points}} pts) 
                                        </em>
                                        <br/>
                                        {{-- $row->prematch_total_avg_goals_as_home --}}
                                        <hr/>
                                        {{-- $row->prematch_total_avg_corners_as_home --}}
                                    </td>
                                    <td class="text-center">
                                        <br/>
                                        {{ $row->home_goals }} - {{ $row->away_goals }}
                                        <br/>
                                        <?php 
                                            if(!is_null($row->over_under_goals)  && is_null($row->home_goals)  && is_null($row->away_goals) )
                                            {
                                                echo '<span class="badge badge-lime ">+';
                                            }
                                            else 
                                            {
                                                echo '<span>';
                                            }
                                            
                                            echo $row->over_under_goals;

                                            if(!is_null($row->over_goals_status))
                                            {
                                                echo '<br/>'.$row->over_goals_status;
                                            }
                                            echo '</span>';
                                        ?>
                                        <hr/>
                                        {{ $row->home_corners }} - {{ $row->away_corners }}
                                        <br/>
                                        <?php 
                                            if(!is_null($row->over_under_corners)  && is_null($row->home_corners)  && is_null($row->away_corners) )
                                            {
                                                echo '<span class="badge badge-indigo ">+';
                                            }
                                            else 
                                            {
                                                echo '<span>';
                                            }
                                            
                                            echo $row->over_under_corners;
                                            if(!is_null($row->over_corners_status))
                                            {
                                                echo '<br/>'.$row->over_corners_status;
                                            }
                                            echo '</span>';


                                            if(!is_null($row->min_corners) && !is_null($row->max_corners) )
                                            {
                                                echo '<br/>'.$row->over_corners_status;
                                                echo '<span class="badge badge-indigo ">';
                                                    echo $row->min_corners;
                                                echo '</span> - ';
                                                echo '<span class="badge badge-indigo ">';
                                                    echo $row->max_corners;
                                                echo '</span>';
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        {{ $row->ca_nama }}
                                        <em>
                                            ({{$row->last_away_points}} pts)
                                        </em>
                                        <br/>
                                        {{$row->prematch_total_avg_goals_as_away}}
                                        <hr/>
                                        {{$row->prematch_total_avg_corners_as_away}}
                                    </td>
                                    <td class="text-center">
                                        <br/>
                                        <?php 
                                            if(!is_null($row->away_hdp_goals) && is_null($row->away_goals) )
                                            {
                                                echo '<span class="badge badge-lime ">+';
                                            }
                                            else 
                                            {
                                                echo '<span>';
                                            }

                                            echo $row->away_hdp_goals;    
                                            // if(!is_null($row->handicap_voor_goals_status) && is_null($row->away_hdp_goals))
                                            // {
                                            //     echo '<br/>'.$row->handicap_voor_goals_status;
                                            // }                                            
                                            echo '</span>';
                                        ?>
                                        <hr/>
                                        <?php 
                                            if(!is_null($row->away_hdp_corners) && is_null($row->away_corners) )
                                            {
                                                echo '<span class="badge badge-indigo ">+';
                                            }
                                            else 
                                            {
                                                echo '<span>';
                                            }
                                            
                                            echo $row->away_hdp_corners;  
                                            // if(!is_null($row->handicap_voor_corners_status) && is_null($row->away_hdp_corners))
                                            // {
                                            //     echo '<br/>'.$row->handicap_voor_corners_status;
                                            // }                                                      
                                            echo '</span>';
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        {{ $row->my_bet }} <br/>
                                        {{ $row->notes }} 
                                    </td>
                                    <td class="text-center">
                                        {{ $row->akurasi }}<br/>
                                        {{ $row->bet_status }} 
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
