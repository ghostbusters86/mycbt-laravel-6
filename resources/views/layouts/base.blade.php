<!DOCTYPE html>
<html>
<head>
	{{-- start: head/meta/title --}}
		@include('components._head')
		@livewireStyles
		@yield('css')
	{{-- end: head/meta/title --}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
{{-- Site wrapper --}}
	<div class="wrapper">
		{{-- start: navbar --}}
			@include('components._navbar')
		{{-- end: navbar --}}

		{{-- start: sidebar --}}
			@include('components._sidebar')
		{{-- end: sidebar --}}

		{{-- start: content --}}
			<div class="content-wrapper">
				<section class="content-header">
					<div class="container-fluid">
						{{-- biarkan saja ini kosong --}}
					</div>
				</section>

				{{-- Main content --}}
				<section class="content">
					<div class="container-fluid">
						@yield('content')
					</div>
				</section>
			</div>
		{{-- end: content --}}

		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				<b>Version</b> 3.0.5
			</div>
			<strong>Copyright &copy; 2014-{{ date('Y') }} <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
			reserved.
		</footer>
	</div>

	{{-- start: js/jQuery --}}
		@include('components._scripts')
		@livewireScripts
		@yield('js')
	{{-- end: js/jQuery --}}
</body>
</html>
