@extends('admin.layouts.app')

@section('head-tag')
<title>پنل ادمین ساخت تجربه</title>
@endsection

@section('content')

<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="create-outline"></ion-icon>
            <span class="text">ساخت تجربه جدید</span>
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
                <form action="<?= route('admin.experience.store') ?>" method="POST" class="form row g-3">
                    @token
                    <div class="col-12 mt-2">
                        <label for="name" class="form-label mb-3">اسم:</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="اسم" value="<?= e(old('name')) ?>">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="location" class="form-label mb-3">موقعیت:</label>
                        <input type="text" name="location" class="form-control" id="location" placeholder="موقعیت" value="<?= e(old('location')) ?>">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="position" class="form-label mb-3">عنوان:</label>
                        <input type="text" name="position" class="form-control" id="position" placeholder="عنوان" value="<?= e(old('position')) ?>">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="start" class="form-label mb-3">شروع:</label>
                        <input type="text" name="start" class="form-control" id="start" placeholder="شروع" value="<?= e(old('start')) ?>">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="end" class="form-label mb-3">پایان:</label>
                        <input type="text" name="end" class="form-control" id="end" placeholder="پایان" value="<?= e(old('end')) ?>">
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