<br>
<?php

use App\Models\BuilderModel;

$BuilderModel = new BuilderModel();
$short_desc =$BuilderModel->get_website_profile_meta_data_by_id_option( $PAGE['UID'], 'short_description' );
$clinta_extended_profiles = $BuilderModel->get_website_profile_meta_data_by_id_option( $PAGE['UID'], 'clinta_extended_profiles' );
$healthcarestatus = $BuilderModel->get_website_profile_meta_data_by_id_option( $PAGE[ 'UID' ], 'healthcare_status' );
$theme = $BuilderModel->get_profile_options_data_by_id_option( $PAGE[ 'UID' ], 'theme' );
$patient_portal = $BuilderModel->get_website_profile_meta_data_by_id_option( $PAGE[ 'UID' ], 'patient_portal' );
//print_r($patient_portal);exit();
?>
<div class="card">
    <div class="card-body">
        <h6 class="card-title"><?= ((isset($PAGE['UID'])) ? 'Update' : 'Add New') ?> Hospital</h6>
        <form method="post" action="" name="AddHospitalForm" id="AddHospitalForm" class="needs-validation" novalidate=""
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

                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="col-sm-12">Sub Domain</label>
                        <div class="col-sm-12">
                            <input type="text" id="sub_domain" name="sub_domain" placeholder="Sub Domain"
                                   value="<?= ((isset($PAGE['SubDomain'])) ? $PAGE['SubDomain'] : '') ?>"
                                   class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">

                    <label for="validationCustom05">Profile</label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="profile" name="profile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="<?=$path?>module/load_image/<?=str_replace("=", "", base64_encode('profile_'.$PAGE['UID']))?>" height="70">
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Short Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="short_description" id="short_description"
                                      rows="6"><?=( ( isset($short_desc) && !empty($short_desc))? $short_desc['Value'] : '' )?></textarea>
                        </div>
                    </div>
                </div>
            </div>    <br>
            <div class="form-row">
                <div class="col-md-12">
                    <h3>Clinta Extended</h3>
                </div>

                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-4">Profiles:</label>
                        <div class="col-sm-12">
                            <select id="clinta_extended_profiles" name="clinta_extended_profiles" class="form-control"
                                    data-validation-engine="validate[required]">
                                <option value="">Please Select</option>
                                <?php
                                foreach( $extended_profiles as $PF ){
                                    echo'<option value="'.$PF['UID'].'" '.( ( isset( $clinta_extended_profiles ) && $clinta_extended_profiles[0]['Value'] == $PF['UID'] )? 'selected' : ''  ).' >'.$PF['FullName'].'</option>';
                                }?>

                                                      </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-12">Add-ons</label>
                        <div class="col-sm-12">
                            <select name="healthcare_status" id="healthcare_status" class="form-control">
                                <option value="" <?=( ( isset( $healthcarestatus ) && $healthcarestatus[0]['Value'] == '' )? 'selected' : '' )?>>Please Select</option>
                                <option value="1" <?=( ( isset( $healthcarestatus ) && $healthcarestatus[0]['Value'] == '1' )? 'selected' : '' )?>>Show</option>
                                <option value="0" <?=( ( isset( $healthcarestatus ) && $healthcarestatus[0]['Value'] == '0' )? 'selected' : '' )?>>Hide</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-12">Theme Setting</label>
                        <div class="col-sm-12">
                            <select name="theme" id="theme" class="form-control">
                                <option value="0"<?=( ( isset( $theme ) && $theme[0]['Description'] == '0' )? 'selected' : '' )?>>Please Select</option>
                                <option value="basic"<?=( ( isset( $theme ) && $theme[0]['Description'] == 'basic' )? 'selected' : '' )?>>Basic (Free)</option>
                                <option value="deep-mind"<?=( ( isset( $theme ) && $theme[0]['Description'] == 'deep-mind' )? 'selected' : '' )?>>Premium (Paid)</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-12">Patient Portal</label>
                        <div class="col-sm-12">
                            <select name="patient_portal" id="patient_portal" class="form-control">
                                <option value="" <?=( ( isset( $patient_portal ) && $patient_portal[0]['Value'] == '' )? 'selected' : '' )?>>Please Select</option>
                                <option value="1" <?=( ( isset( $healthcarestatus ) && $patient_portal[0]['Value'] == '1' )? 'selected' : '' )?>>Yes</option>
                                <option value="0" <?=( ( isset( $patient_portal ) && $patient_portal[0]['Value'] == '0' )? 'selected' : '' )?>>No</option>

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
                <button class="btn btn-primary" type="button" onclick="AddHospitalFormFunction()">Submit form</button>

</span>
    </div>

</div>

<script>

    function AddHospitalFormFunction() {
        var formdata = new window.FormData($("form#AddHospitalForm")[0]);

        response = AjaxUploadResponse("builder/submit-hospital", formdata);
        if (response.status === 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.href = "<?=$path?>builder/";
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
