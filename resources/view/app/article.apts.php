@extends('app.layouts.app')

@section('head-tag')
<!-- about css -->
<link rel="stylesheet" href="<?= asset('assets/app/css/post.css') ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.28.0/themes/prism-tomorrow.min.css" integrity="sha256-GxX+KXGZigSK67YPJvbu12EiBx257zuZWr0AMiT1Kpg=" crossorigin="anonymous">
<title>علی شهیدی - <?= hpd($article->title) ?></title>
<meta name="desc" content="content" />
<meta name="description" content="<?= hpd($article->description) ?>" />
<meta name="keywords" content="<?= implode(', ', objectToArray($article->tags(), 'name')) ?>">
<meta name="author" content="<?= hpd($article->user()->name) ?>">
<link rel="canonical" href="<?= route('home.article.show', [$article->id, hpd($article->title)]) ?>" />
<meta property="og:locale" content="fa_IR" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?= hpd($article->title) ?>‌" />
<meta property="og:description" content="<?= hpd($article->description) ?>" />
<meta property="og:url" content="<?= route('home.article.show', [$article->id, hpd($article->title)]) ?>" />
<meta property="og:site_name" content="علی شهیدی - مقاله" />
<meta property="article:publisher" content="<?= currentDomain() ?>" />
<meta property="article:published_time" content="<?= date('D M j G:i:s T Y', strtotime($article->created_at)) ?>" />
<meta property="article:modified_time" content="<?= date('D M j G:i:s T Y', strtotime($article->updated_at)) ?>" />
<meta property="og:image" content="<?= asset_ftp($article->image['main']) ?>" />
<meta property="og:image:width" content="510" />
<meta property="og:image:height" content="350" />
<meta property="og:image:type" content="image/jpeg" />
@endsection

@section('content')

