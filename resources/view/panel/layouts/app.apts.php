<!DOCTYPE html>
<html lang="fr" dir="rtl">

<head>
     @include('panel.layouts.head-tag')
     @yield('head-tag')
</head>

<body class="theme-light">
    @include('panel.layouts.aside')
    <section class="dashboard">
        @include('panel.layouts.header')
        <div class="dash-content">
            @yield('content')
        </div>
    </section>
</body>
@include('panel.layouts.scripts')
@yield('scripts')
</html>
