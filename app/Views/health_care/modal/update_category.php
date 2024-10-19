<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<div class="modal" id="UpdateDietCategoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="" name="UpdateDietCategoryForm" id="UpdateDietCategoryForm" class="needs-validation" novalidate=""
                  enctype="multipart/form-data">
                <input type="hidden" name="UID" id="UID" value="0">
                <div class="modal-header">
                    <h5 class="modal-title">Update </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label for="Category">Category</label>
                            <input type="text" class="form-control" id="Category" name="DietCategory[Category]"
                                   placeholder="Enter Category" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <!-- Sub Category -->
                        <div class="col-md-6 mb-3">
                            <label for="SubCategory">Sub Category</label>
                            <input type="text" class="form-control" id="SubCategory" name="DietCategory[SubCategory]"
                                   placeholder="Enter Sub Category" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <!-- Units -->
                        <div class="col-md-6 mb-3">
                            <label for="Units">Units</label>
                            <input type="text" class="form-control" id="Unit" name="DietCategory[Unit]"
                                   placeholder="Enter Units" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <!-- Estimated Average Requirements (EAR) -->
                        <div class="col-md-6 mb-3">
                            <label for="EAR">Estimated Average Requirements (EAR)</label>
                            <input type="text" class="form-control" id="EAR" name="DietCategory[EAR]"
                                   placeholder="Enter EAR" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <!-- Recommended Dietary Allowances (RDA) -->
                        <div class="col-md-6 mb-3">
                            <label for="RDA">Recommended Dietary Allowances (RDA)</label>
                            <input type="text" class="form-control" id="RDA" name="DietCategory[RDA]"
                                   placeholder="Enter RDA" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <!-- Tolerable upper intake levels (UL) -->
                        <div class="col-md-6 mb-3">
                            <label for="UL">Tolerable Upper Intake Levels (UL)</label>
                            <input type="text" class="form-control" id="UL" name="DietCategory[UL]"
                                   placeholder="Enter UL" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="UL">Order ID</label>
                            <input type="text" class="form-control" id="OrderID" name="DietCategory[OrderID]"
                                   placeholder="Enter Order ID" required="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="UL">Description</label>
                            <textarea id="Description" name="Description" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="UpdateDietCategoryFormFunction()">Save changes</button>
                </div>
            </form>
            <div class="mt-4" id="ajaxResponse"></div>

        </div>
    </div>
</div>

<script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>

<script>

    $(document).ready(function() {
        $('#Description').summernote();
    });

    // $('.select2-example').select2({
    //     placeholder: 'Select'
    // });


    function UpdateDietCategoryFormFunction() {
        var formdata = new window.FormData($("form#UpdateDietCategoryForm")[0]);

        response = AjaxUploadResponse("diet/submit-category", formdata);
        if (response.status === 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.reload();
            }, 500);
        } else {
            $("#ajaxResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error!</strong> ' + response.message + ' </div>');
        }
    }
</script>
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<script src="<?=$template?>assets/js/examples/form-validation.js"></script>