<div class="main">
    <div class="container">
        <div>
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
            <div class="post-header">
                <div class="row align-items-center">
                    <div class="col-md-7 col-12 mb-5">
                        <a href="<?= route('home.topic.show', [$article->topic()->id, dash_space($article->topic()->name)]) ?>" class="post-topic text-tiny"><?= e($article->topic()->name) ?></a>
                        <h1 class="my-4">
                            <a href="<?= route('home.article.show', [$article->id, dash_space($article->title)]) ?>" class="h3"><?= e($article->title) ?></a>
                        </h1>
                        <div class="wrapper-flex">
                            <div class="post-img-wrapper">
                                <img src="<?= asset_ftp($article->user()->profile['thumbnail']) ?>" alt="<?= e($article->user()->name) ?>" width="50" />
                            </div>

                            <div class="wrapper d-flex justify-content-between text-center flex-wrap">
                                <a href="#todo" class="h4"><?= e($article->user()->name) ?></a>
                                <p class="text-sm align-items-center d-flex text-center gap-1">
                                    <time><?= jdate($article->created_at)->format('%A, %d %B %y') ?></time>
                                    <span class="separator"></span>
                                    <ion-icon name="time-outline"></ion-icon>
                                    <time><?= estimateReadingTimePrintPersian(estimateReadingTime($article->content)) ?></time>
                                </p>
                            </div>
                        </div>
                        <div class="url d-inline-block mt-4">
                            <div class="url-flex d-flex flex-row-reverse">
                                <div class="url-copy c-pointer" data-clipboard-text="<?= route('home.url', [$article->url()->token]) ?>">
                                    کپی آدرس
                                </div>
                                <div class="url-address" id="url">
                                    <a href="<?= route('home.url', [$article->url()->token]) ?>"><?= trim_url(route('home.url', [$article->url()->token])) ?></a>
                                </div>
                                <div class="url-text">
                                    لینک کوتاه :
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-12 mb-3">
                        <div class="post-header-img">
                            <img src="<?= asset_ftp($article->image['main']) ?>" alt="<?= e($article->title) ?>" class="blog-banner-img">
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-main mt-4">
                <?= hpd($article->content) ?>
            </div>
            <div class="post-footer">
                <div class="tag d-flex align-items-center mt-3 mb-5 py-4 border-bottom">
                    <h4 class="text">برچسب ها:</h4>
                    <div class="wrapper">
                        <?php foreach ($article->tags() as $tag) { ?>
                            <a href="<?= route('home.tag.index', [$tag->id, dash_space($tag->name)]) ?>" class="hashtag">#<?= e($tag->name) ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="author d-flex pb-5 border-bottom">
                    <div class="author-profile flex-shrink-0">
                        <img src="<?= asset_ftp($article->user()->profile['main']) ?>" class="rounded-circle w-100" alt="<?= e($article->user()->name) ?>">
                    </div>
                    <div class="me-5">
                        <h5 class="author-name"><?= e($article->user()->name) ?></h5>
                        <p class="author-bio"><?= e($article->user()->bio) ?></p>
                    </div>
                </div>
                <div class="related mt-5 mb-5">
                    <h2 class="title h2 text-center mt-3">پست های مرتبط</h2>
                    <div class="related-card">
                        <div class="row justify-content-center">
                            <?php foreach ($relatedArticles as $relatedArticle) { ?>
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <div class="related-card-item d-flex flex-column justify-content-between align-items-center border rounded">
                                        <div class="row">
                                            <div class="col-lg-5 col-12 mb-3">
                                                <div class="related-card-banner">
                                                    <img src="<?= asset_ftp($relatedArticle->image['thumbnail']) ?>" alt="<?= e($relatedArticle->title) ?>" class="related-banner-img">
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-12 mb-3">
                                                <div class="related-content-wrapper">
                                                    <a href="<?= route('home.topic.show', [$relatedArticle->topic()->id, dash_space($relatedArticle->topic()->name)]) ?>" class="related-topic text-tiny"><?= e($relatedArticle->topic()->name) ?></a>
                                                    <h3>
                                                        <a href="<?= route('home.article.show', [$relatedArticle->id, dash_space($relatedArticle->title)]) ?>" class="h3"><?= e($relatedArticle->title) ?></a>
                                                    </h3>
                                                    <div class="wrapper-flex">
                                                        <div class="wrapper d-flex justify-content-between text-center flex-wrap gap-3">
                                                            <a href="#todo" class="h4"><?= e($relatedArticle->user()->name) ?></a>
                                                            <p class="text-sm align-items-center d-flex text-center gap-1">
                                                                <time><?= jdate($relatedArticle->created_at)->format('%A, %d %B %y') ?></time>
                                                                <span class="separator"></span>
                                                                <ion-icon name="time-outline"></ion-icon>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="comment mt-3 mb-5">
                    <h2 class="title h2 text-center">کامنت ها</h2>
                    <div class="comment-card">
                        <h4 class="comment-text">درج نظر:</h4>
                        <div class="row mb-5">
                            <form action="<?= route('home.article.comment', [$article->id]) ?>" method="POST">
                                @token
                                <textarea name="comment" rows="6" placeholder="متن نظر..."></textarea>
                                <button type="submit" class="custom-btn custom-btn-primary text-center w-100 rounded-0">ارسال</button>
                            </form>
                        </div>
                        <div class="comment-separator"></div>
                        <div class="row mb-4">
                            <?php foreach ($article->comments() as $comment) { ?>
                                <div class="comment-card-item my-2">
                                    <div class="row">
                                        <div class="col-xl-1 col-sm-2 col-0 d-sm-block d-none">
                                            <div class="comment-img-wrapper">
                                                <img src="<?= asset_ftp($comment->user()->profile['thumbnail']) ?>" alt="<?= e($comment->user()->name) ?>" width="50" />
                                            </div>
                                        </div>
                                        <div class="col-xl-11 col-sm-10 col-12 d-flex flex-column justify-content-between">
                                            <div class="d-flex">
                                                <a href="#todo"><?= e($comment->user()->name) ?></a>
                                                <time><?= jdate($comment->created_at)->format('%A, %d %B %y') ?></time>
                                            </div>
                                            <p><?= e($comment->comment) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- <div class="comment-line"></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.28.0/components/prism-core.min.js" integrity="sha256-4mJNT2bMXxcc1GCJaxBmMPdmah5ji0Ldnd79DKd1hoM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.28.0/plugins/autoloader/prism-autoloader.min.js" integrity="sha256-dL6vkUiCn30lPTN9cVrmQHo5UQmEwDMrx2ppAk4IhVk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<script type="text/javascript">
    let copy = new ClipboardJS('.url-copy');
    copy.on('success', function(e) {
        e.trigger.innerHTML = "کپی شد!"
        e.clearSelection();
        setTimeout(function() {
            e.trigger.innerHTML = "کپی آدرس"
        }, 2500);
    });
</script>
@endsection
