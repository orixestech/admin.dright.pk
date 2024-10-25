<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">


<div class="modal" id="ClintaMemberModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="validate" method="post" id="MemberDetailsForm" name="MemberDetailsForm">
                <input type="hidden" name="MemberUID" id="MemberUID"/>
                <div class="modal-header">
                    <h5 class="modal-title">Clinta Member </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div id="LoginInfoDiv">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class=" label-control"><strong>Your Password <small style="color: red;">(if you want to see details of Member please enter your login credential.)</small></strong> </label>
                                    <input class="form-control validate[required]" type="password" id="password" name="password">
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="col-md-12" id="AjaxResults"></div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button onclick="CheckMemberDetailsForm();" style="float: right;" type="button" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="MemberInfoDiv">

                        </div>
                    </div>
                </div>
            </form>
            <div class="mt-4" id="ajaxResponse"></div>

        </div>
    </div>
</div>

<script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>

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