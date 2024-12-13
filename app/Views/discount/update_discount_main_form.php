<?php

use App\Models\DiscountModel;
$DiscountModel = new DiscountModel();
//print_r($Data);exit();
?>
<br>

<div class="card">
    <div class="card-body">
        <h6 class="card-title">Update> Discount Detail</h6>
        <form method="post" action="" name="UpdateDiscountCenter" id="UpdateDiscountCenter" class="needs-validation"
              novalidate=""
              enctype="multipart/form-data">
            <input type="hidden" name="UID" id="UID" value="<?= ((isset($Data['UID'])) ? $Data['UID'] : '0') ?>">
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Department:*</label>
                        <div class="col-sm-12">
                            <select name="department" id="department" class="form-control validate[required]" data-validation-engine="validate[required]">
                                <option value="0">Please Select</option>
                                <option value="Clinic" <?=( ( $Data[ 'Department']=='Clinic' )? 'selected' : '' )?> >Clinic</option>
                                <option value="Hospital" <?=( ( $Data[ 'Department']=='Hospital' )? 'selected' : '' )?> >Hospital</option>
                                <option value="Laboratory" <?=( ( $Data[ 'Department']=='Laboratory' )? 'selected' : '' )?> >Laboratory</option>
                                <option value="Diagnostic Center" <?=( ( $Data[ 'Department']=='Diagnostic Center' )? 'selected' : '' )?> >Diagnostic Center</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Title:</label>
                        <div class="col-sm-12">
                            <input type="text" id="title" name="title" placeholder="Title" class="form-control" data-validation-engine="validate[required]" value="<?=$Data['Title']?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Email:</label>
                        <div class="col-sm-12">
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" data-validation-engine="validate[custom[email]]" value="<?=$Data['ContactEmail']?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Website Url:</label>
                        <div class="col-sm-12">
                            <input type="text" id="website" name="website" placeholder="Website Url" class="form-control" data-validation-engine="validate[custom[url]]" value="<?=$Data['Website']?>"/>
                        </div>
                    </div>
                </div>
                <?php $Speciality = $DiscountModel->get_discount_center_Specialities_by_id($Data['UID']);
                $Spec = array();
                foreach( $Speciality as $S ){
                    $Spec[] = $S['Speciality'];
                }?>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Specialities</label>
                        <div class="col-sm-12">
                            <select name="specialities[]" id="specialities" class="form-control" multiple>
                                <?php
                                foreach( $Specialities as $SP ){

                                    echo'<option value="'.$SP['UID'].'" '.( ( in_array($SP['UID'], $Spec) )? 'selected' : '' ).'>'.$SP['Name'].'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Contact No ( Multiple ):</label>
                        <div class="col-sm-12">
                            <textarea id="contactno" name="contactno" class="form-control"  rows="4"><?=$Data['ContactNumbers']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Short History:</label>
                        <div class="col-sm-12">
                            <textarea id="short_histiry" name="short_histiry" class="form-control" data-validation-engine=""><?=$Data['ShortHistory']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Facilities:</label>
                        <div class="col-sm-12">
							<textarea id="facilities" name="facilities" class="form-control" data-validation-engine="">
								<?=$Data['Facilities']?>
							</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Basic Discount:</label>
                        <div class="col-sm-12">
                            <input type="text" id="basic_discount" name="basic_discount" placeholder="Basic Discount" class="form-control" value="<?=$Data['BasicDiscount']?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Premium Discount:</label>
                        <div class="col-sm-12">
                            <input type="text" id="premium_discount" name="premium_discount" placeholder="Premium Discount" class="form-control" value="<?=$Data['PremiumDiscount']?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Address:</label>
                        <div class="col-sm-12">
							<textarea id="address" name="address" class="form-control">
								<?=$Data['Address']?>
							</textarea>
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
                    <img src="<?=load_image('mysql|discount_center|' .$Data['UID'])?>" height="70">
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Order ID</label>
                        <div class="col-sm-12">
                            <input type="number" id="order_id" name="order_id" placeholder="OrderId" class="form-control" value="<?=$Data['OrderID']?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3>Timings</h3>
                </div>
                <?php $Timings = $DiscountModel->get_discount_center_timings_by_doct_id($Data['UID']);
                $WeekDay = array();
                foreach($Timings as $T ){

                    $WeekDay[$T['Weekday']]['start'] = $T['StartTime'];
                    $WeekDay[$T['Weekday']]['end'] = $T['EndTime'];
                }

                $Days = array(	'monday'=>'Monday','tuesday'=>'Tuesday',
                    'wednesday'=>'Wednesday','thursday'=>'Thursday',
                    'friday'=>'Friday','saturday'=>'Saturday','sunday'=>'Sunday');

                foreach( $Days as $key=>$value ){
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
												<input type="time" id="start_time" name="start_time['.$key.']" class="form-control validate[required]" value="'.( ( isset($WeekDay[$key]['start']) )? date( 'H:i', strtotime($WeekDay[$key]['start']) ) : '' ).'"/>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group row">
											<label class="col-sm-12">End Time</label>
											<div class="col-sm-12">
												<input type="time" id="end_time" name="end_time['.$key.']"  class="form-control validate[required]" value="'.( ( isset($WeekDay[$key]['end']) )? date('H:i', strtotime($WeekDay[$key]['end'])) : '' ).'"/>
											</div>
										</div>
									</div>';
                }?>
                <div class="col-md-12">
                    <h2 class="head-top">Add Images <button class="btn btn-success" id="AddFile" type="button">Add</button></h2>
                </div>
                <div id="ImageFiles"></div>
                <div class="col-md-12">
                    <div id="AjaxResult"></div>
                </div>
                <div class="col-md-12">
                    <div class="clearfix form-actions">
                        <button type="button" class="btn btn-success pull-right" onClick="DiscountCenterFormSubmit( 'UpdateDiscountCenter' )"> <i class="icon-ok bigger-110"></i> Submit </button>
                    </div>

                </div>
            </div>
        </form>

    </div>
    <div class="mb-2">
    <span style="float: right">
                <button class="btn btn-primary" type="button" onclick="UpdateDiscountCenterFunction()">Submit form</button>

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
        $('form#UpdateDiscountCenter #AddFile').click(function () {
            if (i < 10) {
                $("form#UpdateDiscountCenter #ImageFiles").append(
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
        $('form#UpdateDiscountCenter #FILE' + i).remove();
    }
</script>
<script>

    function UpdateDiscountCenterFunction() {
        var formdata = new window.FormData($("form#UpdateDiscountCenter")[0]);

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

