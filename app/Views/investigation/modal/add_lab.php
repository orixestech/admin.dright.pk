

<div class="modal" id="AddInvestigationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" name="AddInvestigationForm" id="AddInvestigationForm" class="needs-validation" novalidate=""
                  enctype="multipart/form-data">
                <input type="hidden" name="UID" id="UID" value="0">
                <input type="hidden" name="Investigation[Parent]" id="Parent" value="0">
            <div class="modal-header">
                <h5 class="modal-title">Add Investigation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Name</label>
                        <input type="text" class="form-control" id="Name" name="Investigation[Name]"
                               placeholder="Enter name"
                              required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02">Category</label>
                        <select class="form-control" id="Category" name="Investigation[Category]">
                            <option value="">Please Select</option>

                            <?php  foreach ($category as $record) { ?>
                                <option value="<?= $record['UID'] ?>"
                                ><?= ucwords($record['Name']); ?></option>
                            <?php } ?>
                        </select>


                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02">Type</label>
                        <select class="form-control" id="Type" name="Investigation[Type]">
                            <option value="">Please Select</option>

                            <?php  foreach ($type as $record) { ?>
                                <option value="<?= $record['UID'] ?>"
                                ><?= ucwords($record['Name']); ?></option>
                            <?php } ?>
                        </select>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="AddInvestigationFormFunction()">Save changes</button>
            </div>
            </form>
            <div class="mt-4" id="ajaxResponse"></div>

        </div>
    </div>
</div>


<script>
    function AddInvestigationFormFunction() {
        var formdata = new window.FormData($("form#AddInvestigationForm")[0]);

        response = AjaxUploadResponse("investigation/investigation_submit", formdata);
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