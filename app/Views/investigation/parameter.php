<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Parameters
            <span style="float: right;">
                <button type="button" onclick="AddInvestigationParameter(<?=$UID?>)"
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
                <th>Parameters</th>
                <th>Minimum Range</th>
                <th>Maximum Range</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Parameters</th>
                <th>Minimum Range</th>
                <th>Maximum Range</th>
                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <?php echo view('investigation/modal/add_parameter'); ?>
    <?php echo view('investigation/modal/update_parameter'); ?>
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
                    "url": "<?= $path ?>investigation/fetch_investigation_parameter",
                    "type": "POST",
                    data: {
                        UID: '<?=$UID?>' // Wrap UID in quotes for string data
                    }
                }
            });});

    </script>
    <script>
        function AddInvestigationParameter(id) {
            $('#AddInvestigationParameterModal form#AddInvestigationParameterForm input#InvestigationUID').val(id);
            $('#AddInvestigationParameterModal').modal('show');

        }
     

        function UpdateInvestigationParameter(id,investigationid) {
            var Items = AjaxResponse("investigation/get_record_parameter", "id=" + id);

            $('#UpdateInvestigationParameterModal form#UpdateInvestigationParameterForm input#UID').val(Items.record.UID);
            $('#UpdateInvestigationParameterModal form#UpdateInvestigationParameterForm input#InvestigationUID').val(investigationid);
            $('#UpdateInvestigationParameterModal form#UpdateInvestigationParameterForm input#Parameters').val(Items.record.Parameters);
            $('#UpdateInvestigationParameterModal form#UpdateInvestigationParameterForm input#MinRange').val(Items.record.MinRange);
            $('#UpdateInvestigationParameterModal form#UpdateInvestigationParameterForm input#MaxRange').val(Items.record.MaxRange);
            $('#UpdateInvestigationParameterModal').modal('show');
        }

        function DeleteInvestigationParameter(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("investigation/delete_investigation_parameter", "id=" + id);
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
