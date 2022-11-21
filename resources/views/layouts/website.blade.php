<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Premier Health Center is one of the best diagnostic center in Chennai</title>
    {{-- @yield('seo_tags') --}}
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}">
    @include('styles.admin')
</head>
<body class="root_admin"> 
    <main>
        {{-- === Sidebar  ===--}}
            @include('admin.sections.sidebar')
        {{-- === Sidebar  ===--}}

        <div class="main-content">
            <div class="sticky-top top-nav shadow-sm w-100 p-2 px-3">
                @include('admin.sections.breadcrumb')
            </div>
            <div class="p-3">
                @yield('web_content')
            </div>
        </div>
    </main>
</body>
</html>