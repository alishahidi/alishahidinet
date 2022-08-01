@extends('admin.layouts.app')

@section('head-tag')
<title>پنل ادمین alishahidinet</title>
@endsection

@section('content')

<div class="overview">
    <div class="title d-flex align-items-center">
        <ion-icon name="glasses-outline"></ion-icon>
        <span class="text">خلاصه فعالیت ها</span>
    </div>
</div>
<div class="boxes row">
    <div class="col-12 col-md-3 mt-3">
        <div class="box">
            <ion-icon name="thumbs-up-outline"></ion-icon>
            <div class="text">لایک ها</div>
            <div class="number">۵۰,۱۲۰</div>
        </div>
    </div>
    <div class="col-12 col-md-3 mt-3">
        <div class="box">
            <ion-icon name="chatbubbles-outline"></ion-icon>
            <div class="text">کامنت ها</div>
            <div class="number">۲۰,۱۱۲</div>
        </div>
    </div>
    <div class="col-12 col-md-3 mt-3">
        <div class="box">
            <ion-icon name="people-outline"></ion-icon>
            <div class="text">کاربران</div>
            <div class="number">۱۰,۸۱۲</div>
        </div>
    </div>
    <div class="col-12 col-md-3 mt-3">
        <div class="box">
            <ion-icon name="book-outline"></ion-icon>
            <div class="text">پست ها</div>
            <div class="number">۲۲,۸۱۲</div>
        </div>
    </div>
</div>
<div class="table-content">
    <div class="table-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="hourglass-outline"></ion-icon>
            <span class="text">فعالیت های اخیر</span>
        </div>
    </div>

    <div class="table-body">
        <div class="table-grid d-flex justify-content-between align-items-start">
            <div class="table-data">
                <span class="table-data-title">اسم</span>
                <span class="table-data-list">علی شهیدی</span>
                <span class="table-data-list">علی شهیدی</span>
                <span class="table-data-list">علی شهیدی</span>
                <span class="table-data-list">علی شهیدی</span>
                <span class="table-data-list">علی شهیدی</span>
                <span class="table-data-list">علی شهیدی</span>
            </div>
            <div class="table-data">
                <span class="table-data-title">ایمیل</span>
                <span class="table-data-list">alishahidi1376@gmail.com</span>
                <span class="table-data-list">alishahidi1376@gmail.com</span>
                <span class="table-data-list">alishahidi1376@gmail.com</span>
                <span class="table-data-list">alishahidi1376@gmail.com</span>
                <span class="table-data-list">alishahidi1376@gmail.com</span>
                <span class="table-data-list">alishahidi1376@gmail.com</span>
            </div>
            <div class="table-data">
                <span class="table-data-title">تاریخ عضویت</span>
                <span class="table-data-list">۱۳۹۹/۱۲/۲</span>
                <span class="table-data-list">۱۳۹۹/۱۲/۲</span>
                <span class="table-data-list">۱۳۹۹/۱۲/۲</span>
                <span class="table-data-list">۱۳۹۹/۱۲/۲</span>
                <span class="table-data-list">۱۳۹۹/۱۲/۲</span>
                <span class="table-data-list">۱۳۹۹/۱۲/۲</span>
            </div>
            <div class="table-data">
                <span class="table-data-title">دسترسی</span>
                <span class="table-data-list">ادمین</span>
                <span class="table-data-list">ادمین</span>
                <span class="table-data-list">ادمین</span>
                <span class="table-data-list">ادمین</span>
                <span class="table-data-list">ادمین</span>
                <span class="table-data-list">ادمین</span>
            </div>
            <div class="table-data">
                <span class="table-data-title">وضعیت</span>
                <span class="table-data-list">آنلاین</span>
                <span class="table-data-list">آنلاین</span>
                <span class="table-data-list">آنلاین</span>
                <span class="table-data-list">آنلاین</span>
                <span class="table-data-list">آنلاین</span>
                <span class="table-data-list">آنلاین</span>
            </div>
        </div>
    </div>
</div>

@endsection
