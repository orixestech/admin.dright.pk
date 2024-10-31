<br>

<div class="card">
    <div class="card-body">
        <h6 class="card-title"><?= ((isset($PAGE['UID'])) ? 'Update' : 'Add New') ?> Doctor</h6>
        <form method="post" action="" name="AddDoctorForm" id="AddDoctorForm" class="needs-validation" novalidate=""
              enctype="multipart/form-data">
            <input type="hidden" name="UID" id="UID" value="<?= ((isset($PAGE['UID'])) ? $PAGE['UID'] : '0') ?>">
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">FullName</label>
                    <input type="text" class="form-control" name="name" id="validationCustom04"
                           placeholder="Full Name" value="<?= ((isset($PAGE['Name'])) ? $PAGE['Name'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Email</label>
                    <input type="text" class="form-control" name="email" id="validationCustom04"
                           placeholder="Email" value="<?= ((isset($PAGE['Email'])) ? $PAGE['Email'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Password</label>
                    <input type="text" class="form-control" name="password" id="validationCustom04"
                           placeholder="Password" value="<?= ((isset($PAGE['Password'])) ? $PAGE['Password'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">ContactNo</label>
                    <input type="text" class="form-control" name="ContactNo" id="validationCustom04"
                           placeholder="Contact No"
                           value="<?= ((isset($PAGE['ContactNo'])) ? $PAGE['ContactNo'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-4">City:</label>
                        <div class="col-sm-12">
                            <select id="city" name="city" class="form-control"
                                    data-validation-engine="validate[required]">
                                <option value="">Please Select</option>
                                <?php foreach ($Cities as $record) { ?>
                                    <option value="<?= $record['UID'] ?>" <?= (isset($PAGE['City']) && $PAGE['City'] == $record['UID']) ? 'selected' : '' ?>
                                    ><?= ucwords($record['FullName']); ?></option>
                                <?php } ?>                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom02">Specialities</label>
                    <div class="col-sm-12">
                        <select id="specialities" name="speciality" class="form-control"
                                data-validation-engine="validate[required]">
                            <option value="">Please Select</option>
                            <?php foreach ($specialities as $record) { ?>
                                <option value="<?= $record['UID'] ?>" <?= (isset($PAGE['City']) && $PAGE['City'] == $record['UID']) ? 'selected' : '' ?>
                                ><?= ucwords($record['Name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom02">Sponsors</label>
                    <div class="col-sm-12">
                        <select id="city" name="sponsor" class="form-control"
                                data-validation-engine="validate[required]">
                            <option value="">Please Select</option>
                            <?php foreach ($Sponsors as $record) { ?>
                                <option value="<?= $record['UID'] ?>" <?= (isset($PAGE['City']) && $PAGE['City'] == $record['UID']) ? 'selected' : '' ?>
                                ><?= ucwords($record['Name']); ?></option>
                            <?php } ?>                                </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Qualification</label>
                        <div class="col-sm-12">
                            <input type="text" id="qualification" name="qualification" placeholder="Qualification"
                                   class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">PMDC No</label>
                        <div class="col-sm-12">
                            <input type="text" id="pmdcno" name="pmdcno" placeholder="PMDCNo" class="form-control"/>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Department</label>
                        <div class="col-sm-12">
                            <input type="text" id="department" name="department" placeholder="Department"
                                   class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Sub Domain</label>
                        <div class="col-sm-12">
                            <input type="text" id="sub_domain" name="sub_domain" placeholder="Sub Domain"
                                   class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Admin Domain</label>
                        <div class="col-sm-12">
                            <input type="text" id="AdminDomain" name="AdminDomain" placeholder="Admin Domain"
                                   class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">e-Health Key</label>
                        <div class="col-sm-12">
                            <input type="text" id="telemedicine_id" name="telemedicine_id" placeholder="e-Health Key"
                                   class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">

                    <label for="validationCustom05">Profile</label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="Profile" name="Profile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>


                <div class="col-md-5 mb-3">

                    <label for="validationCustom05">Initatived LOGO</label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="initatived_logo" name="initatived_logo">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Short Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="short_description" id="short_description"
                                      rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Initatived Text</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="initatived_text" id="initatived_text"
                                      rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Theme Setting</label>
                        <div class="col-sm-12">
                            <select name="theme" id="theme" class="form-control">
                                <option value="0">Please Select</option>
                                <?php
//                                $Theme = config_item('web_builder_themes');
//                                foreach ($Theme as $key => $value) {
//                                    echo '<option value="' . $key . '">' . $value . '</option>';
//                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Patient Portal</label>
                        <div class="col-sm-12">
                            <select name="patient_portal" id="patient_portal" class="form-control">
                                <option value="">Please Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>

                            </select>
                        </div>
                    </div>
                </div>


            </div>
            <div class="mt-4" id="ajaxResponse"></div>


        </form>

    </div>
    <div class="mb-2">
    <span style="float: right">
                <button class="btn btn-primary" type="button" onclick="AddDoctorFormFunction()">Submit form</button>

</span>
    </div>

</div>

<script>

    function AddDoctorFormFunction() {
        var formdata = new window.FormData($("form#AddDoctorForm")[0]);

        response = AjaxUploadResponse("builder/submit-doctor", formdata);
        if (response.status === 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                //location.href = "<?php //=$path?>//builder/";
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
