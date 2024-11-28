

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Add Event Gallery</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Add New Event Gallery</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container">
                <form method="post" action="" name="eventgalleryaddform" id="eventgalleryaddform" enctype="multipart/form-data">
                    <input type="hidden" id="UID" name="UID" value="0">
                    <input type="hidden" id="eventid" name="eventid" value="<?= ((isset($PAGE['UID'])) ? $PAGE['UID'] : '0') ?>">

                    <div class="col-lg-12">
                        <div class="card card_height_100 mb_30">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title mt-3" style="margin-left: 30px;">
                                        <h3 class="m-0">Add Event Gallery Details</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="card-body">
                                    <div class="row mb-3" id="image-fields">
                                        <div class="col-md-6 mt-2">
                                            <label class="form-label">Image</label>
                                            <input type="file" class="form-control" id="Image" name="Image[]" placeholder="Enter Cover Image">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4" id="ajaxResponse"></div>
                                    <div>
                                        <button type="button" id="add-more" class="btn btn-secondary">Add More</button>
                                        <span style="float: right">
                                            <button type="button" onclick="addeventgalleryform();" class="btn btn-primary">Submit Record</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Description').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: true
        });

        $('#add-more').click(function () {
            $('#image-fields').append('<div class="col-md-6 mt-2"><label class="form-label">Image</label><input type="file" class="form-control" name="Image[]"><button type="button" class="btn btn-danger btn-sm remove-btn mt-2">Remove</button></div>');
        });

        $(document).on('click', '.remove-btn', function () {
            $(this).parent().remove();
        });
    });

    function addeventgalleryform() {
        var formdata = new window.FormData($("form#eventgalleryaddform")[0]);
        response = AjaxUploadResponse("events-gallery/submit", formdata);
        if (response.status == 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.href = "<?=$path?>events/";
            }, 500);
        } else {
            $("#ajaxResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Field not Filled Properly ! </strong> ' + response.message + ' </div>');
        }
    }
</script>

