<nav>
    <div class="logo-name d-flex text-center align-items-center">
        <span class="logo-name-title">پنل ادمین</span>
    </div>

    <div class="menu-items d-flex flex-column justify-content-between">
        <ul class="nav-links">
            <li>
                <a href="<?= route('admin.index') ?>">
                    <ion-icon name="home-outline"></ion-icon>
                    <span class="link-name">داشبورد</span>
                </a>
            </li>
            <li>
                <a href="<?= route('admin.article.index') ?>">
                    <ion-icon name="book-outline"></ion-icon>
                    <span class="link-name">مقالات</span>
                </a>
            </li>
            <li>
                <a href="<?= route('admin.topic.index') ?>">
                    <ion-icon name="text-outline"></ion-icon>
                    <span class="link-name">تاپیک ها</span>
                </a>
            </li>
            <li>
                <a href="<?= route('admin.comment.index') ?>">
                    <ion-icon name="chatbubble-outline"></ion-icon>
                    <span class="link-name">کامنت ها</span>
                </a>
            </li>
            <li>
                <a href="<?= route('admin.user.index') ?>">
                    <ion-icon name="people-outline"></ion-icon>
                    <span class="link-name">کاربران</span>
                </a>
            </li>
            <li>
                <a href="<?= route('admin.contact.index') ?>">
                    <ion-icon name="mail-outline"></ion-icon>
                    <span class="link-name">تماس ها</span>
                </a>
            </li>
            <li>
                <a href="<?= route('admin.service.index') ?>">
                    <ion-icon name="apps-outline"></ion-icon>
                    <span class="link-name">سرویس ها</span>
                </a>
            </li>
            <li>
                <a href="<?= route('admin.skill.index') ?>">
                    <ion-icon name="code-outline"></ion-icon>
                    <span class="link-name">مهارت ها</span>
                </a>
            </li>
            <li>
                <a href="<?= route('admin.project.index') ?>">
                    <ion-icon name="code-slash-outline"></ion-icon>
                    <span class="link-name">پروژه ها</span>
                </a>
            </li>
        </ul>
        <ul class="logout-mode">
            <li>
                <a href="<?= route('auth.logout') ?>">
                    <ion-icon name="log-out-outline"></ion-icon>
                    <span class="link-name">خروج</span>
                </a>
            </li>
            <li class="mode d-flex align-items-center">
                <a href="#noaction">
                    <ion-icon name="moon-outline"></ion-icon>
                    <span class="link-name">تم دارک</span>
                </a>
                <div class="mode-toggle d-flex justify-content-center align-items-center">
                    <span class="switch"></span>
                </div>
            </li>
        </ul>
    </div>
</nav>
