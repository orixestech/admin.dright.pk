<br>
<br>
<?php

use App\Models\Crud;

$Crud = new Crud();

$specialities = $Crud->SingleRecord('specialities', array("UID" => $UID));


?>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">
        <form method="post" action="" name="eventgalleryaddform" id="eventgalleryaddform" enctype="multipart/form-data">
            <input type="hidden" id="UID" name="UID" value="0">
            <input type="hidden" id="SpecialityID" name="SpecialityID" value="<?= $UID; ?>">

            <div class="col-lg-12">
                <div class="card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title mt-3" style="margin-left: 30px;">
                                <h3 class="m-0">Add Gallery</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <div class="row mb-3" id="image-fields">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Size</label>
                                    <select class="form-control" id="size" name="size[]">
                                        <option value="">Please Select</option>
                                        <option value="small">Small</option>
                                        <option value="medium">Medium</option>
                                        <option value="large">Large</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" id="Image" name="Image[]"
                                           placeholder="Enter Cover Image">
                                </div>
                            </div>
                            <div class="col-12 mb-4" id="ajaxResponse"></div>
                            <div>
                                <button type="button" id="add-more" class="btn btn-secondary">Add More</button>
                                <span style="float: right">
                                            <button type="button" onclick="addgalleryform();"
                                                    class="btn btn-primary">Submit Record</button>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4><?= $specialities['Name']; ?> Gallery</h4>

        <div class="row">

            <?php foreach ($Images as $IM) {

                echo '<div class="col-md-2" style="margin-top:20px;"><a href="javascript:void(0);" onclick="DeleteSpecialityImage(' . $IM['UID'] . ');"><i style="color:#FF0000; position: absolute;left: 170px;font-size: 20px;" class="fa fa-remove"></i></a>
										<img src="' . $path . 'upload/specialities/' . $IM['Value'] . '" class="img-thumbnail">
									</div>';

            } ?>

        </div>
    </div>
</div>
<script>

    function DeleteSpecialityImage(id) {
        if (confirm("Are you Sure You want to Delete this Permanently ?")) {
            response = AjaxResponse("builder/delete_specialities_image", "id=" + id);
            if (response.status == 'success') {
                $("#Response").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Deleted Successfully!</strong>  </div>')
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else {
                $("#Response").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error! Not Deleted</strong>  </div>')
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }

        }
    }
</script>
<script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>
<script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
<script src="<?= $template ?>assets/js/examples/datatable.js"></script>
<script src="<?= $template ?>vendors/prism/prism.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize Summernote
        $('#Description').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: true
        });

        // Add more fields (alignment + image)
        $('#add-more').click(function () {
            const newFields = `

                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02">Size</label>
                        <select class="form-control" name="size[]">
                     		<option value="">Please Select</option>
										<option value="small">Small</option>
										<option value="medium">Medium</option>
										<option value="large">Large</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="Image[]" placeholder="Enter Cover Image">
                        <button type="button" class="btn btn-danger btn-sm remove-btn mt-2">Remove</button>
                    </div>

            `;
            $('#image-fields').append(newFields);
        });

        // Remove dynamic fields
        $(document).on('click', '.remove-btn', function () {
            $(this).closest('.dynamic-fields').remove();
        });
    });

    function addgalleryform() {
        var formdata = new window.FormData($("form#eventgalleryaddform")[0]);
        response = AjaxUploadResponse("builder/gallery_form_submit", formdata);
        if (response.status == 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.reload();
            }, 500);
        } else {
            $("#ajaxResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Field not Filled Properly!</strong> ' + response.message + ' </div>');
        }
    }
</script>


