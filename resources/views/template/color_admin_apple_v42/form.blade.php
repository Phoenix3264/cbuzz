<!DOCTYPE html>
<html lang="en">
	<head>
		<x-cv42.title title="{{$panel_name}}"/>
		<x-cv42.meta />
		<x-cv42.head-css />	
		<x-cv42.head-js />			
	</head>
	<body>
		<div id="page-loader" class="fade show"><span class="spinner"></span></div>

		<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
			
			<div id="header" class="header navbar-default">
				
				<x-cv42.navbar-header />
				
				<ul class="navbar-nav navbar-right">		
					<x-cv42.navbar-user />					
				</ul>
			</div>
			
			<div id="sidebar" class="sidebar">
				<div data-scrollbar="true" data-height="100%">	
					<x-cv42.sidebar-user />
					<x-cv42.sidebar-nav-cbuzz title="{{$panel_name}}" />
				</div>
			</div>
			<div class="sidebar-bg"></div>
			
			@yield('content')				
			
			<x-cv42.Scrolltotop />
		</div>

		<x-cv42.base-js />	
		<x-cv42.base-js-form />			
	</body>
</html>
