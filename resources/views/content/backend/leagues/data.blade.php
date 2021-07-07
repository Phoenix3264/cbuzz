@extends('template.color_admin_apple_v42.datatable')
@section('title', str_replace("_"," ", $content))
@section('sidebar')    
@endsection

@section('content')    	
    <div class="m-b-10">        
        <x-button-create link="{{ route($content.'.create') }}"/>
    </div>
    
    <br/>

    <div class="table-responsive m-t-10">				
        <table id="data-table-default" class="table table-striped table-bordered">
            <thead>
                <tr>               
                    <x-first-th/>            
                    <x-content-th title="Nama"/> 
                    <x-content-th title="Tahun"/>    
                    <x-last-th/>
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
                        <td>
                            {{ $row->tahun }}
                        </td>
                        <td class="with-btn" nowrap> 

                            <div class="btn-group m-r-5 m-b-5">
                                <a href="javascript:;" data-toggle="dropdown" class="btn btn-default dropdown-toggle"></a>
                                <ul class="dropdown-menu">

                                    <x-dropdown-li-a-show link="{{ route('Statistics.show', $row->id) }}" title="Statistic"/>

                                    <x-dropdown-li-a-show link="{{ route('Teamleagues.show', $row->id) }}" title="Teams"/>

                                    <x-dropdown-li-a-edit link="{{ route('Countries.edit', $row->id) }}" title="Edit"/>
                                    <li class="divider"></li>
                                    <li><a href="javascript:;">Action 4</a></li>
                                </ul>
                            </div>

                        </td>
                    </tr>
                    @empty
                        <x-no-record-data col="4"/>
                @endforelse
            </tbody>
        </table>		
    </div>
@endsection
