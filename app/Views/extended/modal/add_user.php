<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">
<?php


$ExtendedModel = new \App\Models\ExtendedModel();

?>

<div class="modal" id="AddNewUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" name="AddNewUserForm" id="AddNewUserForm" class="needs-validation" novalidate=""
                  enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="0"/>
                <input type="hidden" name="DBName" id="DBName"/>
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label>Name*: </label>
                            <input type="text" id="name" name="name" placeholder="Name" class="form-control" data-validation-engine="validate[required]"/>
                        </div>
                        <div class="col-md-6">
                            <label> Suugested UserName*: </label>
                            <input type="text" id="user_name" name="user_name" placeholder="User Name" class="form-control" data-validation-engine="validate[required, minSize[6]]"/>
                        </div>
                        <div class="col-md-6">
                            <label> Email*: </label>
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" data-validation-engine="validate[custom[email]]"/>
                        </div>
                        <div class="col-md-6">
                            <label> Mobile No: </label>
                            <input type="text" id="contactno" name="contactno" placeholder="Contact No" class="form-control" maxlength="11" data-validation-engine="validate[custom[integer], minSize[11]]"/>
                        </div>
                        <div class="col-md-6">
                            <label> Password*: </label>
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control" data-validation-engine="validate[required, minSize[6]]"/>
                        </div>
                        <div class="col-md-6">
                            <label>User Type*: </label>
                            <select class="form-control validate[required]" name="usertype" id="usertype" onchange="GetBranchData( this.value );">
                                <option value=" ">Please Select User Type</option>
                                <option value="superuser">Super User</option>
                                <option value="administrator">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6" style="display: none;" id="branchdiv">
                            <label>Branch*: </label>
                            <select name="branch" id="branch" class="form-control validate[required]">
                                <option value="">Please Select</option>
                                <?php $BranchData = $ExtendedModel->GetExtendedLookupsDataByDBOrID( $HospitalData[0]['DatabaseName'] , 'branch');
                                foreach ( $BranchData as $BD ){
                                    echo'<option value="'.$BD['UID'].'">'.$BD['Name'].'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="AddNewUserFormFunction()">Save changes</button>
                </div>
            </form>
            <div class="mt-4" id="ajaxResponse"></div>

        </div>
    </div>
</div>

<script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>
<script>
    function GetBranchData( val ) {

        if( val == 'superuser' ){
            $("form#AddNewUserForm div#branchdiv").css( 'display', 'none' );
        }else{
            $("form#AddNewUserForm div#branchdiv").css(  'display',  '' );

        }
    }
</script>
<script>


    // $('.select2-example').select2({
    //     placeholder: 'Select'
    // });


    function AddNewUserFormFunction() {
        var formdata = new window.FormData($("form#AddNewUserForm")[0]);

        response = AjaxUploadResponse("extended/extended_admin_user_form_submit", formdata);
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