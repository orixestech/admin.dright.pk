<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">


<div class="modal" id="AddBannerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" name="AddBannerForm" id="AddBannerForm" class="needs-validation" novalidate=""
                  enctype="multipart/form-data">
                <input type="hidden" name="UID" id="UID" value="0">
                <div class="modal-header">
                    <h5 class="modal-title">Add </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Alignment</label>
                            <select class="form-control" id="alignment" name="alignment">
                                <option value="">Select Alignment</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                                <option value="center">Center</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Color</label>
                            <select class="form-control" id="color" name="color">
                                <option value="">Select Color</option>
                                <option value="light">Light</option>
                                <option value="dark">Dark</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Specialities</label>
                            <select class="form-control" id="speciality" name="speciality">
                                <?php foreach ($specialities as $record) { ?>
                                    <option value="<?= $record['UID'] ?>"
                                    ><?= ucwords($record['Name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">

                            <label for="validationCustom05">Profile</label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="profile" name="profile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="AddBannerFormFunction()">Save changes</button>
                </div>
            </form>
            <div class="mt-4" id="ajaxResponse"></div>

        </div>
    </div>
</div>

<script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>

<script>


    // $('.select2-example').select2({
    //     placeholder: 'Select'
    // });


    function AddBannerFormFunction() {
        var formdata = new window.FormData($("form#AddBannerForm")[0]);

        response = AjaxUploadResponse("builder/submit_general_image", formdata);
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