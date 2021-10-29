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
                    <x-cv42.a-white-right link="{{ route($content.'.create') }}" icon="ion-ios-add" title="Create"/>  
                </div>
                
                <br/>

                <div class="table-responsive m-t-20">               
                    <table id="data-table-default" class="table table-striped table-bordered">
                        <thead>
                            <tr>               
                                <x-cv42.th-first/>            
                                <x-cv42.th-content title="Nama" />
                                <x-cv42.th-content title="Country" />
                                <x-cv42.th-last/>
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
                                        {{ $row->nama_countries }}
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
                                    <x-message.tr-no-record-data col="4"/>
                            @endforelse
                        </tbody>
                    </table>        
                </div>
            </div>
        </div>
    </div>    
@endsection
