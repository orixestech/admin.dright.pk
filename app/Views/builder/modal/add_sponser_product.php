<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">


<div class="modal" id="AddSponserProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" name="AddSponserProductForm" id="AddSponserProductForm" class="needs-validation" novalidate=""
                  enctype="multipart/form-data">
                <input type="hidden" name="UID" id="UID" value="0">
                <input type="hidden" name="SponsorProduct[SponsorID]" id="SponsorID" value="">
            <div class="modal-header">
                <h5 class="modal-title">Add Sponsor Prodcut</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Name</label>
                        <input type="text" class="form-control" id="Name" name="SponsorProduct[Name]"
                               placeholder="Enter Type"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Generic Name</label>
                        <input type="text" class="form-control" id="GenericName" name="SponsorProduct[GenericName]"
                               placeholder="Enter Generic Name"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>  <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Therapeutic Segments</label>
                        <input type="text" class="form-control" id="TherapeuticSegments" name="SponsorProduct[TherapeuticSegments]"
                               placeholder="Enter Therapeutic Segments"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>  <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Pack Size</label>
                        <input type="text" class="form-control" id="PackSize" name="SponsorProduct[PackSize]"
                               placeholder="Enter Type"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">MRP</label>
                        <input type="text" class="form-control" id="MRP" name="SponsorProduct[MRP]"
                               placeholder="Enter Type"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">EFP</label>
                        <input type="text" class="form-control" id="EFP" name="SponsorProduct[EFP]"
                               placeholder="Enter EFP"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">TP</label>
                        <input type="text" class="form-control" id="TP" name="SponsorProduct[TP]"
                               placeholder="Enter TP"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Order ID</label>
                        <input type="number" class="form-control" id="Orderid" name="Sponsor[Orderid]"
                               placeholder="Enter OrderID"
                               required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom02">Image</label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="Image"  name="Image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="AddSponserProductFormFunction()">Save changes</button>
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


    function AddSponserProductFormFunction() {
        var formdata = new window.FormData($("form#AddSponserProductForm")[0]);

        response = AjaxUploadResponse("builder/submit_sponser_product", formdata);
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