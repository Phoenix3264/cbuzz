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
                        <td class="with-btn" nowrap> 
                            <form 
                                onsubmit = "return confirm('Are you sure ?');" 
                                action = "{{ route($content.'.destroy', $row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                
                                <x-button-edit link="{{ route($content.'.edit', $row->id) }}"/>
                                <x-button-delete/>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <x-no-record-data col="3"/>
                @endforelse
            </tbody>
        </table>		
    </div>
@endsection
