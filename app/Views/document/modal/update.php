<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">


<div class="modal" id="UpdateUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" name="UpdateUserForm" id="UpdateUserForm" class="needs-validation" novalidate=""
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
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Name</label>
                            <input type="text" class="form-control" id="FullName" name="User[FullName]"
                                   placeholder="Enter name"
                                   required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Email</label>
                            <input type="text" class="form-control" id="Email"  name="User[Email]"
                                   placeholder="Email"
                                   required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Password</label>
                            <input type="text" class="form-control" id="Password"  name="User[Password]"
                                   placeholder="Enter Password"
                                   required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">User Type</label>
                            <select class="form-control" id="AccessLevel" name="User[AccessLevel]">
                                <option value="editor">Editor</option>
                                <option value="admin">Admin</option>
                            </select>
                            <!--                        <select class="select2-example">-->
                            <!--                        <option>Select</option>-->
                            <!--                        <option value="France">France</option>-->
                            <!--                        <option value="Brazil">Brazil</option>-->
                            <!--                        <option value="Yemen">Yemen</option>-->
                            <!--                        <option value="United States">United States</option>-->
                            <!--                        <option value="China">China</option>-->
                            <!--                        <option value="Argentina">Argentina</option>-->
                            <!--                        <option value="Bulgaria">Bulgaria</option>-->
                            <!--                    </select>-->

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="UpdateUserFormFunction()">Save changes</button>
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


    function UpdateUserFormFunction() {
        var formdata = new window.FormData($("form#UpdateUserForm")[0]);

        response = AjaxUploadResponse("users/submit", formdata);
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