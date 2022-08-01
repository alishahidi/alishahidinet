@extends('panel.layouts.app')

@section('head-tag')
<title>پنل کاربری ویرایش پسورد</title>
@endsection

@section('content')

<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="create-outline"></ion-icon>
            <span class="text">ویرایش پسورد</span>
        </div>
    </div>
    <div class="card-body">
        <div class="card-table">
            <div class="border-bottom mb-4 pb-3">
                <a href="<?= backUrl() ?>" class="custom-btn custom-btn-secondary text-center rounded-0 w-100">بازگشت</a>
            </div>
            <div class="mt-5">
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
                <form action="<?= route('panel.password.update', [$user->id]) ?>" method="POST" class="form row g-3">
                    @token
                    @method('PUT')
                    <div class="col-12 mt-2">
                        <label for="password_old" class="form-label mb-3">پسورد فعلی:</label>
                        <input type="password" name="password_old" class="form-control" id="password_old" placeholder="پسورد فعلی" value="<?= e(old('password_old')) ?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="password" class="form-label mb-3">پسورد جدید:</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="پسورد جدید" value="<?= e(old('password')) ?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="confirm_password" class="form-label mb-3">تایید پسورد جدید:</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="در تایید پسورد جدید" value="<?= e(old('confirm_password')) ?>">
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="custom-btn custom-btn-primary text-center w-100 rounded-0">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
