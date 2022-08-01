@extends('admin.layouts.app')

@section('head-tag')
<title>پنل ادمین ساخت پروژه</title>
@endsection

@section('content')

<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="create-outline"></ion-icon>
            <span class="text">ساخت پروژه جدید</span>
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
                <form action="<?= route('admin.project.store') ?>" method="POST" class="form row g-3" enctype="multipart/form-data" id="form">
                    @token
                    <div class="col-12 mt-2">
                        <label for="title" class="form-label mb-3">عنوان:</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="عنوان مقاله" value="<?= e(old('title')) ?>">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="text" class="form-label mb-3">توضیحات:</label>
                        <textarea name="description" id="text" rows="3" placeholder="توضیحات"><?= e(old('description')) ?></textarea>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="link" class="form-label mb-3">لینک:</label>
                        <input type="text" name="link" class="form-control" id="link" placeholder="لینک" value="<?= e(old('link')) ?>">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="image" class="form-label mb-3">عکس:</label>
                        <input class="form-control" name="image" type="file" id="image" accept="image/png, image/jpeg">
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
