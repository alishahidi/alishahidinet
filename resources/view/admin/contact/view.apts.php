@extends('admin.layouts.app')

@section('head-tag')
<title>پنل ادمین پاسخ به تماس</title>
@endsection

@section('content')

<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="create-outline"></ion-icon>
            <span class="text">مشاهده تماس</span>
        </div>
    </div>
    <div class="card-body">
        <p><b>اسم: </b><?= e($contact->name) ?></p>
        <p><b>ایمیل: </b><?= e($contact->email) ?></p>
        <p><b>موضوع: </b><?= e($contact->subject) ?></p>
        <p><?= e($contact->text) ?></p>
    </div>
</div>
<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="create-outline"></ion-icon>
            <span class="text">مشاهده پاسخ ها</span>
        </div>
    </div>
    <?php foreach ($contact->answers() as $answer) { ?>
    <div class="card-body">
        <form class="mb-3" action="<?= route('admin.contact.answer.destroy', [$answer->id]) ?>" method="POST" onclick="return confirm('آیا مایلید حذف شود؟')">
            @token
            @method('DELETE')
            <button class="custom-btn custom-btn-danger w-100 text-center rounded-0">
                حذف
            </button>
        </form>
        <p><b>پاسخ دهنده: </b><?= e($answer->user()->name) ?></p>
        <p><b>موضوع: </b><?= e($answer->subject) ?></p>
        <p><?= e($answer->text) ?></p>
    </div>
    <?php } ?>
</div>
<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="create-outline"></ion-icon>
            <span class="text">پاسخ به تماس</span>
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
                <form action="<?= route('admin.contact.answer', [$contact->id]) ?>" method="POST" class="form row g-3">
                    @token
                    <div class="col-12 mt-2">
                        <label for="subject" class="form-label mb-3">موضوع:</label>
                        <input type="text" name="subject" class="form-control" id="subject" placeholder="موضوع جواب" value="<?= e(old('subject')) ?>">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="text" class="form-label mb-3">متن:</label>
                        <textarea name="text" id="text" rows="3" placeholder="متن"><?= e(old('text')) ?></textarea>
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
