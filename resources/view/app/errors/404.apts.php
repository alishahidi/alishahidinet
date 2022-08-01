@extends('app.layouts.app')

@section('head-tag')
<!-- auth css -->
<title>علی شهیدی - صفحه پیدا نشد</title>
<meta name="description" content="صفحه پیدا نشد وبسایت شخصی علی شهیدی" />
<meta property="og:locale" content="fa_IR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="علی شهیدی - صفحه پیدا نشد" />
<meta property="og:description" content="صفحه پیدا نشد وبسایت شخصی علی شهیدی" />
<meta property="og:site_name" content="علی شهیدی - صفحه پیدا نشد‌" />
<meta property="article:publisher" content="<?= currentDomain() ?>" />
@endsection

@section('content')

<div class="main">
    <div class="container">
        <div class="row">
            <div class="error mt-3 mb-5">
                <h2 class="mt-2 h2">۴۰۴ - صفحه مورد نظر پیدا نشد.</h2>
                <a class="custom-btn custom-btn-secondary rounded-0 mt-4" href="<?= route('home.index') ?>">برگشت به صفحه اصلی</a>
            </div>
        </div>
    </div>
</div>
</main>

@endsection


@section('scripts')
<script>
    document.querySelector(".captcha-refresh").addEventListener("click", () => {
        let refreshUrl = "<?= route('captcha.get') ?>?" + Date.now();;
        console.log(refreshUrl);
        document.querySelector(".captcha-img").src = refreshUrl;
    });
</script>
@endsection
