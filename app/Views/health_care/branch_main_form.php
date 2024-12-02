<br>

<div class="card">
    <div class="card-body">
        <h6 class="card-title"><?= ((isset($PAGE['UID'])) ? 'Update' : 'Add New') ?> Branch</h6>
        <form method="post" action="" name="AddBranchForm" id="AddBranchForm" class="needs-validation" novalidate=""
              enctype="multipart/form-data">
            <input type="hidden" name="UID" id="UID" value="<?= ((isset($PAGE['UID'])) ? $PAGE['UID'] : '0') ?>">
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">FullName<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Branch[FullName]" id="validationCustom04"
                           placeholder="Full Name" value="<?= ((isset($PAGE['FullName'])) ? $PAGE['FullName'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="validationCustom02">Category<span class="text-danger">*</span></label>
                    <select id="city" name="Branch[Category]" class="form-control"
                            data-validation-engine="validate[required]">
                        <option value=""<?= (isset($PAGE['Category']) && $PAGE['Category'] == '') ? 'selected' : '' ?>>
                            Please Select
                        </option>
                        <option value="A1"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'A1') ? 'selected' : '' ?>>
                            A1
                        </option>
                        <option value="A2"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'A2') ? 'selected' : '' ?>>
                            A2
                        </option>
                        <option value="B1"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'B1') ? 'selected' : '' ?>>
                            B1
                        </option>
                        <option value="B2"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'B2') ? 'selected' : '' ?>>
                            B2
                        </option>
                        <option value="C1"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'C1') ? 'selected' : '' ?>>
                            C1
                        </option> <option value="C2"<?= (isset($PAGE['Category']) && $PAGE['Category'] == 'C2') ? 'selected' : '' ?>>
                            C2
                        </option>
                    </select>
                </div>


                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Email<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Branch[Email]" id="validationCustom04"
                           placeholder="Email" value="<?= ((isset($PAGE['Email'])) ? $PAGE['Email'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">Password<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Branch[Password]" id="validationCustom04"
                           placeholder="Password" value="<?= ((isset($PAGE['Password'])) ? $PAGE['Password'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">ContactNo<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Branch[ContactNo]" id="validationCustom04"
                           placeholder="Contact No"
                           value="<?= ((isset($PAGE['ContactNo'])) ? $PAGE['ContactNo'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom02">City<span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <select id="city" name="Branch[City]" class="form-control"
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
                    <input type="text" class="form-control" name="Branch[Area]" id="validationCustom04"
                           placeholder="Area" value="<?= ((isset($PAGE['Area'])) ? $PAGE['Area'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom05">Address<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Branch[Address]" id="validationCustom05"
                           placeholder="Address" value="<?= ((isset($PAGE['Address'])) ? $PAGE['Address'] : '') ?>"
                           required="">
                    <div class="invalid-feedback">
                        Please provide a valid .
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom05">ShortProfile<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Branch[ShortProfile]" id="validationCustom05"
                           placeholder="Short Profile" value="<?= ((isset($PAGE['ShortProfile'])) ? $PAGE['ShortProfile'] : '') ?>"
                           required="">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom05">ShortBusiness Desc<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Branch[ShortBusinessDesc]" id="validationCustom05"
                           placeholder="Desc" value="<?= ((isset($PAGE['ShortBusinessDesc'])) ? $PAGE['ShortBusinessDesc'] : '') ?>"
                           required="">

                </div>    <div class="col-md-3 mb-3">
                    <label for="validationCustom05">MapEmbed Code<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Branch[MapEmbedCode]" id="validationCustom05"
                           placeholder="MapEmbedCode" value="<?= ((isset($PAGE['MapEmbedCode'])) ? $PAGE['MapEmbedCode'] : '') ?>"
                           required="">

                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom02">Status<span class="text-danger">*</span></label>
                    <select id="city" name="Branch[Status]" class="form-control"
                            data-validation-engine="validate[required]">
                        <option value=""<?= (isset($PAGE['Status']) && $PAGE['Status'] == '') ? 'selected' : '' ?>>
                            Please Select
                        </option>
                        <option value="2"<?= (isset($PAGE['Status']) && $PAGE['Status'] == '2') ? 'selected' : 'requested' ?>>
                            requested
                        </option>
                        <option value="0"<?= (isset($PAGE['Status']) && $PAGE['Status'] == '0') ? 'selected' : '0' ?>>
                            Block
                        </option> <option value="1"<?= (isset($PAGE['Status']) && $PAGE['Status'] == '1') ? 'selected' : '0' ?>>
                            Active
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

                if (!empty($PAGE['ProfileImage'])) {
                    echo '<img src="' . $path . 'upload/franchise/' . $PAGE['ProfileImage'] . '" width="160px" height="140px">';
                } else {
                    echo '<img src="' . $path . 'upload/franchise/images.png" width="160px" height="140px">';
                }

                echo '</div>';
            }
            ?>

            <div class="col-md-3 mb-3">
                <label for="validationCustom04">Contact Person<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="Branch[ContactPerson]" id="validationCustom04"
                       placeholder="Contact Person"
                       value="<?= ((isset($PAGE['ContactPerson'])) ? $PAGE['ContactPerson'] : '') ?>"
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

        if (!empty($PAGE['ContactPersonImage'])) {
            echo '<img src="' . $path . 'upload/franchise/' . $PAGE['ContactPersonImage'] . '" width="160px" height="140px">';
        } else {
            echo '<img src="' . $path . 'upload/franchise/images.png" width="160px" height="140px">';
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
                <button class="btn btn-primary" type="button" onclick="AddBranchFormFunction()">Submit form</button>

</span>
</div>

</div>

<script>

    function AddBranchFormFunction() {
        var formdata = new window.FormData($("form#AddBranchForm")[0]);

        response = AjaxUploadResponse("frenchises/submit", formdata);
        if (response.status === 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.href = "<?=$path?>frenchises/";
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
