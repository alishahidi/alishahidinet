@extends('app.layouts.app')

@section('head-tag')
<!-- contact css -->
<link rel="stylesheet" href="<?= asset('assets/app/css/contact.css') ?>">
<title>علی شهیدی - تماس</title>
<meta name="description" content="تماس وبسایت شخصی علی شهیدی" />
<link rel="canonical" href="<?= route('home.contact.index') ?>" />
<meta property="og:locale" content="fa_IR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="علی شهیدی - تماس" />
<meta property="og:description" content="تماس وبسایت شخصی علی شهیدی" />
<meta property="og:url" content="<?= route('home.contact.index') ?>" />
<meta property="og:site_name" content="علی شهیدی - تماس‌" />
<meta property="article:publisher" content="<?= currentDomain() ?>" />
@endsection

@section('content')
<div class="main">
    <div class="container">
        <div class="row">
            <div class="contact mt-3 mb-5">
                <h2 class="h2 mb-4">مشاهده پاسخ تماس</h2>
                <div class="contact-card mt-5">
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
                    <form action="<?= route('home.contact.send.show') ?>" method="POST" class="contact-form row g-3">
                        @token
                        <div class="col-12 mt-2">
                            <label for="support_key" class="form-label mb-3">کد پشتیبانی:</label>
                            <input type="text" name="support_key" class="form-control" id="support_key" placeholder="کد پشتیبانی" value="<?= e(old('support_key')) ?>">
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="custom-btn custom-btn-primary text-center w-100 rounded-0">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="contact mt-3 mb-5">
                <h2 class="h2 mb-4">تماس با من</h2>
                <p>در این بخش اطلاعات خودت رو وارد کن و پیامت رو از این طریق برای من ارسال کن من به ایمیل ارسالی پاسخ خواهم داد.</p>
                <div class="contact-card mt-5">
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
                    <form action="<?= route('home.contact.store') ?>" method="POST" class="contact-form row g-3">
                        @token
                        <div class="col-md-6 mt-2">
                            <label for="name" class="form-label mb-3">اسم:</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="اسم شما" value="<?= e(old('name')) ?>">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="email" class="form-label mb-3">ایمیل:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="ایمیل شما" value="<?= e(old('email')) ?>">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="subject" class="form-label mb-3">موضوع:</label>
                            <input type="text" name="subject" class="form-control" id="subject" placeholder="موضوع انتخابی شما" value="<?= e(old('subject')) ?>">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="message" class="form-label mb-3">متن:</label>
                            <textarea name="text" name="message" id="message" rows="7" placeholder="متن ارسالی"><?= e(old('text')) ?></textarea>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="captcha" class="form-label mb-3">کد امنیتی</label>
                            <div class="input-group mb-3 rounded">
                                <input type="text" class="form-control rounded-0 w-auto mb-0" name="captcha" id="captcha" placeholder="کد امنیتی">
                                <span class="input-group-text ms-0 rounded-0 border-end-0 position-relative" id="captcha-img">
                                    <img class="captcha-img" src="<?= route('captcha.get') ?>" alt="captcha">
                                </span>
                            </div>
                            <p class="c-pointer captcha-refresh mb-2">رفرش کپچا</p>
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
