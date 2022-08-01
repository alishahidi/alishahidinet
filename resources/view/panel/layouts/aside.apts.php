<nav>
    <div class="logo-name d-flex text-center align-items-center">
        <span class="logo-name-title">پنل کاربری</span>
    </div>

    <div class="menu-items d-flex flex-column justify-content-between">
        <ul class="nav-links">
            <li>
                <a href="<?= route('panel.index') ?>">
                    <ion-icon name="home-outline"></ion-icon>
                    <span class="link-name">داشبورد</span>
                </a>
            </li>
            <li>
                <a href="<?= route('panel.comment.index') ?>">
                    <ion-icon name="chatbox-outline"></ion-icon>
                    <span class="link-name">کامنت ها</span>
                </a>
            </li>
            <li>
                <a href="<?= route('panel.detail.index') ?>">
                    <ion-icon name="reader-outline"></ion-icon>
                    <span class="link-name">مشخصات</span>
                </a>
            </li>
            <li>
                <a href="<?= route('panel.password.index') ?>">
                    <ion-icon name="finger-print-outline"></ion-icon>
                    <span class="link-name">پسورد</span>
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
