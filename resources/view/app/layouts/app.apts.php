<!DOCTYPE html>
<html lang="fa-IR" dir="rtl">

<head>
    @include('app.layouts.head-tag')
    @yield('head-tag')
</head>

<body>
    @include('app.layouts.header')
    <main>
        @yield('content')
    </main>
    @include('app.layouts.footer')
</body>
@include('app.layouts.scripts')
@yield('scripts')

</html>