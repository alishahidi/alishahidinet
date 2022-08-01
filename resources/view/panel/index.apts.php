@extends('panel.layouts.app')

@section('head-tag')
<title>پنل کاربری alishahidinet</title>
@endsection

@section('content')

<div class="overview">
    <div class="title d-flex align-items-center">
        <ion-icon name="glasses-outline"></ion-icon>
        <span class="text">خلاصه فعالیت ها</span>
    </div>
</div>
<div class="boxes row">
    <div class="col-12 mt-3">
        <div class="box">
            <ion-icon name="thumbs-up-outline"></ion-icon>
            <div class="text">کامنت ها</div>
            <div class="number"><?= e($commentCount) ?></div>
        </div>
    </div>
</div>

@endsection
