<?php

use App\Models\DiscountModel;

?>
<br>

<div class="card">
    <div class="card-body">
        <h6 class="card-title"><?= ((isset($PAGE['UID'])) ? 'Update' : 'Add') ?> Discount Detail</h6>
        <form method="post" action="" name="AddDiscountCenter" id="AddDiscountCenter" class="needs-validation"
              novalidate=""
              enctype="multipart/form-data">
            <input type="hidden" name="UID" id="UID" value="0">
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Department:</label>
                        <div class="col-sm-12">
                            <select name="department" id="department" class="form-control" data-validation-engine="validate[required]">
                                <option value="0">Please Select</option>
                                <option value="Clinic"  >Clinic</option>
                                <option value="Hospital"  >Hospital</option>
                                <option value="Laboratory">Laboratory</option>
                                <option value="Diagnostic Center" >Diagnostic Center</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Title:</label>
                        <div class="col-sm-12">
                            <input type="text" id="title" name="title" placeholder="Title" class="form-control" data-validation-engine="validate[required]"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Email:</label>
                        <div class="col-sm-12">
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" data-validation-engine="validate[required,custom[email]]"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Website Url:</label>
                        <div class="col-sm-12">
                            <input type="text" id="website" name="website" placeholder="Website Url" class="form-control" data-validation-engine="validate[custom[url]]"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Specialities</label>
                        <div class="col-sm-12">
                            <select name="specialities[]" id="specialities" class="form-control" multiple>
                                <?php
                                $DiscountModel = new DiscountModel();

                                foreach( $Specialities as $SP ){

                                    echo'<option value="'.$SP['UID'].'">'.$SP['Name'].'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Contact No ( Multiple ):</label>
                        <div class="col-sm-12">
                            <textarea id="contactno" name="contactno" class="form-control" data-validation-engine="validate[required]" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Short History:</label>
                        <div class="col-sm-12">
                            <textarea id="short_histiry" name="short_histiry" class="form-control" data-validation-engine=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Facilities:</label>
                        <div class="col-sm-12">
                            <textarea id="facilities" name="facilities" class="form-control" data-validation-engine=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Basic Discount:</label>
                        <div class="col-sm-12">
                            <input type="text" id="basic_discount" name="basic_discount" placeholder="Basic Discount" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Premium Discount:</label>
                        <div class="col-sm-12">
                            <input type="text" id="premium_discount" name="premium_discount" placeholder="Premium Discount" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Address:</label>
                        <div class="col-sm-12">
                            <textarea id="address" name="address" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Profile Image</label>
                        <div class="col-sm-12">
                            <input type="file" id="profile_image" name="profile_image"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Order ID</label>
                        <div class="col-sm-12">
                            <input type="number" id="order_id" name="order_id" placeholder="OrderId" class="form-control" value="0"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3>Timings</h3>
                </div>
                <?php $Days = array(	'monday'=>'Monday','tuesday'=>'Tuesday',
                    'wednesday'=>'Wednesday','thursday'=>'Thursday',
                    'friday'=>'Friday','saturday'=>'Saturday','sunday'=>'Sunday');?>

                <?php foreach( $Days as $key=>$value ){
                    echo'<div class="col-md-4">
										<div class="form-group row">
											<div class="col-sm-12" style="margin-top:30px;">
												<input type="text" placeholder="'.$value.'" class="form-control validate[required]" disabled value="'.$value.'"/>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group row">
											<label class="col-sm-12">Start Time</label>
											<div class="col-sm-12">
												<input type="time" id="start_time" name="start_time['.$key.']" class="form-control validate[required]"/>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group row">
											<label class="col-sm-12">End Time</label>
											<div class="col-sm-12">
												<input type="time" id="end_time" name="end_time['.$key.']"  class="form-control validate[required]"/>
											</div>
										</div>
									</div>';
                }?>
                <div class="col-md-12">
                    <h2 class="head-top">Add Images <button class="btn btn-success" id="AddFile" type="button">Add</button></h2>
                </div>
                <div class="col-lg-12" id="ImageFiles"></div>
            <div class="mt-4" id="ajaxResponse"></div>


        </form>

    </div>
    <div class="mb-2">
    <span style="float: right">
                <button class="btn btn-primary" type="button" onclick="AddDiscountCenterFunction()">Submit form</button>

</span>
    </div>

</div>
<style>
    .row.form-group {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
</style>
<script type="text/javascript">
    $(function () {
        var i = 0;
        $('form#AddDiscountCenter #AddFile').click(function () {
            if (i < 10) {
                $("form#AddDiscountCenter #ImageFiles").append(
                    '<div class="row form-group d-flex align-items-center" id="FILE' + i + '" style="margin-bottom: 10px;">' +
                    '<div class="col-md-5">' +
                    '<div class="custom-file">' +
                    '<input type="file" class="custom-file-input" id="image" name="image[]">' +
                    '<label class="custom-file-label" for="customFile">Choose file</label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<input type="number" id="sort_order" name="sort_order[]" class="form-control" placeholder="Sort Order" value="0">' +
                    '</div>' +
                    '<div class="col-md-3 text-center">' +
                    '<a href="javascript:removefile(' + i + ');" class="btn btn-danger btn-md">' +
                    '<i class="fa fa-remove"></i>' +
                    '</a>' +
                    '</div>' +
                    '</div>'
                );
                i++;
            } else {
                $("#ajaxResponse").html(
                    '<div class="alert alert-danger ks-solid ks-active-border text-center" role="alert">' +
                    'Maximum 10 images are allowed.' +
                    '</div>'
                );
            }
        });
    });

    function removefile(i) {
        $('form#AddDiscountCenter #FILE' + i).remove();
    }
</script>
<script>

    function AddDiscountCenterFunction() {
        var formdata = new window.FormData($("form#AddDiscountCenter")[0]);

        response = AjaxUploadResponse("discount/discount_form_submit", formdata);
        if (response.status === 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.href = "<?=$path?>discount/discount_center";
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
