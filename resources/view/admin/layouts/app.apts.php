<!DOCTYPE html>
<html lang="fr" dir="rtl">

<head>
     @include('admin.layouts.head-tag')
     @yield('head-tag')
</head>

<body class="theme-light">
    @include('admin.layouts.aside')
    <section class="dashboard">
        @include('admin.layouts.header')
        <div class="dash-content">
            @yield('content')
        </div>
    </section>
</body>
@include('admin.layouts.scripts')
@yield('scripts')
</html>
