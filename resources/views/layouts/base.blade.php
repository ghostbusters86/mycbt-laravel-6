<!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>
    {{-- start: meta --}}
        @include('components._head')
        @livewireStyles
        @yield('css')
    {{-- end: meta --}}
</head>
	<body>
		<section class="body">
			{{-- start: header --}}
			    @include('components._header')
			{{-- end: header --}}

			<div class="inner-wrapper">
				{{-- start: sidebar --}}
                    @include('components._sidebar')
				{{-- end: sidebar --}}

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>@yield('title-2')</h2>
					</header>
					{{-- start: page --}}
                        @yield('content')
					{{-- end: page --}}
				</section>
			</div>

            {{-- start: js/jquery --}}
                @include('components._scripts')
                @livewireScripts
                @yield('js')
            {{-- end: js/jquery --}}
		</section>
	</body>
</html>