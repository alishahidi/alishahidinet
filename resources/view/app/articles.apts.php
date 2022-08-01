@extends('app.layouts.app')

@section('head-tag')
<title dir="ltr">علی شهیدی - <?= e($title) ?></title>
<meta name="description" content="<?= e($title) ?> وبسایت شخصی علی شهیدی" />
<link rel="canonical" href="<?= currentUrl() ?>" />
<meta property="og:locale" content="fa_IR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="علی شهیدی - <?= e($title) ?>" />
<meta property="og:description" content="<?= e($title) ?> وبسایت شخصی علی شهیدی" />
<meta property="og:url" content="<?= currentUrl() ?>" />
<meta property="og:site_name" content="علی شهیدی - <?= e($title) ?>‌" />
<meta property="article:publisher" content="<?= currentDomain() ?>" />
@endsection

@section('content')

<div class="main">
    <div class="container">
        <div class="row">
            <div class="blog">
                <h2 class="h2 text-center">مقالات</h2>
                <div class="blog-card-group">
                    <?php foreach ($articles as $article) { ?>
                        <div class="blog-card row">
                            <div class="col-sm-5">
                                <div class="blog-card-banner d-sm-block">
                                    <img src="<?= asset_ftp($article->image['main']) ?>" alt="<?= e($article->title) ?>" class="blog-banner-img">
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="blog-content-wrapper">
                                    <a href="<?= route('home.topic.show', [$article->topic()->id, $article->topic()->name]) ?>" class="blog-topic text-tiny"><?= e($article->topic()->name) ?></a>
                                    <h3>
                                        <a href="<?= route('home.article.show', [$article->id, $article->title]) ?>" class="h3"><?= e($article->title) ?></a>
                                    </h3>
                                    <p class="post-text"><?= e($article->description) ?></p>
                                    <div class="wrapper-flex">
                                        <div class="profile-wrapper d-md-block">
                                            <img src="<?= asset_ftp($article->user()->profile['thumbnail']) ?>" alt="<?= e($article->user()->name) ?>" width="50" height="50" />
                                        </div>

                                        <div class="wrapper d-flex justify-content-between text-center flex-wrap gap-3">
                                            <a href="#" class="h4"><?= e($article->user()->name) ?></a>
                                            <p class="text-sm align-items-center  d-flex text-center gap-1">
                                                <time><?= jdate($article->created_at)->format('%A, %d %B %y') ?></time>
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
                <nav class="d-flex justify-content-center">
                    <ul class="pagination">
                        <?= paginateView($articlesCount, 5, 4, 4, route('home.article.all'), '<li class="page-item"><a class="page-link" href="{link}">{counter}</a></li>', '<li class="page-item active"><a class="page-link" href="{link}">{counter}</a></li>', 'link', 'counter', 'بعدی', 'قبلی') ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection
