<header class="border-bottom">
    <div class="container">
        <nav class="navbar flex-row-reverse">
            <a class="navbar-brand" href="<?= route('home.index') ?>">علی شهیدی</a>
            <div class="btn-group gap-3 flex-row-reverse d-lg-none">
                <button class="nav-menu-btn d-flex align-items-center justify-content-center rounded-circle">
                    <ion-icon name="menu-outline"></ion-icon>
                </button>
            </div>
            <div class="flex-wrapper d-lg-flex">
                <ul class="desktop-nav d-lg-flex me-5">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= route('home.index') ?>">خانه</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= route('home.article.all') ?>">مقالات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= route('home.about.index') ?>">درباره من</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= route('home.contact.index') ?>">تماس</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= route('home.feed') ?>">RSS Feed</a>
                    </li>
                    <?php if (! \System\Auth\Auth::checkLogin()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('auth.register') ?>">ثبت نام</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('auth.login') ?>">ورود</a>
                        </li>
                    <?php } else { ?>
                        <?php if (\System\Auth\Auth::user()->permission == 'root') { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= route('admin.index') ?>">پنل ادمین</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('panel.index') ?>">پنل کاربری</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('auth.logout') ?>">خروج</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="mobile-nav">
                <button class="nav-close-btn d-flex align-items-center justify-content-center rounded-circle">
                    <ion-icon name="close-outline"></ion-icon>
                </button>
                <div class="wrapper mt-4">
                    <p class="h3 nav-title">منو</p>
                    <ul class="mt-3">
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="<?= route('home.index') ?>">خانه</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="<?= route('home.article.all') ?>">مقالات</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="<?= route('home.about.index') ?>">درباره من</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="<?= route('home.contact.index') ?>">تماس</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="<?= route('home.feed') ?>">RSS Feed</a>
                        </li>
                        <?php if (! \System\Auth\Auth::checkLogin()) { ?>
                            <li class="nav-item mt-3">
                                <a class="nav-link" href="<?= route('auth.register') ?>">ثبت نام</a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link" href="<?= route('auth.login') ?>">ورود</a>
                            </li>
                        <?php } else { ?>
                            <?php if (\System\Auth\Auth::user()->permission == 'root') { ?>
                                <li class="nav-item mt-3">
                                    <a class="nav-link" href="<?= route('admin.index') ?>">پنل ادمین</a>
                                </li>
                            <?php } ?>
                            <li class="nav-item mt-3">
                                <a class="nav-link" href="<?= route('panel.index') ?>">پنل کاربری</a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link" href="<?= route('auth.logout') ?>">خروج</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="wrapper mt-4">
                    <p class="h3 nav-title">عناوین</p>
                    <ul class="mt-3">
                        <?php foreach ($topics as $topic) { ?>
                            <li class="nav-item mt-3">
                                <a class="nav-link" href="<?= route('home.topic.show', [$topic->id, dash_space($topic->name)]) ?>"><?= e($topic->name) ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>