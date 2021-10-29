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
                                <x-cv42.th-content title="hdp" />
                                <x-cv42.th-content title="Home" />
                                <x-cv42.th-content title="Result" />
                                <x-cv42.th-content title="Away" />
                                <x-cv42.th-content title="hdp" />
                                <x-cv42.th-content title="My Bet" />
                                <x-cv42.th-content title="acc" />
                                <x-cv42.th-last/>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse ($data as $row)
                                <tr>
                                    <td>
                                        {{ $row->league_name }}
                                    </td>
                                    <td class="text-center">                                        
                                        <br/>
                                        <?php 
                                            if(!is_null($row->home_hdp_goals))
                                            {
                                                echo '<span class="badge badge-lime ">
                                                        +'.$row->home_hdp_goals.
                                                        '</span>';
                                            }
                                        ?>
                                        <hr/>
                                        <?php 
                                            if(!is_null($row->home_hdp_corners))
                                            {
                                                echo '<span class="badge badge-indigo ">
                                                        +'.$row->home_hdp_corners.
                                                        '</span>';
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        {{ $row->ch_nama }} 
                                        <em>
                                            ({{$row->last_home_points}} pts) 
                                        </em>
                                        <br/>
                                    </td>
                                    <td class="text-center">
                                        <br/>
                                        {{ $row->home_goals }} - {{ $row->away_goals }}
                                        <br/>
                                        <?php 
                                            if(!is_null($row->over_under_goals))
                                            {
                                                echo '<span class="badge badge-lime ">
                                                        +'.$row->over_under_goals.
                                                        '</span>';
                                            }
                                        ?>
                                        <hr/>
                                        {{ $row->home_corners }} - {{ $row->away_corners }}
                                        <br/>
                                        <?php 
                                            if(!is_null($row->over_under_corners))
                                            {
                                                echo '<span class="badge badge-indigo ">
                                                        +'.$row->over_under_corners.
                                                        '</span>';
                                            }

                                            if(!is_null($row->min_corners) && !is_null($row->max_corners) )
                                            {
                                                echo '<br/>';
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
                                    </td>
                                    <td class="text-center">
                                        <br/>
                                        <?php 
                                            if(!is_null($row->away_hdp_goals))
                                            {
                                                echo '<span class="badge badge-lime ">
                                                        +'.$row->away_hdp_goals.
                                                        '</span>';
                                            }
                                        ?>
                                        <hr/>
                                        <?php 
                                            if(!is_null($row->away_hdp_corners))
                                            {
                                                echo '<span class="badge badge-indigo ">
                                                        +'.$row->away_hdp_corners.
                                                        '</span>';
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        {{ $row->my_bet }}<br/>
                                        {{ $row->notes }} 
                                    </td>
                                    <td class="text-center">
                                        {{ $row->akurasi }}
                                    </td>
                                    <td class="with-btn" nowrap> 
                                        <div class="btn-group m-r-5 m-b-5">
                                            <a href="javascript:;" data-toggle="dropdown" class="btn btn-default dropdown-toggle"></a>
                                            <ul class="dropdown-menu">
                                                <x-cv42.dropdown-li-a link="{{ route($content.'.edit', $row->id) }}" icon="ion-md-create" title="Edit"/>
                                                <x-cv42.dropdown-li-a link="{{ route('Mybet.edit', $row->id) }}" icon="ion-md-create" title="Set Bet"/>
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
