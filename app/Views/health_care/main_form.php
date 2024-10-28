<br>

<div class="card">
    <div class="card-body">
        <h6 class="card-title"><?= ((isset($PAGE['UID'])) ? 'Update' : 'Add New') ?> RCC</h6>
        <form method="post" action="" name="AddRCCForm" id="AddRCCForm" class="needs-validation" novalidate=""
              enctype="multipart/form-data">
            <input type="hidden" name="UID" id="UID" value="<?= ((isset($PAGE['UID'])) ? $PAGE['UID'] : '0') ?>">
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">FullName</label>
                    <input type="text" class="form-control" name="RCC[FullName]" id="validationCustom04"
                           placeholder="Full Name" value="<?= ((isset($PAGE['FullName'])) ? $PAGE['FullName'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-4">Branches:</label>
                        <div class="col-sm-12">
                            <select id="city" name="RCC[Branch]" class="form-control"
                                    data-validation-engine="validate[required]">
                                <option value="">Please Select</option>
                                <?php foreach ($branches as $record) { ?>
                                    <option value="<?= $record['UID'] ?>" <?= (isset($PAGE['Branch']) && $PAGE['Branch'] == $record['UID']) ? 'selected' : '' ?>
                                    ><?= ucwords($record['FullName']); ?></option>
                                <?php } ?>                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom02">Category</label>
                    <select id="city" name="RCC[Category]" class="form-control"
                            data-validation-engine="validate[required]">
                        <option value=""<?= (isset($PAGE['Category']) && $PAGE['Category'] == '') ? 'selected' : '' ?>>
                            Please Select
                        </option>
                        <option value="Individual"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'Individual') ? 'selected' : '' ?>>
                            Individual
                        </option>
                        <option value="School"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'School') ? 'selected' : '' ?>>
                            School
                        </option>
                        <option value="Pharmacy"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'Pharmacy') ? 'selected' : '' ?>>
                            Pharmacy
                        </option>
                        <option value="Doctor"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'Doctor') ? 'selected' : '' ?>>
                            Doctor
                        </option>
                        <option value="Beauty Parlor"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'Beauty Parlor') ? 'selected' : '' ?>>
                            Beauty Parlor
                        </option>
                    </select>
                </div>


                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Email</label>
                    <input type="text" class="form-control" name="RCC[Email]" id="validationCustom04"
                           placeholder="Email" value="<?= ((isset($PAGE['Email'])) ? $PAGE['Email'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Password</label>
                    <input type="text" class="form-control" name="RCC[Password]" id="validationCustom04"
                           placeholder="Password" value="<?= ((isset($PAGE['Password'])) ? $PAGE['Password'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">ContactNo</label>
                    <input type="text" class="form-control" name="RCC[ContactNo]" id="validationCustom04"
                           placeholder="Contact No"
                           value="<?= ((isset($PAGE['ContactNo'])) ? $PAGE['ContactNo'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom02">City</label>
                    <div class="col-sm-12">
                        <select id="city" name="RCC[City]" class="form-control"
                                data-validation-engine="validate[required]">
                            <option value="">Please Select</option>
                            <?php foreach ($cities as $record) { ?>
                                <option value="<?= $record['UID'] ?>" <?= (isset($PAGE['City']) && $PAGE['City'] == $record['UID']) ? 'selected' : '' ?>
                                ><?= ucwords($record['FullName']); ?></option>
                            <?php } ?>                                </select>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Area</label>
                    <input type="text" class="form-control" name="RCC[Area]" id="validationCustom04"
                           placeholder="Area" value="<?= ((isset($PAGE['Area'])) ? $PAGE['Area'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom05">Address</label>
                    <input type="text" class="form-control" name="RCC[Address]" id="validationCustom05"
                           placeholder="Address" value="<?= ((isset($PAGE['Address'])) ? $PAGE['Address'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom02">Status</label>
                    <select id="city" name="RCC[Status]" class="form-control"
                            data-validation-engine="validate[required]">
                        <option value=""<?= (isset($PAGE['Status']) && $PAGE['Status'] == '') ? 'selected' : '' ?>>
                            Please Select
                        </option>
                        <option value="active"<?= (isset($PAGE['Status']) && $PAGE['Status'] == '') ? 'selected' : 'active' ?>>
                            Active
                        </option>
                        <option value="block"<?= (isset($PAGE['Status']) && $PAGE['Status'] == '') ? 'selected' : 'block' ?>>
                            Block
                        </option>

                    </select>
                </div>
                <?php
                if (isset($PAGE['UID']) && !empty($PAGE['UID'])) {
                    echo '<div class="col-md-4 mb-3">';
                } else {
                    echo '<div class="col-md-6 mb-3">';
                }
                ?>
                <label for="validationCustom05">Profile</label>

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="Profile" name="Profile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <?php
            if (isset($PAGE['UID']) && !empty($PAGE['UID'])) {
                echo '<div class="col-md-2 mb-3">';

                if (!empty($PAGE['Profile'])) {
                    echo '<img src="' . $path . 'upload/representative/' . $PAGE['Profile'] . '" width="160px" height="140px">';
                } else {
                    echo '<img src="' . $path . 'upload/representative/images.png" width="160px" height="140px">';
                }

                echo '</div>';
            }
            ?>

            <div class="col-md-3 mb-3">
                <label for="validationCustom04">Contact Person:</label>
                <input type="text" class="form-control" name="RCC[ContactPerson]" id="validationCustom04"
                       placeholder="Contact Person"
                       value="<?= ((isset($PAGE['ContactPerson'])) ? $PAGE['ContactPerson'] : '') ?>"
                       required="">
                <div class="invalid-feedback">
                    Please provide a valid .
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom05">Contact Person Mobile No</label>
                <input type="number" class="form-control" name="RCC[ContactPersonPhone]" id="validationCustom05"
                       placeholder="Contact Person Phone"
                       value="<?= ((isset($PAGE['ContactPersonPhone'])) ? $PAGE['ContactPersonPhone'] : '') ?>"
                       required="">
                <div class="invalid-feedback">
                    Please provide a valid .
                </div>
            </div>
            <?php
            if (isset($PAGE['UID']) && !empty($PAGE['UID'])) {
                echo '<div class="col-md-4 mb-3">';
            } else {
                echo '<div class="col-md-6 mb-3">';
            }
            ?>

            <label for="validationCustom05">Contact Profile</label>

            <div class="custom-file">

                <input type="file" class="custom-file-input" id="Image" name="Image">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
    </div>
    <?php
    if (isset($PAGE['UID']) && !empty($PAGE['UID'])) {
        echo '<div class="col-md-2 mb-3">';

        if (!empty($PAGE['ConactPersonImage'])) {
            echo '<img src="' . $path . 'upload/representative/' . $PAGE['ConactPersonImage'] . '" width="160px" height="140px">';
        } else {
            echo '<img src="' . $path . 'upload/representative/images.png" width="160px" height="140px">';
        }

        echo '</div>';
    }
    ?>

</div>
<div class="mt-4" id="ajaxResponse"></div>


</form>

</div>
<div class="mb-2">
    <span style="float: right">
                <button class="btn btn-primary" type="button" onclick="AddRCCFormFunction()">Submit form</button>

</span>
</div>

</div>

<script>

    function AddRCCFormFunction() {
        var formdata = new window.FormData($("form#AddRCCForm")[0]);

        response = AjaxUploadResponse("representative/submit", formdata);
        if (response.status === 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.href = "<?=$path?>representative/";
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
