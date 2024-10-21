<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Lookups
            <span style="float: right;">
                <button type="button" onclick="AddLookup()"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span></h4>
    </div>
    <div class="table-responsive">
        <table id="frutis" class="table table-striped table-bordered">
            <thead>            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Key</th>
                <th>Description</th>

                                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Key</th>
                <th>Description</th>

                                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <?php echo view('lookups/modal/add_lookup'); ?>
    <?php echo view('lookups/modal/update_lookup'); ?>
    <script>
        $(document).ready(function (){
            $('#frutis').DataTable({
                "scrollY": "800px",
                "scrollCollapse": true,
                "searching": false,
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "lengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, 'All']],
                "pageLength": 100,
                "autoWidth": true,
                "ajax": {
                    "url": "<?= $path ?>lookups/lookup-data",
                    "type": "POST"
                }
            });});

    </script>
    <script>
        function AddLookup() {
            $('#AddLookupModal').modal('show');

        }

        function UpdateLookup(id) {
            var Items = AjaxResponse("lookups/get-record", "id=" + id);

            $('#UpdateLookupModal form#UpdateLookupForm input#UID').val(Items.record.UID);
            $('#UpdateLookupModal form#UpdateLookupForm input#Key').val(Items.record.Key);
            $('#UpdateLookupModal form#UpdateLookupForm input#Name').val(Items.record.Name);
            $('#UpdateLookupModal form#UpdateLookupForm textarea#Description').val(Items.record.Description);
            $('#UpdateLookupModal').modal('show');
        }

        function DeleteLookup(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("lookups/delete", "id=" + id);
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

    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
