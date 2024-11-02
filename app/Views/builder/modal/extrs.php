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
                        <div class="col-md-6">
                            <label class="col-sm-12">Alignment</label>
                            <div class="col-sm-12">
                                <select name="alignment" id="alignment" class="form-control validate[required]">
                                    <option value="">Select Alignment</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                    <option value="center">Center</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-sm-12">Color</label>
                            <div class="col-sm-12">
                                <select name="color" id="color" class="form-control validate[required]">
                                    <option value="">Select Color</option>
                                    <option value="light">Light</option>
                                    <option value="dark">Dark</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-sm-12">speciality</label>
                            <div class="col-sm-12">
                                <select id="specialities" name="speciality" class="form-control"
                                        data-validation-engine="validate[required]">
                                    <option value="">Please Select</option>
                                    <?php foreach ($specialities as $record) { ?>
                                        <option value="<?= $record['UID'] ?>"
                                        ><?= ucwords($record['Name']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="AddBannerFormFunction()">Save changes</button>
</div>
<div class="mt-4" id="ajaxResponse"></div>

</div>
</div>
</div>

<script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>

<script>

    function AddBannerFormFunction() {
        var formdata = new window.FormData($("form#AddBannerForm")[0]);

        response = AjaxUploadResponse("builder/submit", formdata);
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
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
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
<script src="<?= $template ?>assets/js/examples/form-validation.js"></script>