<br>
<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">
<div class="card">
    <div class="card-body">
        <h4>Customer
            <span style="float: right;">
                <button type="button" onclick="AddCustomer()"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add Customer
            </button>
           </span>
        </h4>
    </div>
    <div class="table-responsive">
        <table id="record" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Phone Number</th>

                <th>Email</th>
                <th>Actions</th>
            </tr>
            <div class="mt-5" id="Response"></div>

            </tfoot>
        </table>
    </div>

    <?php echo view('invoice/modal/add'); ?>
    <?php echo view('invoice/modal/update'); ?>
    <script>
        $(document).ready(function () {
            $('#record').DataTable({
                "scrollY": "800px",
                "scrollCollapse": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "lengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, 'All']],
                "pageLength": 100,
                "autoWidth": true,
                "ajax": {
                    "url": "<?= $path ?>invoice/fetch_invoice_customer",
                    "type": "POST"
                }
            });
        });

    </script>
    <script>
        function AddCustomer() {
            $('#AddCustomerModal').modal('show');

        }

        function UpdateCustomer(id) {
            var Items = AjaxResponse("invoice/get_record_invoice_customers", "id=" + id);

            $('#UpdateCustomerModal form#UpdateCustomerForm input#UID').val(Items.record.UID);
            $('#UpdateCustomerModal form#UpdateCustomerForm input#Name').val(Items.record.Name);
            $('#UpdateCustomerModal form#UpdateCustomerForm input#PhoneNumber').val(Items.record.PhoneNumber);
            $('#UpdateCustomerModal form#UpdateCustomerForm input#Email').val(Items.record.Email);
            $('#UpdateCustomerModal form#UpdateCustomerForm textarea#Address').val(Items.record.Address);
            $('#UpdateCustomerModal').modal('show');
        }

        function DeleteCustomer(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("invoice/delete_invoice_customers", "id=" + id);
                if (response.status == 'success') {
                    $("#Response").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Deleted Successfully!</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    $("#Response").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error! Not Deleted</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }

            }
        }
    </script>
    <script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>
    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>


