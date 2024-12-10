<?php

use App\Models\CustomerModel;

?>
<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">

<?php
$CustomerModel = new CustomerModel();

$User=$CustomerModel->GetUsersByCustID($UID);



?>
<div class="modal" id="UpdateUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="" name="UpdateUserForm" id="UpdateUserForm" class="needs-validation" novalidate=""
                  enctype="multipart/form-data">
                <input type="hidden" name="UID" id="UID" value="0">
                <input type="hidden" name="CustomerID" id="CustomerID" value="<?=$UID?>">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div>
                            <div class="form-group row">
                                <label class="col-sm-4 form-control-label no-padding-right">Name:*</label>
                                <div class="col-sm-8">
                                    <input type="text" id="FullName" name="FullName" placeholder="Full Name" class="form-control" data-validation-engine="validate[required,custom[onlyLetterSp]]" data-errormessage="Name is required" data-errormessage-custom-error="Invalid Name" value="<?=$User[0]['FullName']?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 form-control-label no-padding-right">Contact:*</label>
                                <div class="col-sm-8">
                                    <input type="text" id="Contact" name="Contact" placeholder="Contact" class="form-control" data-validation-engine="validate[required,custom[onlyNumberSp]]" value="<?=$User[0]['Contact']?>" data-errormessage-custom-error="Invalid Number"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 form-control-label no-padding-right">User type:*</label>
                                <div class="col-sm-8">
                                    <select id="UserType" name="UserType" class="form-control" data-validation-engine="validate[required]" data-errormessage="User Type is required" onChange="LoadDoctOption(this.value)">
                                        <option value="">Please Select</option>
                                        <option value="Doctor" <?=($User[0][ 'UserType']=='Doctor' ) ? 'selected': '' ?>>Doctor</option>
                                        <option value="PA" <?=($User[0][ 'UserType']=='PA' ) ? 'selected': '' ?>>PA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="foo" style="display:none;">
                                <label class="col-sm-4  form-control-label no-padding-right">Primary Medical Qualification
                                    (like M.B.B.S):*</label>

                                <div class="col-sm-8 ">
                                    <input type="text" id="Pqualification" name="Pqualification" placeholder="Enter Primary Medical Qualification" class="form-control validate[required]" value="<?=$User[0]['PrimaryQualification']?>"/>
                                </div>
                            </div>

                            <div class="form-group row" id="fo" style="display:none;">
                                <label class="col-sm-4  form-control-label no-padding-right">Advanced Medical Qualification
                                    (like F.C.P.S):*</label>
                                <?php
                                if($User[0]['AdvanceQualification'] != ''){
                                    $AQualificationarray = explode(',', $User[0]['AdvanceQualification']);
                                    ?>
                                    <?php foreach ($AQualificationarray as $key => $value){?>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                                            <input type="text" id="Aqualification<?=$key?>" name="Aqualification<?=$key?>" class="form-control validate[required]" value="<?=$value?>"/>
                                        </div>
                                    <?php }
                                } else {
                                    ?>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                                        <input type="text" id="Aqualification0" name="Aqualification0" class="form-control "/>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                                        <input type="text" id="Aqualification1" name="Aqualification1" class="form-control"/>
                                    </div>
                                <?php }
                                ?>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 form-control-label no-padding-right">Email:*</label>
                                <div class="col-sm-8">
                                    <input type="text" id="Email" name="Email" placeholder="Email" class="form-control" data-validation-engine="validate[required,custom[email]]" data-errormessage="Email is required" data-errormessage-custom-error="Invalid Email" value="<?=$User[0]['Email']?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 form-control-label no-padding-right">Password:*</label>
                                <div class="col-sm-8">
                                    <input type="password" id="Password" name="Password" placeholder="Password" class="form-control" value="<?=$User[0]['Password']?>" data-validation-engine="validate[required]" data-errormessage="Password is required"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="UpdateUserFormFunction()">Save changes</button>
                </div>
            </form>
            <div class="mt-4" id="ajaxResponse"></div>

        </div>
    </div>
</div>

<script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>

<script>
    function LoadDoctOption( option ) {
        if ( option == "Doctor" ) {
            $( "#foo" ).show();
            $( "#fo" ).show();
        } else {
            $( "#foo" ).hide();
            $( "#fo" ).hide();
        }
    }
    $( document ).ready( function () {
        LoadDoctOption( $( "#UserType" ).val() );
    } );


    function UpdateUserFormFunction() {
        var formdata = new window.FormData($("form#UpdateUserForm")[0]);

        response = AjaxUploadResponse("customers/user_form_submit", formdata);
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
