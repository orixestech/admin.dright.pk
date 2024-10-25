<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">


<div class="modal" id="ShiftToPremiumModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="validate" method="post" id="PremiumForm" name="PremiumForm">
                <input type="hidden" name="MemberUID" id="MemberUID"/>
                <div class="modal-header">
                    <h5 class="modal-title">Shift To Premimum </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group row">
                            <label for="example-search-input" class="col-3 col-form-label"><strong>Reciept No</strong> :</label>
                            <div class="col-md-9">
                                <input class="form-control validate[required]" type="text" id="reciept_no" name="reciept_no">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12" id="AjaxResult"></div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button onclick="AddToPremium();" style="float: right;" type="button" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="mt-4" id="Response"></div>

        </div>
    </div>
</div>

<script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>

<script type="text/javascript">

    function AddToPremium(){
        var formdata = new window.FormData($("form#PremiumForm")[0]);

        response = AjaxUploadResponse("clinta_members/submit", formdata);
        if (response.status === 'success') {
            $("#Response").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.msg + ' </div>');
            setTimeout(function () {
                location.reload();
            }, 500);
        } else {
            $("#Response").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error!</strong> ' + response.msg + ' </div>');
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