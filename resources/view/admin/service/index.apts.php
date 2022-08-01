@extends('admin.layouts.app')

@section('head-tag')
<!--  DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
<title>پنل ادمین سرویس ها</title>
@endsection

@section('content')

<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="book-outline"></ion-icon>
            <span class="text">سرویس ها</span>
        </div>
    </div>
    <div class="card-body">
        <div class="card-table">
            <div class="border-bottom mb-4 pb-3">
                <a href="<?= route('admin.service.create') ?>" class="custom-btn custom-btn-primary text-center rounded-0 w-100">ساخت سرویس جدید</a>
            </div>
            <table id="table" class="display nowrap">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>اکشن ها</th>
                        <th>اسم</th>
                        <th>آیکون</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ آپدیت</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                foreach ($services as $service) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <a href="<?= route('admin.service.edit', [$service->id]) ?>" class="ms-3">
                                    <ion-icon class="text-success" name="pencil-outline"></ion-icon>
                                </a>
                                <form class="d-inline" action="<?= route('admin.service.delete', [$service->id]) ?>" method="post" onclick="return confirm('آیا مایلید حذف شود؟')">
                                    @token
                                    @method('DELETE')
                                    <button>
                                        <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                                    </button>
                                </form>
                            </td>
                            <td><?= e($service->name) ?></td>
                            <td><ion-icon name="<?= e($service->icon) ?>"></ion-icon></td>
                            <td><?= jdate($service->created_at)->format('%A, %d %B %y') ?></td>
                            <td><?= $service->updated_at ? jdate($service->updated_at)->format('%A, %d %B %y') : '--' ?></td>
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
    let table = new DataTable('#table', {
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
