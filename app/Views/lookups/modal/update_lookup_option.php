

<div class="modal" id="UpdateLookupOptionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" name="UpdateLookupOptionForm" id="UpdateLookupOptionForm" class="needs-validation" novalidate=""
                  enctype="multipart/form-data">
                <input type="hidden" name="UID" id="UID" value="">
                <input type="hidden" name="LookupOption[LookupUID]" id="LookupUID" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Update Lookup Option</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Name</label>
                            <input type="text" class="form-control" id="Name" name="LookupOption[Name]"
                                   placeholder="Enter name"
                                   required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="UpdateLookupOptionFormFunction()">Save changes</button>
                </div>
            </form>
            <div class="mt-4" id="LookupoptionResponse"></div>

        </div>
    </div>
</div>


<script>
    function UpdateLookupOptionFormFunction() {
        var formdata = new window.FormData($("form#UpdateLookupOptionForm")[0]);

        response = AjaxUploadResponse("lookups/submit-lookup-option", formdata);
        if (response.status === 'success') {
            $("#LookupoptionResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.reload();
            }, 500);
        } else {
            $("#LookupoptionResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error!</strong> ' + response.message + ' </div>');
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