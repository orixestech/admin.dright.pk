<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4><?php if($UID=='1'){
            echo 'Lab Reports';
            }
            else{
                echo 'Radiology';
            }
            ?>
            <span style="float: right;">
                <button type="button" onclick="AddInvestigation(<?=$UID?>)"
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
                <th>Type </th>
                <th>Category</th>

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
    <?php echo view('investigation/modal/add_lab'); ?>
    <?php echo view('investigation/modal/update_lab'); ?>
    <script>
        $(document).ready(function (){
            $('#frutis').DataTable({
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
                    "url": "<?= $path ?>investigation/fetch_investigation",
                    "type": "POST",
                    data: {
                        UID: '<?=$UID?>' // Wrap UID in quotes for string data
                    }
                }
            });});

    </script>
    <script>
        function AddInvestigation(id) {
            $('#AddInvestigationModal form#AddInvestigationForm input#Parent').val(id);
            $('#AddInvestigationModal').modal('show');

        }
        function ViewParameter(id) {
            location.href = "<?=$path?>investigation/view_parameter/" + id;
        }

        function UpdateInvestigation(id) {
            var Items = AjaxResponse("investigation/get_record", "id=" + id);

            $('#UpdateInvestigationModal form#UpdateInvestigationForm input#UID').val(Items.record.UID);
            $('#UpdateInvestigationModal form#UpdateInvestigationForm input#Parent').val(Items.record.Parent);
            $('#UpdateInvestigationModal form#UpdateInvestigationForm input#Name').val(Items.record.Name);
            $('#UpdateInvestigationModal form#UpdateInvestigationForm select#Category').val(Items.record.Category);
            $('#UpdateInvestigationModal form#UpdateInvestigationForm select#Type').val(Items.record.Type);
            $('#UpdateInvestigationModal').modal('show');
        }

        function DeleteInvestigation(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("investigation/delete_investigation", "id=" + id);
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
