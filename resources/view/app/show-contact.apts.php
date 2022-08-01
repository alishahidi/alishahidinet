@extends('app.layouts.app')

@section('head-tag')
<!-- contact css -->
<link rel="stylesheet" href="<?= asset('assets/app/css/contact.css') ?>">
<title>علی شهیدی - مشاهده تماس</title>
<meta name="description" content="مشاهده تماس وبسایت شخصی علی شهیدی" />
<link rel="canonical" href="<?= currentUrl() ?>" />
<meta property="og:locale" content="fa_IR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="علی شهیدی - مشاهده تماس" />
<meta property="og:description" content="مشاهده تماس وبسایت شخصی علی شهیدی" />
<meta property="og:url" content="<?= currentUrl() ?>" />
<meta property="og:site_name" content="علی شهیدی - مشاهده‌" />
<meta property="article:publisher" content="<?= currentDomain() ?>" />
@endsection

@section('content')
<div class="main">
    <div class="container">
        <div class="row">
            <div class="border-bottom mb-4 pb-3">
                <a href="<?= backUrl() ?>" class="custom-btn custom-btn-secondary text-center rounded-0 w-100">بازگشت</a>
            </div>
            <div class="show-contact mt-3 mb-5 pb-2 border-bottom">
                <h2 class="h2 mb-4">مشاهده تماس</h2>
                <div class="contact-card mt-5">
                    <p><b>اسم: </b><?= e($contact->name) ?></p>
                    <p><b>ایمیل: </b><?= e($contact->email) ?></p>
                    <p><b>موضوع: </b><?= e($contact->subject) ?></p>
                    <p><?= e($contact->text) ?></p>
                </div>
            </div>
            <div class="show-contact mt-3 mb-5">
                <h2 class="h2 mb-4">مشاهده پاسخ ها</h2>
                <?php foreach ($contact->answers() as $answer) { ?>
                    <div class="contact-card mt-5">
                        <p><b>پاسخ دهنده: </b><?= e($answer->user()->name) ?></p>
                        <p><b>موضوع: </b><?= e($answer->subject) ?></p>
                        <p><?= e($answer->text) ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

@endsection
