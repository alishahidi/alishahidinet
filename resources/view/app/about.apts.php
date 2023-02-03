@extends('app.layouts.app')

@section('head-tag')
<!-- about css -->
<link rel="stylesheet" href="<?= asset('assets/app/css/about.css') ?>" />
<title>علی شهیدی - درباره من</title>
<meta name="description" content="درباره من وبسایت شخصی علی شهیدی" />
<link rel="canonical" href="<?= route('home.about.index') ?>" />
<meta property="og:locale" content="fa_IR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="علی شهیدی - درباره من" />
<meta property="og:description" content="درباره من وبسایت شخصی علی شهیدی" />
<meta property="og:url" content="<?= route('home.about.index') ?>" />
<meta property="og:site_name" content="علی شهیدی - درباره من‌" />
<meta property="article:publisher" content="<?= currentDomain() ?>" />
@endsection

@section('content')

<div class="main">
    <div class="container">
        <div>
            <div class="about mb-5">
                <h2 class="title h2 text-center">درباره من</h2>
                <div class="about-card">
                    <h2 class="h2">سلام,</h2>
                    <p class="mt-4 about-text">من علی شهیدی هستم, برنامه نویس فول استک علاقه مند به gnu/linux و
                        نرم افزار های آزاد.</p>

                    <div class="row about-details mt-4">
                        <div class="col-md-6 mt-2">
                            <p>اسم: <b>علی شهیدی</b></p>
                            <p>تولد: <b>۲۲/۴/۱۳۸۳</b></p>
                        </div>
                        <div class="col-md-6 mt-2">
                            <p>ایمل: <b>alishahidi1376@gmail.com</b></p>
                            <p>گیت هاب: <b><a href="https://github.com/alishahidi">لینک</a></b></p>
                        </div>
                    </div>
                    <a href="#" class="custom-btn custom-btn-primary text-center mt-4 w-100 rounded-0">دانلود
                        CV (work soon)</a>
                </div>
            </div>
            <div class="skill mt-5 mb-4">
                <h2 class="title h2 text-center">مهارت های من</h2>
                <div class="skill-card">
                    <p class="mt-4 skill-text">درصدی تقریبی از مهارت هایی که یاد دارم.</p>
                    <div class="row skill-details mt-4">
                        <?php foreach ($skills as $skill) { ?>
                            <div class="col-md-6 mt-2 skill-item mb-4">
                                <div class="skill-title d-flex justify-content-between mb-2">
                                    <h3 class="h3"><?= e($skill->name) ?></h3>
                                    <span class="skill-text-percent"><?= e($skill->percent) ?>%</span>
                                </div>
                                <div class="skill-progress">
                                    <div class="progress rounded-0">
                                        <div class="progress-bar" role="progressbar" style="width: <?= e($skill->percent) ?>%;"></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="summary my-5">
                <div class="summary-card">
                    <div class="row">
                        <div class="col-md-3 col-6 mb-3">
                            <div class="summary-card-item d-flex flex-column justify-content-between align-items-center">
                                <ion-icon name="thumbs-up-outline"></ion-icon>
                                <h2 class="h2 mt-3"><?= count($services) ?></h2>
                                <p class="mt-1">سرویس ها</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="summary-card-item d-flex flex-column justify-content-between align-items-center">
                                <ion-icon name="file-tray-full-outline"></ion-icon>
                                <h2 class="h2 mt-3"><?= count($skills) ?></h2>
                                <p class="mt-1">مهارت ها</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="summary-card-item d-flex flex-column justify-content-between align-items-center">
                                <ion-icon name="code-outline"></ion-icon>
                                <h2 class="h2 mt-3"><?= count($projects) ?></h2>
                                <p class="mt-1">پروژه ها</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="summary-card-item d-flex flex-column justify-content-between align-items-center">
                                <ion-icon name="calendar-outline"></ion-icon>
                                <h2 class="h2 mt-3"><?= e($articlesCount) ?></h2>
                                <p class="mt-1">مقالات</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="service mt-3 mb-5">
                <h2 class="title h2 text-center">سرویس ها</h2>
                <div class="service-card">
                    <div class="row justify-content-center">
                        <?php foreach ($services as $service) { ?>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="service-card-item d-flex flex-column justify-content-between align-items-center border rounded">
                                    <ion-icon name="<?= e($service->icon) ?>"></ion-icon>
                                    <p class="mt-2"><?= e($service->name) ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="project mt-3 mb-5">
                <h2 class="title h2 text-center">پروژه ها</h2>
                <div class="project-card">
                    <div class="row justify-content-center">
                        <?php foreach ($projects as $project) { ?>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="project-card-item d-flex flex-column justify-content-between align-items-center border rounded">
                                    <div class="row">
                                        <div class="col-lg-5 col-12 mb-3">
                                            <div class="project-card-banner">
                                                <img src="<?= asset($project->image) ?>" alt="<?= e($project->title) ?>" class="project-banner-img">
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-12 mb-3">
                                            <div class="project-content-wrapper d-flex flex-column justify-content-between">
                                                <h3>
                                                    <a href="<?= e($project->link) ?>" class="h3"><?= e($project->title) ?></a>
                                                </h3>
                                                <p class="project-text"><?= e($project->description) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
