
<div class="modal" id="AddSupportVideoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="" name="AddSupportVideoForm" id="AddSupportVideoForm" class="needs-validation" novalidate=""
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
                    <!-- Category -->
                    <div class="col-md-6 mb-3">
                        <label for="Category">Category</label>
                        <input type="text" class="form-control" id="Category" name="SupportVideo[Category]"
                               placeholder="Enter Category" required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <!-- Sub Category -->
                    <div class="col-md-6 mb-3">
                        <label for="SubCategory">Title</label>
                        <input type="text" class="form-control" id="Title" name="SupportVideo[Title]"
                               placeholder="Enter Sub Category" required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <!-- Units -->
                    <div class="col-md-6 mb-3">
                        <label for="Units">Code</label>
                        <input type="text" class="form-control" id="EmbedCode" name="SupportVideo[EmbedCode]"
                               placeholder="Enter Embed Code" required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="UL">Order ID</label>
                        <input type="text" class="form-control" id="OrderID" name="SupportVideo[OrderID]"
                               placeholder="Enter Order ID" required="">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="AddSupportVideoFormFunction()">Save changes</button>
            </div>
            </form>
            <div class="mt-4" id="ajaxResponse"></div>

        </div>
    </div>
</div>


<script>

    function AddSupportVideoFormFunction() {
        var formdata = new window.FormData($("form#AddSupportVideoForm")[0]);
        response = AjaxUploadResponse("diet/submit-support-video", formdata);
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