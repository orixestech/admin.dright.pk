<div class="card" >
    <div class="card-body">
        <h6 class="card-title">Update Discount Doctor</h6>

        <form class="form-horizontal validate" role="form" enctype="multipart/form-data"
              id="UpdateDiscountCenterDoctors" name="UpdateDiscountCenterDoctors" method="post">
            <input type="hidden" name="discountcenterid" id="discountcenterid"
                   value="<?= $Data['DiscountCenterUID'] ?>"/>
            <input type="hidden" name="id" id="id" value="<?= $Data['UID'] ?>"/>
            <div class="row form-group">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Name</label>
                        <div class="col-sm-12">
                            <input type="text" id="name" name="name" placeholder="Doctor Name" class="form-control"
                                   data-validation-engine="validate[required]" value="<?= $Data['Name'] ?>"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Speciality</label>
                        <div class="col-sm-12">
                            <input type="text" name="Speciality" id="Speciality" class="form-control validate[required]"
                                   value="<?= $Data['Speciality'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Qualification</label>
                        <div class="col-sm-12">
                            <input type="text" id="qualification" name="qualification" placeholder="Qualification"
                                   class="form-control" data-validation-engine="validate[required]"
                                   value="<?= $Data['Qualification'] ?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">PMDC No</label>
                        <div class="col-sm-12">
                            <input type="text" id="pmdc" name="pmdc" placeholder="PMDCNo" class="form-control"
                                   data-validation-engine="" value="<?= $Data['PMDCno'] ?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Department</label>
                        <div class="col-sm-12">
                            <input type="text" id="department" name="department" placeholder="Department"
                                   class="form-control" value="<?= $Data['Department'] ?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Website</label>
                        <div class="col-sm-12">
                            <input type="text" id="Website" name="Website" placeholder="Website" class="form-control"
                                   value="<?= $Data['Website'] ?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12">Profile</label>
                        <div class="col-sm-12">
                            <input type="file" id="profile" name="profile" class="" data-validation-engine=""/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if ($Data['Profile'] != '') { ?>
                        <img src="<?= $path ?>upload/discount/doctors/<?= $Data['Profile'] ?>" height="100">
                    <?php } else { ?>
                        <img src="<?= $path ?>upload/discount/doctors/no-image.png" height="100">
                    <?php } ?>

                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-12">Short Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="short_description" id="short_description"
                                      rows="6"><?= $Data['ShortDesc'] ?></textarea>
                        </div>
                    </div>
                </div>
                <?php ?>
                <div class="col-md-12">
                    <h3>Timings</h3>
                </div>
                <?php

                $Days = array('monday' => 'Monday', 'tuesday' => 'Tuesday',
                    'wednesday' => 'Wednesday', 'thursday' => 'Thursday',
                    'friday' => 'Friday', 'saturday' => 'Saturday', 'sunday' => 'Sunday');
                foreach ($Days as $key => $value) {
                    echo '<div class="col-md-12">
										<div class="form-group row">
											<div class="col-sm-12" style="margin-top:30px;">
												<input type="text" placeholder="' . $value . '" class="form-control validate[required]" disabled value="' . $value . '" />
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="form-group col-md-12" style="margin-botton:0.5rem;"><label><strong>Morning Time</strong><span style="margin-left:100px;">On Call &nbsp;<input type="checkbox" name="on_call[morning][' . $key . ']" id="on_call_morning_' . $key . '" class="" /></span></label></div>
											<div class="form-group col-md-6">
												<input type="time" name="start_time[morning][' . $key . ']" id="start_time_morning_' . $key . '" class="form-control validate[required]"/>
											</div>
											<div class="form-group col-md-6">
												<input type="time" name="end_time[morning][' . $key . ']" id="end_time_morning_' . $key . '"  class="form-control validate[required]"/>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="form-group col-md-12" style="margin-botton:0.5rem;"><label><strong>Evening Time</strong><span style="margin-left:100px;">On Call &nbsp;<input type="checkbox" name="on_call[evening][' . $key . ']" id="on_call_evening_' . $key . '" class=""/></span></label></div>
											<div class="form-group col-md-6">
												<input type="time" name="start_time[evening][' . $key . ']" id="start_time_evening_' . $key . '" class="form-control validate[required]"/>
											</div>
											<div class="form-group col-md-6">
												<input type="time" name="end_time[evening][' . $key . ']" id="end_time_evening_' . $key . '"  class="form-control validate[required]"/>
											</div>
										</div>
										
									</div>';
                } ?>
                <div class="col-md-12">
                    <div id="AjaxResult"></div>
                </div>
                <div class="clearfix form-actions col-md-12">
                    <button type="button" class="btn btn-success pull-right"
                            onClick="DiscountCenterDoctorFormSubmit( 'UpdateDiscountCenterDoctors' )"><i
                                class="icon-ok bigger-110"></i> Submit
                    </button>
                </div>
            </div>
        </form>


    </div>
    <div class="mb-2">
    <span style="float: right">
                <button class="btn btn-primary" type="button"
                        onclick="UpdateDiscountCenterDoctorFunction()">Submit form</button>

</span>
    </div>

</div>

<script>
    $(document).ready(function () {

        id = $('form#UpdateDiscountCenterDoctors input#id').val();
        rslt = AjaxResponse("discount/get_doctor_timings_data", "id=" + id);

        for (a = 0; a < rslt.length; a++) {
            if (rslt[a].EndTime != null) {
                $('#end_time_' + rslt[a].Shift + '_' + rslt[a].Weekday).val(rslt[a].EndTime);
            }
            if (rslt[a].StartTime != null) {
                $('#start_time_' + rslt[a].Shift + '_' + rslt[a].Weekday).val(rslt[a].StartTime);
            }
            if (rslt[a].OnCall == 1) {
                $('#on_call_' + rslt[a].Shift + '_' + rslt[a].Weekday).prop('checked', true);
            }
        }

    });

    function UpdateDiscountCenterDoctorFunction() {
        var formdata = new window.FormData($("form#UpdateDiscountCenterDoctors")[0]);

        response = AjaxUploadResponse("discount/discount_doctor_form_submit", formdata);
        if (response.status === 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.href = "<?=$path?>discount/discount_center_doctor";
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
