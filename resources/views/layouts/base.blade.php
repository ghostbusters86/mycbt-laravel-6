<!DOCTYPE html>
<html lang="en">
<head>
    {{-- META/TITLE/CSS --}}
        @include('components._head')
        @livewireStyles
        @yield('css')
    {{-- END META/TITLE/CSS --}}
</head>
<body class="animsition">
    <div class="page-wrapper">
        {{-- HEADER MOBILE --}}
            @include('components._header')
        {{-- END HEADER MOBILE --}}

        {{-- MENU SIDEBAR --}}
            @include('components._sidebar')
        {{-- END MENU SIDEBAR --}}

        {{-- PAGE CONTAINER --}}
        <div class="page-container">
            {{-- HEADER DESKTOP --}}
                @include('components._header-desktop')
            {{-- END HEADER DESKTOP --}}

            {{-- MAIN CONTENT --}}
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        {{-- PAGE TITLE --}}
                            @include('components._title-2')
                        {{-- END PAGE TITLE --}}

                        {{-- CONTENT --}}
                            @yield('content')
                        {{-- END CONTENT --}}
                        
                        {{-- FOOTER --}}
                            @include('components._footer')
                        {{-- END FOOTER --}}
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
    {{-- END JS/JQUERY --}}
</body>
</html>
