

<div class="modal" id="UpdateDiscountOfferModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" name="UpdateDiscountOfferForm" id="UpdateDiscountOfferForm" class="needs-validation" novalidate=""
                  enctype="multipart/form-data">
                <input type="hidden" name="UID" id="UID" value="0">
                <input type="hidden" name="Offer[DiscountCenterID]" id="DiscountCenterID" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Update Discount Offer </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Group</label>
                            <select class="form-control" id="Group" name="Offer[Group]">
                                <option value="">Please Select</option>

                                <?php  foreach ($Group as $record) { ?>
                                    <option value="<?= $record['UID'] ?>"
                                    ><?= ucwords($record['Name']); ?></option>
                                <?php } ?>
                            </select>


                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Service Name</label>
                            <input type="text" class="form-control" id="ServiceName" name="Offer[ServiceName]"
                                   placeholder="Enter Service Name"
                                   required="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Current Price</label>
                            <input type="text" class="form-control" id="CurrentPrice" name="Offer[CurrentPrice]"
                                   placeholder="Enter Current Price"
                                   required="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Basic Discount</label>
                            <input type="text" class="form-control" id="BasicDiscount" name="Offer[BasicDiscount]"
                                   placeholder="Enter Basic Discount"
                                   required="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Premium Discount </label>
                            <input type="text" class="form-control" id="PremiumDiscount" name="Offer[PremiumDiscount]"
                                   placeholder="Enter Basic Discount"
                                   required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="UpdateDiscountOfferFormFunction()">Save changes</button>
                </div>
            </form>
            <div class="mt-4" id="ajaxResponse"></div>

        </div>
    </div>
</div>


<script>
    function UpdateDiscountOfferFormFunction() {
        var formdata = new window.FormData($("form#UpdateDiscountOfferForm")[0]);

        response = AjaxUploadResponse("discount/discount_offer_form_submit", formdata);
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