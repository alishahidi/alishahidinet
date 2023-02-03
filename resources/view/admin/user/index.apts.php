@extends('admin.layouts.app')

@section('head-tag')
<!--  DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
<title>پنل ادمین کاربران</title>
@endsection

@section('content')

<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="book-outline"></ion-icon>
            <span class="text">کاربران</span>
        </div>
    </div>
    <div class="card-body">
        <div class="card-table">
            <table id="table" class="display nowrap">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>اکشن ها</th>
                        <th>اسم</th>
                        <th>ایمیل</th>
                        <th>پروفایل</th>
                        <th>وضعیت پسورد</th>
                        <th>وضعیت کاربر</th>
                        <th>وضعیت دسترسی</th>
                        <th>بایوگرافی</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ آپدیت</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <a href="<?= route('admin.user.edit', [$user->id]) ?>" class="ms-3">
                                    <ion-icon class="text-success" name="pencil-outline"></ion-icon>
                                </a>
                                <form class="d-inline" action="<?= route('admin.user.delete', [$user->id]) ?>" method="post" onclick="return confirm('آیا مایلید حذف شود؟')">
                                    @token
                                    @method('DELETE')
                                    <button>
                                        <ion-icon class="text-danger" name="trash-outline"></ion-icon>
                                    </button>
                                </form>
                            </td>
                            <td><?= e($user->name) ?></td>
                            <td><?= e($user->email) ?></td>
                            <td><img src="<?= asset($user->profile['thumbnail']) ?>" style="width: 54px;" alt="image" /></td>
                            <td>
                                <?= verify_password($user->password) ? "<ion-icon class='text-success' name='shield-checkmark-outline'></ion-icon>" : "<ion-icon class='text-danger' name='shield-outline'></ion-icon>" ?>
                            </td>
                            <td><?= e($user->status) ?></td>
                            <td><?= e($user->permission) ?></td>
                            <td><?= e(limitDotPrint($user->bio, 30)) ?></td>
                            <td><?= jdate($project->created_at)->format('%A, %d %B %y') ?></td>
                            <td><?= $project->updated_at ? jdate($project->updated_at)->format('%A, %d %B %y') : '--' ?></td>
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
        scrollX: true,
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
