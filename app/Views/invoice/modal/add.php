<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">


<div class="modal" id="AddItemInvoiceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="" name="AddInvoiceDetail" id="AddInvoiceDetail" class="needs-validation" novalidate=""
                  enctype="multipart/form-data">
                <input type="hidden" name="UID" id="UID" value="0">
            <div class="modal-header">
                <h5 class="modal-title">Add </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02">Name</label>
                        <select class="form-control" id="Name" name="Invoice[Name]">
                            <option value="">Please Select</option>

                            <?php  foreach ($AllItems as $record) { ?>
                                <option value="<?= $record['UID'] ?>"
                                ><?= ucwords($record['Name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Price</label>
                        <input type="text" class="form-control" id="Price" name="Invoice[Price]"
                               placeholder="Enter "
                              readonly>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="AddInvoiceDetailFunction()">Save changes</button>
            </div>
            </form>
            <div class="mt-4" id="addajaxResponse"></div>

        </div>
    </div>
</div>

<script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>

<script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Name').change(function () {
            let itemId = $(this).val(); // Get the selected item's UID

            if (itemId) {
                // Make an AJAX call to fetch the price
                $.ajax({
                    url: '<?=$path?>invoice/get_item_price', // Adjust the URL as needed
                    method: 'POST',
                    data: { UID: itemId },
                    success: function (response) {
                        let data = JSON.parse(response); // Assuming JSON response
                        if (data.success) {
                            $('#Price').val(data.price); // Update the price input field
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function () {
                        alert('An error occurred while fetching the price.');
                    }
                });
            } else {
                $('#Price').val(''); // Clear the price field if no item is selected
            }
        });
    });



    function AddInvoiceDetailFunction() {
        var formdata = new window.FormData($("form#AddInvoiceDetail")[0]);

        response = AjaxUploadResponse("invoice/invoice_detail_form_submit", formdata);
        if (response.status === 'success') {
            $("#addajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.reload();
            }, 500);
        } else {
            $("#addajaxResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error!</strong> ' + response.message + ' </div>');
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