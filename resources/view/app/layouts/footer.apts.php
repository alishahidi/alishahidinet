<footer class="text-center text-lg-start ">
    <div class="container text-center text-md-start pt-5">
        <div class="row pt-3">
            <div class="footer-brand col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
                <div class="d-flex align-items-center mb-4">
                    <ion-icon name="code-outline" class="footer-name-icon"></ion-icon>
                    <h5 class="footer-title text-sm me-3 pt-2">علی شهیدی</h5>
                </div>
                <p class="footer-text text-right">
                    همواره تلاش خواهم کرد بهترین های این مسیر رو انتخاب کنم.<br>
                    امیدوارم شما هم بتوانید به هدف خوب خودتون برسید.
                </p>
            </div>

            <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-4 pt-2">
                    لینک های سریع
                </h6>
                <ul class="footer-list">
                    <li class="footer-list-item">
                        <a href="<?= route('home.contact.index') ?>" class="footer-list-link">تماس با من</a>
                    </li>
                    <li class="footer-list-item">
                        <a href="<?= route('home.about.index') ?>" class="footer-list-link">درباره من</a>
                    </li>
                    <li class="footer-list-item">
                        <a href="<?= route('home.feed') ?>" class="footer-list-link">RSS Feed</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase fw-bold mb-4 pt-2">
                    ارتباط با من
                </h6>
                <ul class="footer-list">
                    <li class="footer-list-item">
                        <div class="d-flex align-items-center">
                            <ion-icon name="mail-outline" class="footer-list-icon"></ion-icon>
                            <p class="pt-3 me-3">alishahidi1376@gmail.com</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom text-center border-top">
        <p class="text-center d-rtl"><span>© کپی رایت <?= date('Y') ?> علی شهیدی - </span><span> تمام موارد آزاد است . </span><span>نوشته شده در <a href="https://github.com/alishahidi/apantos">apantos</a></span></p>
    </div>
</footer>
