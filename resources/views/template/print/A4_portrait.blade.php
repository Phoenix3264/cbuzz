<!DOCTYPE html>
<html lang="en">
	<head>		
		<x-print.title title="{{$panel_name}}"/>
		<x-print.head-css-a4-portrait />
	</head>
	<body>
		@yield('content')	
	</body>
</html>
