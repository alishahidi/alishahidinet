@extends('admin.layouts.app')

@section('head-tag')
<!-- tagify -->
<link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

<title>پنل ادمین ویرایش مقاله</title>
@endsection

@section('content')

<div class="card-content">
    <div class="card-title">
        <div class="title d-flex align-items-center">
            <ion-icon name="create-outline"></ion-icon>
            <span class="text">ویرایش مقاله</span>
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
                <form action="<?= route('admin.article.update', [$article->id]) ?>" method="POST" class="form row g-3" enctype="multipart/form-data" id="form">
                    @token
                    @method('PUT')
                    <div class="col-12 mt-2">
                        <label for="title" class="form-label mb-3">عنوان:</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="عنوان مقاله" value="<?= e(oldOr('title', e($article->title))) ?>">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="text" class="form-label mb-3">توضیحات:</label>
                        <textarea name="description" id="text" rows="3" placeholder="توضیحات"><?= e(oldOr('description', e($article->description))) ?></textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="image" class="form-label mb-3">عکس:</label>
                        <input class="form-control" name="image" type="file" id="image" accept="image/png, image/jpeg">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="tags" class="form-label mb-3">برچسب ها:</label>
                        <input name="tags" class="form-control custom-tagify" id="tags" placeholder="برچسب ها" value="<?= e(old('tags')) ?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="topic" class="form-label mb-3">تاپیک:</label>
                        <select name="topic_id" class="form-select form-control">
                            <?php foreach ($topics as $topic) {  ?>
                                <option value="<?= $topic->id ?>" <?= oldOrEqualValue('topic_id', $topic->id, $article->topic()->id) ? 'selected' : '' ?>> <?= e($topic->name) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12 mt-2 image-upload">
                        <label for="image" class="form-label mb-3">آپلود عکس: (max:1200)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="image-upload" accept="image/png, image/jpeg, image/gif">
                            <button class="custom-btn custom-btn-primary p-0 text-center" type="button" id="image-upload-button">آپلود</button>
                        </div>
                        <div class="image-upload-progress progress d-none">
                            <div class="progress-bar" id="image-upload-progress" role="progressbar"></div>
                        </div>
                        <div class="image-upload-url d-none"></div>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="text" class="form-label mb-3">متن:</label>
                        <textarea id="editor" name="content"><?= hpd(oldOr('contnet', $article->content)) ?></textarea>
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

@section('scripts')
<!-- tagify -->
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

<script type="text/javascript">
    tagify = new Tagify(document.querySelector("input[name=\"tags\"]"), {
        whitelist: ["linux", "emacs", "web mode", "php mode", "php", "javascript", "nodejs", "lpic", "youtube"],
        maxTags: 10,
        delimiters: null,
        dropdown: {
            maxItems: 5, // <- mixumum allowed rendered suggestions
            classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
            enabled: 0, // <- show suggestions on focus
            closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
        }
    })
    <?php if (! old('tags')) { ?>
        tagify.addTags(<?= json_encode(objectToArray($article->tags(), 'name')) ?>);
    <?php } ?>
</script>

<script src="https://cdn.tiny.cloud/1/0axogb6y0hnw46j04axy5kx7rjfdklzh4g9yzaybb2xd87vo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript">
    tinymce.init({
        selector: 'textarea#editor',
        plugins: 'fullscreen directionality quickbars table image link lists media autoresize codesample help',
        toolbar: 'fullscreen | undo redo | blocks | bold italic | alignleft aligncentre alignright alignjustify | indent outdent | bullist numlist | codesample | ltr rtl',
        skin: window.localStorage.getItem("data-theme") === "dark" ? "oxide-dark" : "oxide",
        content_css: window.localStorage.getItem("data-theme") === "dark" ? "dark" : "light",
        min_height: 400
    });
    tinymce.activeEditor.execCommand('mceDirectionRTL');
</script>

<!-- Axios -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script type="text/javascript">
    document.getElementById("image-upload-button").addEventListener("click", () => {
        const imageUploadUrl = document.querySelector(".image-upload-url");
        const imageUploadProgress = document.getElementById("image-upload-progress");
        const imageUploadProgressElement = document.querySelector(".image-upload-progress");
        const imageUploadInput = document.getElementById("image-upload");
        if (imageUploadInput.files.length <= 0) {
            imageUploadUrl.classList.remove("d-none");
            imageUploadUrl.innerHTML = "ابتدا عکسی را انتخاب کنید.";
            return false;
        }
        let data = new FormData();
        data.append('file', imageUploadInput.files[0]);
        axios.post("<?= route('file.image.upload').'?_token='.get_csrf() ?>", data, {
                onUploadProgress: (event) => {
                    let percent = Math.floor((event.loaded * 100) / event.total);
                    if (parent !== 100) {
                        imageUploadProgressElement.classList.remove("d-none");
                        imageUploadProgress.style = "width:" + percent + "%";
                    } else
                        imageUploadProgressElement.classList.add("d-none");
                }
            })
            .then(res => {
                imageUploadUrl.classList.remove("d-none");
                imageUploadUrl.innerHTML = res.data;
            })
            .catch(err => {
                imageUploadProgressElement.classList.add("d-none");
                imageUploadUrl.classList.remove("d-none");
                imageUploadUrl.innerHTML = err.response.data;
            });
    });
</script>
@endsection
