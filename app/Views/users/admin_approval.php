<br>
<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">
<div class="card">
    <div class="card-body">
        <h4>Admin Activites

        </h4>
    </div>
    <div class="table-responsive">
        <table id="record" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Sr No</th>
                <th>Edit By</th>
                <th>Module</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Edit By</th>
                <th>Module</th>
                <th>Description</th>
                <th>Action</th>
            </tr>

            </tfoot>
        </table>
    </div>
    <?php echo view('users/modal/load_description'); ?>


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
                    "url": "<?= $path ?>users/fetch_admin_approval",
                    "type": "POST"
                }
            });
        });
        function LoadDescriptionModel(id) {
            var Items = AjaxResponse("users/get_admin_updates_record", "id=" + id);
            $('#DescriptionModel form#desform div#showDescription').html(Items.record.Description);

            $('#DescriptionModel').modal('show');

        }
        function ApproveQuery(id) {
            response = AjaxResponse("users/delete", "id=" + id);
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
    </script>
    <script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>
    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>

