@extends('app.layouts.app')

@section('head-tag')
<title>علی شهیدی - صفحه اصلی</title>
<meta name="description" content="صفحه اصلی وبسایت شخصی علی شهیدی" />
<link rel="canonical" href="<?= route('home.index') ?>" />
<meta property="og:locale" content="fa_IR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="علی شهیدی - صفحه اصلی" />
<meta property="og:description" content="صفحه اصلی وبسایت شخصی علی شهیدی" />
<meta property="og:url" content="<?= route('home.index') ?>" />
<meta property="og:site_name" content="علی شهیدی - صفحه اصلی‌" />
<meta property="article:publisher" content="<?= currentDomain() ?>" />
@endsection

@section('content')

<div class="hero">
    <div class="container pt-4">
        <div class="row">
            <div class="left col-lg-6">
                <h1 class="h1">
                    سلام من<b> علی</b> هستم.<br><small>توسعه دهنده, برنامه نویس</small>
                </h1>
                <p class="h3">
                    من به وب و gnu/linux علاقه دارم.
                </p>
                <div class="btn-group d-flex flex-wrap gap-3">
                    <a href="<?= route('home.contact.index') ?>" class="custom-btn custom-btn-primary">ارتباط با من</a>
                    <a href="<?= route('home.about.index') ?>" class="custom-btn custom-btn-secondary">درباره من</a>
                </div>
            </div>
            <div class="right col-lg-6 d-lg-flex">
                <div class="pattern-bg">
                    <div class="img-box">
                        <img src="<?= asset('assets/app/images/hero.jpg') ?>" alt="Profile" class="hero-img">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <h1 class="h2 mb-5">
                    بیشتر در باره من
                </h1>
                <p class="h3">
                    من برنامه نویس با چندین سال تجربه شخصی در بخش های مختلف هستم با تمرکز به PHP Laravel. و همچنین من گیک در لینوکس و ایمکس هستم. همیشه تلاش کردم بهترین راه و روش انتخاب کنم و در اون بروز باشم.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="blog col-lg-8">
                <h2 class="h2 text-center">آخرین مقالات</h2>
                <div class="blog-card-group">
                    <?php foreach ($articles as $article) { ?>
                        <div class="blog-card row">
                            <div class="col-sm-5">
                                <div class="blog-card-banner d-sm-block">
                                    <img src="<?= asset($article->image['thumbnail']) ?>" alt="<?= e($article->title) ?>" class="blog-banner-img">
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="blog-content-wrapper">
                                    <a href="<?= route('home.topic.show', [$article->topic()->id, dash_space($article->topic()->name)]) ?>" class="blog-topic text-tiny"><?= e($article->topic()->name) ?></a>
                                    <h3>
                                        <a href="<?= route('home.article.show', [$article->id, dash_space($article->title)]) ?>" class="h3"><?= e($article->title) ?></a>
                                    </h3>
                                    <p class="post-text"><?= e($article->description) ?></p>
                                    <div class="wrapper-flex">
                                        <div class="profile-wrapper d-md-block">
                                            <img src="<?= asset($article->user()->profile['thumbnail']) ?>" alt="<?= e($article->user()->name) ?>" width="50" height="50" />
                                        </div>

                                        <div class="wrapper d-flex justify-content-between text-center flex-wrap gap-3">
                                            <a href="#todo" class="h4"><?= e($article->user()->name) ?></a>
                                            <p class="text-sm align-items-center  d-flex text-center gap-1">
                                                <time datetime="2022-01-17"><?= jdate($article->created_at)->format('%A, %d %B %y') ?></time>
                                                <span class="separator"></span>
                                                <ion-icon name="time-outline"></ion-icon>
                                                <time><?= estimateReadingTimePrintPersian(estimateReadingTime($article->content)) ?></time>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="<?= route('home.article.all') ?>" class="custom-btn load-more text-center">دیدن موارد بیشتر</a>
                </div>
            </div>
            <div class="aside col-lg-4 d-lg-block">
                <div class="topics">
                    <h2 class="h2">عناوین</h2>
                    <?php foreach ($topics as $topic) { ?>
                        <a href="<?= route('home.topic.show', [$topic->id, dash_space($topic->name)]) ?>" class="topic-btn">
                            <div class="icon-box">
                                <ion-icon name="text-outline"></ion-icon>
                            </div>
                            <p><?= e($topic->name) ?></p>
                        </a>
                    <?php } ?>
                </div>
                <div class="tags">
                    <h2 class="h2">برخی از برچسب ها</h2>
                    <div class="wrapper">
                        <?php foreach ($tags as $tag) { ?>
                            <a href="<?= route('home.tag.index', [$tag->id, dash_space($tag->name)]) ?>" class="hashtag">#<?= $tag->name ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="contact">
                    <h2 class="h2">راه های ارتباطی</h2>
                    <div class="wrapper">
                        <p>
                            با من از طریق راه های زیر میتونی ارتباط بر قرار کنی.<br>
                            و من سعی خودم خواهم کرد که حتما به شما جواب بدم.
                        </p>
                        <ul class="social-link d-flex justify-content-center align-items-center">
                            <li>
                                <a href="https://github.com/alishahidi" class="icon-box github d-flex justify-content-center align-items-center">
                                    <ion-icon name="logo-github"></ion-icon>
                                </a>
                            </li>
                            <li>
                                <a href="https://instagram.com/alishahidi_insta/" class="icon-box instagram d-flex justify-content-center align-items-center">
                                    <ion-icon name="logo-instagram"></ion-icon>
                                </a>
                            </li>
                            <li>
                                <a href="mailto: alishahidi1376@gmail.com" class="icon-box email d-flex justify-content-center align-items-center">
                                    <ion-icon name="mail-outline"></ion-icon>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="newsletter">
                    <h2 class="h2">خبرنامه</h2>
                    <div class="wrapper">
                        <p>
                            شما میتوانید در خبرنامه من عضو بشید تا هروقت محتوایی منتشر شد شمارو مطلع کنیم.<br>
                            هر بار چند نفر به صورت اتفاقی مطلع میکنیم.
                        </p>
                        <form method="post" action="#">
                            <input type="email" name="email" value="example@test.org" required />
                            <button type="submit" class="custom-btn custom-btn-primary text-center w-100 rounded-0">ارسال</button>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

@endsection