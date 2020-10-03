<!DOCTYPE html>
<html lang="en">
<head>
    {{-- start: meta/link/css --}}
    @include('components._head-client')
    {{-- end: meta/link/css --}}
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        {{-- start: Navbar --}}
        @include('components._navbar-client')
        {{-- end: navbar --}}

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> @yield('title-2')</h1>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content">
                <div class="container">
                    {{-- start: content --}}
                    @yield('content')
                    {{-- end: content --}}
                </div>
            </div>
        </div>

        {{-- Main Footer --}}
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Putralangkat97
            </div>
            <strong>Copyright &copy; 2014-{{ date('Y') }} <a href="http://putralangkat.github.io">Putralangkat97</a>.</strong> All rights reserved.
        </footer>
    </div>

    {{-- jQuery --}}
    @include('components._scripts-client')
</body>
</html>