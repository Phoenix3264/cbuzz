@extends('template.color_admin_apple_v42.datatable')

@section('content')             
    <div id="content" class="content">
        <x-cv42.page-header header="{{$panel_name}}"/>

        <div class="row">
            {!!country_league()!!}
        </div>

        <div class="row">
            {!!top_corner_club_dashboard('Over', 'Over', null)!!}
            {!!top_corner_club_dashboard('Under', 'Under', null)!!}
        </div>
    </div>    
@endsection
