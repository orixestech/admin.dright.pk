<br>

<div class="card">
    <div class="card-body">
        <h6 class="card-title"><?= ((isset($PAGE['UID'])) ? 'Update' : 'Add New') ?> Customer Detail</h6>
        <form method="post" action="" name="AddCustomerDetail" id="AddCustomerDetail" class="needs-validation"
              novalidate=""
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
                                    ><?= ucwords($record['Name']); ?></option>
                                <?php } ?>                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-4">Category<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select id="city" name="Customer[Category]" class="form-control"
                                    data-validation-engine="validate[required]">
                                <option value="">Please Select</option>
                                <?php foreach ($category as $record) { ?>
                                    <option value="<?= $record['UID'] ?>" <?= (isset($PAGE['Category']) && $PAGE['Category'] == $record['UID']) ? 'selected' : '' ?>
                                    ><?= ucwords($record['Name']); ?></option>
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
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Address</label>
                        <div class="col-sm-12">
                            <textarea type="text" id="Address" name="Customer[Address]" placeholder="Address"
                                      class="form-control"><?= ((isset($PAGE['Address'])) ? $PAGE['Address'] : '') ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"><h3>Clinic Details</h3></div>

                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Clinic Name:
                            (same as shown on prescription)</label>
                        <div class="col-sm-12">
                            <input type="text" id="qualification" name="Customer[ClinicName]"
                                   placeholder="Database Name"
                                   value="<?= ((isset($PAGE['ClinicName'])) ? $PAGE['ClinicName'] : '') ?>"
                                   class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Clinic Address <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" id="ClinicAddress" name="Customer[ClinicAddress]" placeholder="Clinic Address"
                                   value="<?= ((isset($PAGE['ClinicAddress'])) ? $PAGE['ClinicAddress'] : '') ?>"
                                   class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Clinic MobileNo</label>
                        <div class="col-sm-12">
                            <input type="text" id="ClinicMobileNo" name="Customer[ClinicMobileNo]" placeholder="Clinic MobileNo"
                                   value="<?= ((isset($PAGE['ClinicMobileNo'])) ? $PAGE['ClinicMobileNo'] : '') ?>"
                                   class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="date"
                                   value="<?= ((isset($PAGE['ClinicEmail'])) ? $PAGE['ClinicEmail'] : '') ?>"
                                   id="ClinicEmail" name="Customer[ClinicEmail]" placeholder="Email"
                                   data-validation-engine="validate[required]" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"><h3>Laboratory Details</h3></div>

                <div class="col-12">
                    <div class="form-group row">
                        <label class="col-md-12">Laboratory</label>
                        <div class="col-md-12">
                            <select data-control="select2" data-placeholder=""
                                    name="laboratory[]" class="form-select form-select-solid" multiple>
                                <option value="0">Please Select</option>
                                <?php
                                // Extract LabIDs into an array for easier comparison
                                $selectedUIDs = array_column($lab, 'LabID');

                                foreach ($Laboratory as $record) {
                                    $isSelected = in_array($record['UID'], $selectedUIDs) ? 'selected' : '';
                                    ?>
                                    <option value="<?= $record['UID'] ?>" <?= $isSelected ?>>
                                        <?= $record['FullName'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12"><h3>Pad Selection Details</h3></div>

                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Pad</label>
                        <div class="col-sm-12">
                            <select id="saleAgent" name="Customer[OwnPad]" onchange="ShowTypeDivs(this.value);" class="form-control"
                                    data-validation-engine="validate[required]">
                                <option value="">Please Select</option>
                                <option value="0">Clinta Pad</option>
                                <option value="1">Own Pad</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3" id="top-margin" style="display: none;">
                    <div class="form-group row ownPad" >
                        <label class="col-sm-12 form-control-label">Top Margin:</label>
                        <div class="col-sm-12">
                            <input type="text" name="Customer[padTopMargin]"  value="<?= ((isset($PAGE['padTopMargin'])) ? $PAGE['padTopMargin'] : '') ?>" placeholder="Enter The Margin" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="col-md-3" id="bottom-margin" style="display: none;">
                    <div class="form-group row ownPad" >
                        <label class="col-sm-12 form-control-label">Bottom Margin:</label>
                        <div class="col-sm-12">
                            <input type="text" name="Customer[padBottomMargin]"  value="<?= ((isset($PAGE['padBottomMargin'])) ? $PAGE['padBottomMargin'] : '') ?>" placeholder="Enter The Margin" class="form-control" />
                        </div>
                    </div>
                </div>


                <script type="application/javascript">
                    // Toggle the visibility of margin fields based on the dropdown value
                    function ShowTypeDivs(val) {
                        if (val == 1) {
                            $('#top-margin, #bottom-margin').show();
                        } else {
                            $('#top-margin, #bottom-margin').hide();
                        }
                    }

                    // Document ready logic
                    $(document).ready(function () {
                        $('#reset').click(function () {
                            $(".formError").hide();
                        });
                    });
                </script>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-4">Type<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select id="city" name="Customer[padRXLogo]" onchange="showRXLogowith(this.value);" class="form-control"
                                    data-validation-engine="validate[required]">
                                <option value="0">Yes</option>
                                <option value="1">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row ownPad" id="padLeftWidth" >
                        <label class="col-sm-12 form-control-label">Left Width:</label>
                        <div class="col-sm-12">
                            <input type="text" name="Customer[padLeftWidth]" value="<?= ((isset($PAGE['padLeftWidth'])) ? $PAGE['padLeftWidth'] : '') ?>" placeholder="Enter The Margin" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-md-12"><h3>Sponsor Detail</h3></div>
                <div class="col-md-3">
                    <div class="form-group row" >
                        <label class="col-sm-12 form-control-label">Title:</label>
                        <div class="col-sm-12">
                            <input type="text" name="Customer[Title]" placeholder="Enter "
                                   value="<?= ((isset($PAGE['Title'])) ? $PAGE['Title'] : '') ?>"
                                   class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group row" >
                        <label class="col-sm-12 form-control-label">Content:</label>
                        <div class="col-sm-12">
                            <input type="text" name="Customer[Content]"

                                   value="<?= ((isset($PAGE['Content'])) ? $PAGE['Content'] : '') ?>"
                                   placeholder="Enter Content" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="col-sm-12 form-control-label">LOGO:</label>

                    <div class="custom-file">

                        <input type="file" class="custom-file-input" id="Image"  name="Image">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>

                </div>
                <?php   if($page!='add-customer'){?>
                    <div class="col-md-6">
                        <img src="<?=$path?>upload/customer/<?=$UID?>" class="img-thumbnail" style="height:80px;">
                    </div>
                <?php }?>
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

        response = AjaxUploadResponse("customers/form_submit", formdata);
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
<script>
    function showRXLogowith(val) {
        console.log(val); // Debugging: log the value
        if (val === "0") {
            $('#padLeftWidth').show();
        } else {
            $('#padLeftWidth').hide();
        }
    }



</script>
<script src="<?= $template ?>assets/js/examples/form-validation.js"></script>
