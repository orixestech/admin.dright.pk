<br>
<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">
<div class="card">
    <div class="card-body">
        <h4>Items
            <span style="float: right;">
                <button type="button" onclick="AddItem()"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add Item
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
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <div class="mt-5" id="Response"></div>

            </tfoot>
        </table>
    </div>

    <?php echo view('support_ticket/modal/add'); ?>
    <?php echo view('support_ticket/modal/update'); ?>
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
                    "url": "<?= $path ?>support-ticket/fetch-items",
                    "type": "POST"
                }
            });
        });

    </script>
    <script>
        function AddItem() {
            $('#AddItemModal').modal('show');

        }

        function UpdateItem(id) {
            var Items = AjaxResponse("support-ticket/get-record-items", "id=" + id);

            $('#UpdateItemModal form#UpdateItemForm input#UID').val(Items.record.UID);
            $('#UpdateItemModal form#UpdateItemForm input#Name').val(Items.record.Name);
            $('#UpdateItemModal form#UpdateItemForm input#Code').val(Items.record.Code);
            $('#UpdateItemModal form#UpdateItemForm select#Type').val(Items.record.Type);
            $('#UpdateItemModal form#UpdateItemForm input#Price').val(Items.record.Price);
            $('#UpdateItemModal').modal('show');
        }

        function DeleteItem(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("support-ticket/delete-item", "id=" + id);
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

