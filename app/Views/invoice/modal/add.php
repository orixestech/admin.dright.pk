<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">


<div class="modal" id="AddInvoiceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" name="AddInvoiceDetail" id="AddInvoiceDetail" class="needs-validation" novalidate=""
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
                        <label for="validationCustom01">Name</label>
                        <input type="text" class="form-control" id="Name" name="Invoice[Name]"
                               placeholder="Enter name"
                               required="">

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Phone Number</label>
                        <input type="text" class="form-control" id="PhoneNumber" name="Invoice[PhoneNumber]"
                               placeholder="Enter phone number"
                               required="">

                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Email</label>
                        <input type="text" class="form-control" id="Email" name="Invoice[Email]"
                               placeholder="Enter Email"
                               required="">

                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Address</label>
                        <textarea type="text" class="form-control" id="Address" name="Invoice[Address]"
                                  placeholder="Enter Address"
                                  required=""></textarea>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="AddInvoiceDetailFunction()">Save changes</button>
            </div>
            </form>
            <div class="mt-4" id="addajaxResponse"></div>

        </div>
    </div>
</div>

<script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>

<script>




    function AddInvoiceDetailFunction() {
        var formdata = new window.FormData($("form#AddInvoiceDetail")[0]);

        response = AjaxUploadResponse("invoice/invoice_detail_form_submit", formdata);
        if (response.status === 'success') {
            $("#addajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.reload();
            }, 500);
        } else {
            $("#addajaxResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error!</strong> ' + response.message + ' </div>');
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