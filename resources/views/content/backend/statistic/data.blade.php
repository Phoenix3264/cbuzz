@extends('template.color_admin_apple_v42.datatable')
@section('title', str_replace("_"," ", $content))
@section('sidebar')    
@endsection

@section('content')    	
    <div class="m-b-10">      
        <x-button-white-right link="{{ route('Postmatches.create', $leagues_id) }}" icon="ion-ios-add" title="Post Match"/>  
        <x-button-white-right link="{{ route('Prematches.create', $leagues_id) }}" icon="ion-ios-add" title="Pre Match"/>
    </div>
    
    <br/>

    <div class="table-responsive m-t-10">				
        <table id="data-table-default" class="table table-striped table-bordered">
            <thead>
                <tr>               
                    <x-first-th/>            
                    <x-content-th title="R."/>
                    <x-content-th title="Matches"/>
                    <x-content-th title="HDP Result"/> 
                    <x-content-th title="OU Goals"/>  
                    <x-content-th title="Avg Goals"/>  
                    <x-content-th title="R. Goals"/>  
                    <x-content-th title="HDP Corner"/>  
                    <x-content-th title="OU Corner"/> 
                    <x-content-th title="Avg Corner"/>  
                    <x-content-th title="R. Corner"/>   
                    <x-last-th/>
                </tr>
            </thead>
            <tbody>
                
                @forelse ($data as $row)
                    <tr>
                        <td>
                            {{ $row->id }}
                        </td>
                        <td class="text-center">
                            {{ $row->round_league }}
                        </td>
                        <td>
                            {{ $row->HT_nama }}
                            <br/>
                            {{ $row->AT_nama }}
                        </td>
                        <td class="text-center">
                            {{ $row->home_hdp_goals }}
                            <br/>
                            {{ $row->away_hdp_goals }}
                        </td>
                        <td class="text-center">
                            {{ $row->over_under_goals }}
                        </td>
                        <td class="text-center">
                            {{ $row->home_avg_goals }}
                            <br/>
                            {{ $row->away_avg_goals }}
                        </td>
                        <td class="text-center">
                            {{ $row->home_goals }}
                            <br/>
                            {{ $row->away_goals }}
                        </td>
                        <td class="text-center">
                            {{ $row->home_hdp_corners }}
                            <br/>
                            {{ $row->away_hdp_corners }}
                        </td>
                        <td class="text-center">
                            {{ $row->over_under_corners }}
                        </td>
                        <td class="text-center">
                            {{ $row->home_avg_corners }}
                            <br/>
                            {{ $row->away_avg_corners }}
                        </td>
                        <td class="text-center">
                            {{ $row->home_corners }}
                            <br/>
                            {{ $row->away_corners }}
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    @empty
                        <x-no-record-data col="3"/>
                @endforelse
            </tbody>
        </table>		
    </div>
@endsection
