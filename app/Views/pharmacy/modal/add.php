

<div class="modal" id="AddPharmacyModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="" name="AddPharmacyForm" id="AddPharmacyForm" class="needs-validation" novalidate=""
                  enctype="multipart/form-data">
                <input type="hidden" name="UID" id="UID" value="0">
            <div class="modal-header">
                <h5 class="modal-title">Add Pharamcy Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12">Full Name *</label>
                            <div class="col-sm-12">
                                <input type="text" id="name" name="Pharmacy[FullName]" placeholder="Profile Name" class="form-control" data-validation-engine="validate[required]"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12">Email</label>
                            <div class="col-sm-12">
                                <input type="email" id="email" name="Pharmacy[Email]" placeholder="Email" class="form-control" data-validation-engine="validate[custom[email]]"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12">Contact No * </label>
                            <div class="col-sm-12">
                                <input type="text" id="contact_no" name="Pharmacy[ContactNo]" placeholder="Contact No" class="form-control" data-validation-engine="validate[minSize[11]]" maxlength="11"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12">City:</label>
                            <div class="col-sm-12">
                                <select id="city" name="Pharmacy[City]" class="form-control" data-validation-engine="validate[required]">
                                    <option value="">Please Select</option>
                                    <?php  foreach ($cities as $record) { ?>
                                        <option value="<?= $record['UID'] ?>"
                                        ><?= ucwords($record['FullName']); ?></option>
                                    <?php } ?>                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-12">Address *</label>
                            <div class="col-sm-12">
                                <input type="text" id="address" name="Pharmacy[Address]" placeholder="Address" class="form-control" data-validation-engine="validate[required]" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12"> Sale Agent * </label>
                            <div class="col-sm-12">
                                <input type="text" id="sale_agent" name="Pharmacy[SaleAgent]" placeholder="Sale Agent" class="form-control" data-validation-engine="validate[required]"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12">Deployment Date *</label>
                            <div class="col-sm-12">
                                <input type="date"  id="deployment_date" name="Pharmacy[DeploymentDate]" placeholder="Deployment Date" data-validation-engine="validate[required]" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12"> Mac Address *</label>
                            <div class="col-sm-12">
                                <input type="text" id="mac_address" name="Pharmacy[MAC]" placeholder="Mac Address" data-validation-engine="validate[required]" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12"> Expire Date *</label>
                            <div class="col-sm-12">
                                <input type="date"  id="expire_date" name="Pharmacy[ExpireDate]" placeholder="Expire Date" data-validation-engine="validate[required]" class="form-control"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="AddPharmacyFormFunction()">Save changes</button>
            </div>
            </form>
            <div class="mt-4" id="ajaxResponse"></div>

        </div>
    </div>
</div>


<script>
    function AddPharmacyFormFunction() {
        var formdata = new window.FormData($("form#AddPharmacyForm")[0]);

        response = AjaxUploadResponse("pharmacy/submit", formdata);
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