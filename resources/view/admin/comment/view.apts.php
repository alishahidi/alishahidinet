@extends('admin.layouts.app')

@section('head-tag')
<title>پنل ادمین مشاهده کامنت</title>
@endsection

@section('content')

<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="create-outline"></ion-icon>
            <span class="text">مشاهده کامنت</span>
        </div>
    </div>
    <div class="card-body">
        <div class="border-bottom mb-4 pb-3">
            <a href="<?= backUrl() ?>" class="custom-btn custom-btn-secondary text-center rounded-0 w-100">بازگشت</a>
        </div>
        <img class="mb-3 rounded" src="<?= asset_ftp($comment->user()->profile) ?>" alt="<?= e($comment->user()->name) ?>" width="60" />
        <p><b>اسم: </b><?= e($comment->user()->name) ?></p>
        <p><?= e($comment->comment) ?></p>
    </div>
</div>

@endsection
