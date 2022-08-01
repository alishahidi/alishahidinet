@extends('admin.layouts.app')

@section('head-tag')
<title>پنل ادمین ویرایش کاربر</title>
@endsection

@section('content')

<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="create-outline"></ion-icon>
            <span class="text">ویرایش کاربر</span>
        </div>
    </div>
    <div class="card-body">
        <div class="card-table">
            <div class="border-bottom mb-4 pb-3">
                <a href="<?= backUrl() ?>" class="custom-btn custom-btn-secondary text-center rounded-0 w-100">بازگشت</a>
            </div>
            <div class="mt-5">
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
                <form action="<?= route('admin.user.update', [$user->id]) ?>" method="POST" class="form row g-3" enctype="multipart/form-data">
                    @token
                    @method('PUT')
                    <div class="col-12 mt-2">
                        <label for="name" class="form-label mb-3">اسم:</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="اسم شما" value="<?= e(oldOr('name', e($user->name))) ?>">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="email" class="form-label mb-3">ایمیل:</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="اسم ایمیل" value="<?= e(oldOr('email', e($user->email))) ?>">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="profile" class="form-label mb-3">عکس پروفایل:</label>
                        <input class="form-control" name="profile" type="file" id="profile" placeholder="انتخاب عکس" accept="image/png, image/jpeg">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="text" class="form-label mb-3">بایوگرافی:</label>
                        <textarea name="bio" id="text" rows="7" placeholder="بایوگرافی"><?= e(oldOr('bio', e($user->bio))) ?></textarea>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="password" class="form-label mb-3">پسورد:</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="پسورد" value="<?= e(old('password')) ?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="confirm_password" class="form-label mb-3">تایید پسورد:</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="در تایید پسورد" value="<?= e(old('confirm_password')) ?>">
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
