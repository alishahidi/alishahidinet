@extends('app.layouts.app')

@section('head-tag')
<!-- auth css -->
<link rel="stylesheet" href="<?= asset('assets/app/css/auth.css') ?>" />
<title>علی شهیدی - ورود</title>
<meta name="description" content="ورود وبسایت شخصی علی شهیدی" />
<link rel="canonical" href="<?= route('auth.login') ?>" />
<meta property="og:locale" content="fa_IR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="علی شهیدی - ورود" />
<meta property="og:description" content="ورود وبسایت شخصی علی شهیدی" />
<meta property="og:url" content="<?= route('auth.login') ?>" />
<meta property="og:site_name" content="علی شهیدی - ورود‌" />
<meta property="article:publisher" content="<?= currentDomain() ?>" />
@endsection

@section('content')

<div class="main">
    <div class="container">
        <div class="row">
            <div class="auth mt-3 mb-5">
                <h2 class="h2 mb-4">ورود</h2>
                <p>خوش آمدید</p>
                <div class="auth-card mt-5">
                    <?php if (flashExists()) { ?>
                        <section class="alert alert-success">
                            <p>پیغام سیستم (<?= flashExists() ?>)</p>
                            <hr>
                            <ul class="list-group-numbered">
                                <?php foreach (allFlashes() as $flash) { ?>
                                    <li><?= e($flash) ?></li>
                                <?php } ?>
                            </ul>
                        </section>
                    <?php } ?>
                    <?php if (errorExists()) { ?>
                        <section class="alert alert-danger">
                            <p>پیغام سیستم (<?= errorExists() ?>)</p>
                            <hr>
                            <ul class="list-group-numbered">
                                <?php foreach (allErrors() as $error) { ?>
                                    <li><?= e($error) ?></li>
                                <?php } ?>
                            </ul>
                        </section>
                    <?php } ?>
                    <form action="<?= route('auth.login') ?>" method="POST" class="auth-form row g-3">
                        @token
                        <div class="col-md-12 mt-2">
                            <label for="email" class="form-label mb-3">ایمیل:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="ایمیل شما">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="password" class="form-label mb-3">پسورد:</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="پسورد">
                        </div>
                        <div class="col-12 mt-2 pb-2 border-bottom">
                            <label for="captcha" class="form-label mb-3">کد امنیتی</label>
                            <div class="input-group mb-3 rounded">
                                <input type="text" class="form-control rounded-0 w-auto mb-0" name="captcha" id="captcha" placeholder="کد امنیتی">
                                <span class="input-group-text ms-0 rounded-0 border-end-0 position-relative" id="captcha-img">
                                    <img class="captcha-img" src="<?= \System\Security\Security::buildInnerCaptcha() ?>" alt="captcha">
                                </span>
                            </div>
                            <p class="c-pointer captcha-refresh mb-2">رفرش کپچا</p>
                        </div>
                        <div class="form-check me-2">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" checked>
                            <label class="form-check-label" for="remember">
                                مرا بخاطر بسپار
                            </label>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="custom-btn custom-btn-primary text-center w-100 rounded-0">ارسال</button>
                        </div>
                    </form>
                </div>
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
