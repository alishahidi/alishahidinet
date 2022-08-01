@extends('admin.layouts.app')

@section('head-tag')
<!--  DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
<title>پنل ادمین کامنت ها</title>
@endsection

@section('content')

<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="book-outline"></ion-icon>
            <span class="text">کامنت های تایید نشده</span>
        </div>
    </div>
    <div class="card-body">
        <div class="card-table">
            <table id="table1" class="display nowrap">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>اکشن ها</th>
                        <th>ارسال کننده</th>
                        <th>در مقاله</th>
                        <th>کامنت</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ آپدیت</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($notApprovedComments as $comment) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <a href="<?= route('admin.comment.view', [$comment->id]) ?>" class="ms-3">
                                    <ion-icon class="text-primary" name="eye-outline"></ion-icon>
                                </a>
                                <form class="d-inline" action="<?= route('admin.comment.approved', [$comment->id]) ?>" method="post">
                                    @token
                                    @method('PUT')
                                    <button>
                                        <ion-icon class="text-success" name="checkmark-outline"></ion-icon>
                                    </button>
                                </form>
                            </td>
                            <td><?= e($comment->user()->name) ?></td>
                            <td><a href="<?= route('home.article.show', [$comment->article()->id, $comment->article()->title]) ?>"><?= e($comment->article()->title) ?></a></td>
                            <td><?= e(limitDotPrint($comment->comment, 30)) ?></td>
                            <td><?= jdate($comment->created_at)->format('%A, %d %B %y') ?></td>
                            <td><?= $comment->updated_at ? jdate($comment->updated_at)->format('%A, %d %B %y') : '--' ?></td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="book-outline"></ion-icon>
            <span class="text">کامنت های تایید شده</span>
        </div>
    </div>
    <div class="card-body">
        <div class="card-table">
            <table id="table2" class="display nowrap">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>اکشن ها</th>
                        <th>ارسال کننده</th>
                        <th>در مقاله</th>
                        <th>کامنت</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ آپدیت</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($approvedComments as $comment) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <a href="<?= route('admin.comment.view', [$comment->id]) ?>" class="ms-3">
                                    <ion-icon class="text-primary" name="eye-outline"></ion-icon>
                                </a>
                                <form class="d-inline" action="<?= route('admin.comment.approved', [$comment->id]) ?>" method="post">
                                    @token
                                    @method('PUT')
                                    <button>
                                        <ion-icon class="text-danger" name="close-outline"></ion-icon>
                                    </button>
                                </form>
                            </td>
                            <td><?= e($comment->user()->name) ?></td>
                            <td><a href="<?= route('home.article.show', [$comment->article()->id, $comment->article()->title]) ?>"><?= e($comment->article()->title) ?></a></td>
                            <td><?= e(limitDotPrint($comment->comment, 30)) ?></td>
                            <td><?= jdate($comment->created_at)->format('%A, %d %B %y') ?></td>
                            <td><?= $comment->updated_at ? jdate($comment->updated_at)->format('%A, %d %B %y') : '--' ?></td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<script type="text/javascript">
    let table1 = new DataTable('#table1', {
        responsive: true,
        "scrollY": "400px",
        "fixedColumns": true,
        "language": {
            "decimal": "",
            "emptyTable": "داده ای وجود ندارد.",
            "info": "مشاهده _START_ تا _END_ از _TOTAL_ داده",
            "infoEmpty": "مشاهده 0 تا 0 از 0 داده",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "نمایش _MENU_ داده",
            "loadingRecords": "در حال بارگزاری...",
            "processing": "در حال انجام عملیات...",
            "search": "جستجو: ",
            "zeroRecords": "داده ای پیدا نشد.",
            "paginate": {
                "first": "اول",
                "last": "آخر",
                "next": "بعدی",
                "previous": "قبلی"
            },
            "aria": {
                "sortAscending": ": مرتب از کم به زیاد",
                "sortDescending": ": مرتب از زیاد به کم"
            }
        },
    });

    let table2 = new DataTable('#table2', {
        responsive: true,
        "scrollY": "400px",
        "fixedColumns": true,
        "language": {
            "decimal": "",
            "emptyTable": "داده ای وجود ندارد.",
            "info": "مشاهده _START_ تا _END_ از _TOTAL_ داده",
            "infoEmpty": "مشاهده 0 تا 0 از 0 داده",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "نمایش _MENU_ داده",
            "loadingRecords": "در حال بارگزاری...",
            "processing": "در حال انجام عملیات...",
            "search": "جستجو: ",
            "zeroRecords": "داده ای پیدا نشد.",
            "paginate": {
                "first": "اول",
                "last": "آخر",
                "next": "بعدی",
                "previous": "قبلی"
            },
            "aria": {
                "sortAscending": ": مرتب از کم به زیاد",
                "sortDescending": ": مرتب از زیاد به کم"
            }
        },
    });
</script>

@endsection
