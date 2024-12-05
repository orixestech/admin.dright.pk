<br>

<div class="card">
    <div class="card-body">
        <h6 class="card-title"><?= ((isset($PAGE['UID'])) ? 'Update' : 'Add New') ?> Customer Detail</h6>
        <form method="post" action="" name="AddCustomerDetail" id="AddCustomerDetail" class="needs-validation" novalidate=""
              enctype="multipart/form-data">
            <input type="hidden" name="UID" id="UID" value="<?= ((isset($PAGE['UID'])) ? $PAGE['UID'] : '0') ?>">
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">FullName <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Customer[Name]" id="validationCustom04"
                           placeholder="Full Name" value="<?= ((isset($PAGE['Name'])) ? $PAGE['Name'] : '') ?>"
                           required="">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Customer[Email]" id="validationCustom04"
                           placeholder="Email" value="<?= ((isset($PAGE['Email'])) ? $PAGE['Email'] : '') ?>"
                           required="">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Contact No <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Customer[ContactNo]" id="validationCustom04"
                           placeholder="Contact No"
                           value="<?= ((isset($PAGE['ContactNo'])) ? $PAGE['ContactNo'] : '') ?>"
                           required="">
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-4">City<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select id="city" name="Customer[City]" class="form-control"
                                    data-validation-engine="validate[required]">
                                <option value="">Please Select</option>
                                <?php foreach ($Cities as $record) { ?>
                                    <option value="<?= $record['UID'] ?>" <?= (isset($PAGE['City']) && $PAGE['City'] == $record['UID']) ? 'selected' : '' ?>
                                    ><?= ucwords($record['FullName']); ?></option>
                                <?php } ?>                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-4">City<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select id="city" name="Customer[Category]" class="form-control"
                                    data-validation-engine="validate[required]">
                                <option value="">Please Select</option>
                                <?php foreach ($category as $record) { ?>
                                    <option value="<?= $record['UID'] ?>" <?= (isset($PAGE['Category']) && $PAGE['Category'] == $record['UID']) ? 'selected' : '' ?>
                                    ><?= ucwords($record['FullName']); ?></option>
                                <?php } ?></select>
                        </div>
                    </div>
                </div>
 <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-4">Type<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select id="city" name="Customer[Type]" class="form-control"
                                    data-validation-engine="validate[required]">
                                <option value="">Please Select</option>
                                <option value="SN">BMS (Single doctor/no supporting Staff)</option>
                                <option value="MS">BMM (Multiple doctor/single supporting Staff)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">DataBase Name</label>
                        <div class="col-sm-12">
                            <input type="text" id="qualification" name="Customer[DatabaseName]" placeholder="Database Name"
                                   value="<?= ((isset($PAGE['DatabaseName'])) ? $PAGE['DatabaseName'] : '') ?>" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Sub Domain <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" id="SubDomainUrl" name="Customer[SubDomainUrl]" placeholder="Sub Domain"
                                   value="<?= ((isset($PAGE['SubDomainUrl'])) ? $PAGE['SubDomainUrl'] : '') ?>" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Facebook Link</label>
                        <div class="col-sm-12">
                            <input type="text" id="FacebookUrl" name="Customer[FacebookUrl]" placeholder="Facebook Url"
                                   value="<?= ((isset($PAGE['FacebookUrl'])) ? $PAGE['FacebookUrl'] : '') ?>" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Deployment Date <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="date"
                                   value="<?= ((isset($PAGE['DeploymentDate'])) ? $PAGE['DeploymentDate'] : '') ?>" id="deployment_date" name="Customer[DeploymentDate]" placeholder="Deployment Date" data-validation-engine="validate[required]" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">SMS Credits </label>
                        <div class="col-sm-12">
                            <input type="text" id="SMSCredits" name="Customer[SMSCredits]" placeholder="SMS Credits"
                                   value="<?= ((isset($PAGE['SMSCredits'])) ? $PAGE['SMSCredits'] : '') ?>" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Sale Agent</label>
                        <div class="col-sm-12">
                            <input type="text" id="SaleAgent" name="Customer[SaleAgent]" placeholder="Sale Agent"
                                   value="<?= ((isset($PAGE['SaleAgent'])) ? $PAGE['SaleAgent'] : '') ?>" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12"> Expire Date </label>
                        <div class="col-sm-12">
                            <input type="date"     value="<?= ((isset($PAGE['ExpireDate'])) ? $PAGE['ExpireDate'] : '') ?>" id="expire_date" name="Customer[ExpireDate]" placeholder="Expire Date" data-validation-engine="validate[required]" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Address</label>
                        <div class="col-sm-12">
                            <textarea type="text" id="Address" name="Customer[Address]" placeholder="Address"
                                      class="form-control"><?= ((isset($PAGE['Address'])) ? $PAGE['Address'] : '') ?></textarea>
                        </div>
                    </div>
                </div>



            </div>
            <div class="mt-4" id="ajaxResponse"></div>


        </form>

    </div>
    <div class="mb-2">
    <span style="float: right">
                <button class="btn btn-primary" type="button" onclick="AddCustomerDetailFunction()">Submit form</button>

</span>
    </div>

</div>

<script>

    function AddCustomerDetailFunction() {
        var formdata = new window.FormData($("form#AddCustomerDetail")[0]);

        response = AjaxUploadResponse("customers/submit", formdata);
        if (response.status === 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.href = "<?=$path?>customers/";
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
