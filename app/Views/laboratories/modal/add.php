<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">


<div class="modal" id="AddlaboratoriesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="" name="AddlaboratoriesForm" id="AddlaboratoriesForm" class="needs-validation" novalidate=""
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
                        <label for="validationCustom01">Full Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="FullName" name="laboratory[FullName]"
                               placeholder="Enter laboratory name"
                              required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Email</label>
                        <input type="email" class="form-control" id="Email" name="laboratory[Email]"
                               placeholder="Enter Email"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Password</label>
                        <input type="text" class="form-control" id="Password" name="laboratory[Password]"
                               placeholder="Enter Password"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02">City</label>
                        <select class="form-control" id="BodySystem" name="laboratory[City]">
                            <option value="">Please Select</option>

                            <?php  foreach ($city as $record) { ?>
                            <option value="<?= $record['UID'] ?>"
                               ><?= ucwords($record['Name']); ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Contact No</label>
                        <input type="number" class="form-control" id="ContactNo" name="laboratory[ContactNo]"
                               placeholder="Enter Mobile Number"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Address</label>
                        <input type="text" class="form-control" id="Address" name="laboratory[Address]"
                               placeholder="Enter Address"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Logo</label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="Image"  name="Image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="AddlaboratoriesFormFunction()">Save changes</button>
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


    function AddlaboratoriesFormFunction() {
        var formdata = new window.FormData($("form#AddlaboratoriesForm")[0]);

        response = AjaxUploadResponse("laboratories/submit", formdata);
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