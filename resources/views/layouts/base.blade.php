<!DOCTYPE html>
<html lang="en">
<head>
    {{-- meta/link/css --}}
    @include('components._head')
    @livewireStyles
    @yield('css')
</head>
<body class="animsition">
    <div class="page-wrapper">
        {{-- HEADER MOBILE --}}
        @include('components._header')

        {{-- MENU SIDEBAR --}}
        @include('components._sidebar')

        {{-- PAGE CONTAINER --}}
        <div class="page-container">
            {{-- HEADER DESKTOP --}}
            @include('components._header-desktop')

            {{-- MAIN CONTENT --}}
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        {{-- PAGE TITLE --}}
                        @include('components._title-2')

                        {{-- CONTENT --}}
                        @yield('content')
                        
                        {{-- FOOTER --}}
                        @include('components._footer')
                    </div>
                </div>
            </div>
            {{-- END MAIN CONTENT --}}

        </div>
        {{-- END PAGE CONTAINER --}}
        
    </div>

    {{-- JS/JQUERY --}}
    @include('components._scripts')
    @livewireScripts
    @yield('js')
</body>
</html>
